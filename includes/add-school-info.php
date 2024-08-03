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
        $school_id = $_POST['school_id'];
        $name = $_POST['name'];
        $o_name = $_POST['o_name'];
        $slogan = $_POST['slogan'];
        $private= $_POST['private'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $expiry = $_POST['expiry'];
       
    
        $query = "INSERT INTO school_profile_(about,school_id, name,o_name, slogan, private, address, city, contact, email,expiry) 
    VALUES('$about', '$school_id', '$name', '$o_name', '$slogan', '$private', '$address', '$city', '$contact', '$email', '$expiry')";
        $result1 = mysqli_query($conn, $query);
        if ($result1) {
            redirect("../school-profile.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    ?>