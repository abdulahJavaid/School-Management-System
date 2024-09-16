<?php
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get form data
    $about = escape($_POST["about"]);
    $client_id = escape($_POST["client_id"]);
    $name = escape($_POST["name"]);
    $o_name = escape($_POST["o_name"]);
    $slogan = escape($_POST["slogan"]);
    $private = escape($_POST["private"]);
    $address = escape($_POST["address"]);
    $city = escape($_POST["city"]);
    $contact = escape($_POST["contact"]);
    $email = escape($_POST["email"]);
    $expiry = escape($_POST["expiry"]);

    // File upload handling
    $target_dir = "../uploads/school-profile-uploads/"; // Directory where the file will be saved
    $target_file = $target_dir . basename($_FILES["image"]["name"]); // Path of the uploaded file
    $pic = basename($_FILES["image"]["name"]);
    // $uploadOk = 1; // Flag to check if file is uploaded successfully
    // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // File extension

    // getting the data of the school to update school image
    $client = escape($_SESSION['client_id']);
    $query = "SELECT * FROM school_profile_ WHERE client_id='$client'";
    $pass_query = query($query);
    $get_school = mysqli_fetch_assoc($pass_query);
    // moving the uploaded image
    if (isset($_FILES['image']) && !empty($_FILES["image"]["tmp_name"])) {
        $tmp = $_FILES['image']['tmp_name'];

        unlink($target_dir . $get_school['image'] . "");
        move_uploaded_file($tmp, $target_file);
        $new_pic = $client_id . $city . $pic;
        rename($target_file, $target_dir . $new_pic . "");
    } else {
        $new_pic = $get_school['image'];
    }


    // Check if image file is an actual image or a fake image
    // $check = getimagesize($_FILES["image"]["tmp_name"]);
    // if ($check !== false) {
    //     // Allow certain file formats
    //     if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    //         redirect("../school-profile.php?m=Sorry, only JPG, JPEG, PNG, GIF files are allowed.");
    //         $uploadOk = 0;
    //     }
    // } else {
    //     redirect("../school-profile.php?m=File is not an image.");
    //     $uploadOk = 0;
    // }

    // escaping the picture name
    $new_pic = escape($new_pic);

    // Insert form data and image path into the database
    $query = "UPDATE school_profile_ SET about='$about', image='$new_pic', client_id='$client_id', ";
    $query .= "name='$name', o_name='$o_name', slogan='$slogan', private='$private', ";
    $query .= "address='$address', city='$city', contact='$contact', email='$email', expiry='$expiry' ";
    $query .= "WHERE client_id='$client'";
    $result = mysqli_query($conn, $query);


    // code to add developer activity into the logs
    $id = escape($_SESSION['login_id']);
    $admin_name = escape($_SESSION['login_name']);
    $log = "<strong>$admin_name</strong> from CodsMine updated School Profile !";
    $time = date('d/m/Y h:i a', time());
    $time = (string) $time;

    // adding activity into the logs
    $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$time', '$client')";
    $pass_query2 = mysqli_query($conn, $query);

    if ($pass_query2) {
        $_SESSION['school_name'] = $name;
        redirect("../school-profile.php");
    } else {
        redirect("../school-profile.php?m=Error: " . mysqli_error($conn));
    }

    mysqli_close($conn);
}
