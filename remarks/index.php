<?php
session_start();
ob_start();

// if the user is logged in
if (!isset($_SESSION['username'])) {
  header("Location: ./login.php");
}

header("Location: ./profile.php")
?>