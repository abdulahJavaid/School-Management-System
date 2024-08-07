<?php
session_start();
ob_start();
require_once('../db_connection/configs.php');
require_once('../db_connection/connection.php');
require_once('../includes/functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are set
    if (isset($_FILES["image"]) && isset($_POST["comment"]) && isset($_POST["receiving"])) {
        // Get form data
        $comment = $_POST["comment"];
        $cost = $_POST["receiving"];
        $date = $_POST["date"];
        
        // File upload handling
        $target_dir = "../uploads/expense-receiving/"; // Directory where the file will be saved
        $target_file = $target_dir . basename($_FILES["image"]["name"]); // Path of the uploaded file
        $pic = basename($_FILES["image"]["name"]);
        $uploadOk = 1; // Flag to check if file is uploaded successfully
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // File extension

        // Check if image file is an actual image or a fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                redirect("../add-expense.php?m=Sorry, only JPG, JPEG, PNG, GIF files are allowed.");
                $uploadOk = 0;
            }
        } else {
            redirect("../add-expense.php?m=File is not an image.");
            $uploadOk = 0;
        }

        // Check if the file already exists
        if (file_exists($target_file)) {
            redirect("../add-expense.php?m=Sorry, the file already exists.");
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            redirect("../add-expense.php?m=Sorry, your file was not uploaded.");
        } else {
            // if everything is ok, try to upload file
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Image uploaded successfully, now insert form data into the database

                // Insert form data and image path into the database
                $query = "INSERT INTO expense_receiving (image, comment, expense, receiving,date) VALUES ('$pic', '$comment', '0', '$cost', '$date')";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    // echo "Data has been successfully inserted.";
                    redirect("../add-expense.php?m=Data has been successfully inserted.");
                } else {
                    redirect("../add-expense.php?m=Error: " . mysqli_error($conn). "");
                    // echo "Error: " . mysqli_error($conn);
                }
            } else {
                redirect("../add-expense.php?m=Sorry, there was an error uploading your file.");
            }
        }
    } else {
        echo "All fields are required.";
    }
    mysqli_close($conn);
}
?>
