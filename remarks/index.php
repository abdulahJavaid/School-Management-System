
<?php
// if the user is logged in
if (!isset($_SESSION['username'])) {
  header("Location: ./login.php");
}
?>

<?php
session_start();
ob_start();

header("Location: ./profile.php")
?>