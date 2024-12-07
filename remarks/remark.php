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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Remark Form</title>
  <link rel="stylesheet" href="./stylecss/styles.css" />
  <!-- /*stylecss/styles.css*/ -->
</head>

<?php
// adding the remark
if (isset($_POST['submit'])) {
  $remark = mysqli_real_escape_string($conn, $_POST['followUp']);
  $date = mysqli_real_escape_string($conn, $_POST['date']);
  $client_id = mysqli_real_escape_string($conn, $_POST['client_id']);

  $query = "INSERT INTO temp_client_remarks (temp_remark, temp_remark_date, fk_temp_client_id) ";
  $query .= "VALUES ('$remark', '$date', '$client_id')";
  $add_remark = mysqli_query($conn, $query);

  if ($add_remark) {
    $_SESSION['temp_record'] = $client_id;
    header("Location: ./profile.php");
  }
}
?>

<body>
  <div class="container">
    <h1>Remark Form</h1>
    <form id="remarkForm" action="" method="post">
      <div class="form-group">
        <label for="followUp">Follow-up Remark:</label>
        <textarea
          id="followUp1"
          name="followUp"
          rows="10"
          placeholder="Add Remark"
          required></textarea>
        <label for="date">Date:</label>
        <input type="date" name="date" value="<?php echo date('Y-m-d', time()); ?>" readonly>
      </div>
      <input type="hidden" name="client_id" id="client-id" required>
      <button type="submit" name="submit">Submit</button>
    </form>
  </div>
  <script src="js/script.js"></script>
</body>

</html>