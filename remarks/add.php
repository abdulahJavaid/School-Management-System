<?php
// database connection constants
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
?>

<?php
// if the user is logged in
if (!isset($_SESSION['username'])) {
  header("Location: ./login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Client</title>
  <link rel="stylesheet" href="./stylecss/styles.css">
</head>
<body>

<?php
// adding the client
if (isset($_POST['submit'])) {
  $school_name = mysqli_real_escape_string($conn, $_POST['schoolName']);
  $client_name = mysqli_real_escape_string($conn, $_POST['personName']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $city = mysqli_real_escape_string($conn, $_POST['city']);
  $phone_no = mysqli_real_escape_string($conn, $_POST['phoneNo']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);

  $query = "INSERT INTO temp_clients (temp_client_name, temp_client_city, temp_client_phone, temp_client_email, temp_client_address, temp_client_school) ";
  $query .= "VALUES ('$client_name', '$city', '$phone_no', '$email', '$address', '$school_name')";
  $add_client = mysqli_query($conn, $query);

  if ($add_client) {
    header("Location: ./profile.php");
  }

}

?>

  <div class="container">
    <h1>Add Client</h1>
    <form id="remarkForm" method="post" action="">

      <div class="form-group">
        <label for="schoolName">School Name:</label>
        <input type="text" id="schoolName" name="schoolName" required>
      </div>

      <div class="form-group">
        <label for="personName">Person Name:</label>
        <input type="text" id="personName" name="personName" required>
      </div>

      <div class="form-group">
        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="3" required></textarea>
      </div>

      <div class="form-group">
        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>
      </div>

      <div class="form-group">
        <label for="phoneNo">Phone No:</label>
        <input type="number" id="serialNo" name="phoneNo" required>
      </div>

      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="serialNo" name="email" required>
      </div>

      <!-- <div class="form-group">
        <label for="firstRemark">Meeting Remark:</label>
        <textarea id="firstRemark" name="firstRemark" rows="3" required></textarea>
      </div>

      <div class="form-group">
        <label for="followUp1">Follow-up Remark:</label>
        <textarea id="followUp1" name="followUp1" rows="2" required></textarea>
      </div> -->
      <button type="submit" name="submit">Submit</button>
    </form>
  </div>
  <!-- <script src="script.js"></script> -->
</body>
</html>
