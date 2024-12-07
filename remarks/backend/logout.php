<?php
// // database connection constants
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', '_myschool_db');
// database connection constants
// define('DB_SERVER', 'localhost');
// define('DB_USER', 'u650672385_ghulam_murtaza');
// define('DB_PASSWORD', 'ghulam_Murtaza123!@#');
// define('DB_NAME', 'u650672385_myschool_db');
// database connection
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
if (!$conn) {
  die("Connection to database failed" . mysqli_connect_error());
}
session_start();
ob_start();

unset($_SESSION['username']);
header("Location: ../index.php");

?>