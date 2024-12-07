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

<?php
// if the session is set
if (isset($_SESSION['temp_record'])) {
  $client_id = mysqli_real_escape_string($conn, $_SESSION['temp_record']);
  echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
            showDetails('$client_id');
          });
        </script>";
  unset($_SESSION['temp_record']);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School Details</title>
  <link rel="stylesheet" href="./stylecss/style2.css">
  <style>

  </style>
</head>

<body>
  <div class="container">
    <!-- Left Section: School List with Search -->
    <div class="school-list">
      <input type="text" id="search-bar" placeholder="Search School...">
      <!-- "Add New" Button with Hyperlink -->
      <a href="add.php" class="button add-button">Add New</a>
      <ul id="school-names">
        <?php
        // getting all the clients id
        $query = "SELECT temp_client_school, temp_client_id FROM temp_clients";
        $pass_query = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($pass_query)) {
        ?>
          <li onclick="showDetails('<?php echo $row['temp_client_id']; ?>')"><?php echo $row['temp_client_school']; ?></li>
        <?php
        }
        ?>
      </ul>
    </div>

    <!-- Right Section: School Details -->
    <div class="school-details">
      <h2 id="school-title">Select a School</h2>
      <div class="buttons-container">
        
        <!-- Link to edit-school.html -->
        <a href="./backend/logout.php" class="button edit-button" id="edit-button">Logout</a>
        
        <!-- Link to add-remark.html -->
        <input type="hidden" id="selected-input" value="">
        <button onclick="addRemark()" type="button" class="button remark-button" id="remark-button">Add Remark</a>
        
      </div>

      <p id="school-description">Details will appear here when you select a school.</p>
      <div id="main-data"></div>
    </div>
  </div>

  <script src="js/script.js"></script>
</body>

</html>