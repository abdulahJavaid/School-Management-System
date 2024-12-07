<?php
// database connection constants

use FontLib\Table\Type\head;

define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', '_myschool_db');
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