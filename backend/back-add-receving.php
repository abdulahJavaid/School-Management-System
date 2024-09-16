<?php
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

// getting the client id
$client = escape($_SESSION['client_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $comment = escape($_POST["comment"]);
    $cost = escape($_POST["receiving"]);
    $date = escape($_POST["date"]);

    // File upload handling
    $target_dir = "../uploads/expense-receiving/"; // Directory where the file will be saved
    $target_file = $target_dir . basename($_FILES["image"]["name"]); // Path of the uploaded file
    $pic = basename($_FILES["image"]["name"]);
    $tmp_pic = $_FILES['image']['tmp_name'];
    // $uploadOk = 1; // Flag to check if file is uploaded successfully
    // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // File extension

    // Check if image file is an actual image or a fake image
    // $check = getimagesize($_FILES["image"]["tmp_name"]);
    // if ($check !== false) {
    //     // Allow certain file formats
    //     if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    //         redirect("../add-expense.php?m=Sorry, only JPG, JPEG, PNG, GIF files are allowed.");
    //         $uploadOk = 0;
    //     }
    // } else {
    //     redirect("../add-expense.php?m=File is not an image.");
    //     $uploadOk = 0;
    // }

    // Check if the file already exists
    if (!empty($_FILES['image']['tmp_name'])) {
        $one = rand(10, 200);
        $two = rand(10000, 50000);
        $num = rand($one, $two);

        move_uploaded_file($tmp_pic, $target_file);
        $new_pic = $client . substr($comment, 0, 1) . $num . $date . $cost . 'rec' . $pic;
        rename($target_file, "../uploads/expense-receiving/" . $new_pic . "");

        $new_pic = escape($new_pic);
    } else {
        $new_pic = '';
    }


    // Insert form data and image path into the database
    $query = "INSERT INTO expense_receiving (image, comment, expense, receiving, date, fk_client_id) VALUES ('$new_pic', '$comment', '0', '$cost', '$date', '$client')";
    $result = mysqli_query($conn, $query);

    // fetching the admin id and adding the data
    $id = escape($_SESSION['login_id']);
    $admin_name = escape($_SESSION['login_name']);
    $log = "Admin <strong>$admin_name</strong> added receivings into the expense/receiving sheet !";
    $times = date('d/m/Y h:i a', time());
    $times = (string) $times;

    // adding activity into the logs
    $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
    $pass_query2 = mysqli_query($conn, $query);

    if ($result) {
        // echo "Data has been successfully inserted.";
        redirect("../add-receiving.php?m=Data has been successfully inserted.");
    } else {
        redirect("../add-receiving.php?m=Error: " . mysqli_error($conn) . "");
        // echo "Error: " . mysqli_error($conn);
    }
}
