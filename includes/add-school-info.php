<?php
    // inclusion of required files and functions
    session_start();
    ob_start();
    require_once('../db_connection/configs.php');
    require_once('../db_connection/connection.php');
    require_once('./functions.php');

    
    if (isset($_POST['submit'])) {
      $about = $_POST['about'];
        // $image = $_POST['image'];
        $name = $_POST['name'];
        $slogan = $_POST['slogan'];
        $private= $_POST['private'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
       
    
        $query = "INSERT INTO school_profile_(about, name, slogan, private, address, city, contact, email) 
    VALUES('$about', '$name', '$slogan', '$private', '$address', '$city', '$contact', '$email')";
        $result1 = mysqli_query($conn, $query);
        if ($result1) {
            echo "data has been successfully inserted";
            // redirect("../profile.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    ?>