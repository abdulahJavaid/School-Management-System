<?php
// adding the new school
// add the new school to the database
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

// to check if the client id already exists
if (isset($_POST['query'])) {
    $cl_id = $_POST['query']; // the client id

    $query = "SELECT * FROM school_profile_ WHERE client_id='$cl_id'";
    $result = query($query);

    $matches = [];
    if (mysqli_num_rows($result) != 0) {
        $matches[] = ['msg' => "Client Id already taken!"];
    }else{
        $matches[] = ['msg' => "Client Id is available!"];
    }
    
    echo json_encode($matches);
}

// to add the new school
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_school'])) {
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
    $sub_amount = escape($_POST['sub_amount']);
    $codsmine_stake = (string) escape($_POST['codsmine_stake']);

    // File upload handling
    $target_dir = "../uploads/school-profile-uploads/"; // Directory where the file will be saved
    $target_file = $target_dir . basename($_FILES["image"]["name"]); // Path of the uploaded file
    $pic = basename($_FILES["image"]["name"]);

    // moving the uploaded image
    if (isset($_FILES['image']) && !empty($_FILES["image"]["tmp_name"])) {
        $tmp = $_FILES['image']['tmp_name'];

        // unlink($target_dir . $get_school['image'] . "");
        move_uploaded_file($tmp, $target_file);
        $new_pic = $client_id . $city . $pic;
        rename($target_file, $target_dir . $new_pic . "");
    } else {
        $new_pic = "";
    }

    // escaping the picture name
    $new_pic = escape($new_pic);

    // Insert form data and image path into the database
    $query = "INSERT INTO school_profile_(about, client_id, name, o_name, slogan, private, ";
    $query .= "address, city, contact, email, expiry, sub_amount, codsmine_stake) ";
    $query .= "VALUES('$about', '$client_id', '$name', '$o_name', '$slogan', '$private', ";
    $query .= "'$address', '$city', '$contact', '$email', '$expiry', '$sub_amount', '$codsmine_stake')";
    $result = mysqli_query($conn, $query);


    // code to add developer activity into the logs
    $id = escape($_SESSION['login_id']);
    $admin_name = escape($_SESSION['login_name']);
    $log = "<strong>$admin_name</strong> from CodsMine added new school $name !";
    $time = date('d/m/Y h:i a', time());
    $time = (string) $time;

    // adding activity into the logs
    $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$time', '$client_id')";
    $pass_query2 = mysqli_query($conn, $query);

    if ($pass_query2) {
        // $_SESSION['school_name'] = $name;
        redirect("../select-school.php");
    } else {
        redirect("../select-school.php?m=Error: " . mysqli_error($conn));
    }

    mysqli_close($conn);
}