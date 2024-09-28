<?php require_once("./includes/init.php"); // inclusion fo init file 
?>

<?php
// cheking if the user is logged in
if (isset($_SESSION['login_access'])) {
  redirect("./");
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>RegistrationForm_v9 by Colorlib</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- LINEARICONS -->
  <link rel="stylesheet" href="assets/login-files/fonts/linearicons/style.css">

  <!-- MATERIAL DESIGN ICONIC FONT -->
  <link rel="stylesheet" href="assets/login-files/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

  <!-- DATE-PICKER -->
  <link rel="stylesheet" href="assets/login-files/vendor/date-picker/css/datepicker.min.css">

  <!-- STYLE CSS -->
  <link rel="stylesheet" href="assets/login-files/css/style.css">
</head>


<?php // to check if the password and id match

$message = '';
if (isset($_POST['submit'])) {
  $admin_email = escape($_POST['admin_email']);
  $password = escape($_POST['password']);

  $get_result = sql_where('admin', 'email', "$admin_email");
  $result = mysqli_fetch_assoc($get_result);
  if ($result) {
    if ($result['status'] == 1) {
      if (md5($password) == $result['password']) {
        // if the logged in user is developer
        if ($result['role'] == 'developer') {
          $_SESSION['login_email'] = $result['email'];
          $_SESSION['login_name'] = $result['admin_name'];
          $_SESSION['login_access'] = $result['role'];
          $_SESSION['login_id'] = $result['admin_id'];

          redirect("./select-school.php");

        }
        $_SESSION['login_email'] = $result['email'];
        $_SESSION['login_name'] = $result['admin_name'];
        $_SESSION['login_access'] = $result['role'];
        $_SESSION['login_id'] = $result['admin_id'];
        $_SESSION['client_id'] = $result['fk_client_id'];
        $client = $_SESSION['client_id'];
        $query = "SELECT * FROM school_profile_ WHERE client_id='$client'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_fetch_assoc($result);
        $_SESSION['school_id'] = $rows['id'];
        $_SESSION['school_name'] = $rows['name'];
        redirect('./');
      } else {
        $message = "Your password is not correct!";
      }
    } else {
      $message = "Login credentials are no longer valid!";
    }
  } else {
    $message = "Admin email is not valid!";
  }
}
?>

<body>

  <div class="wrapper">
    <div class="inner">
      <form action="" method="post">
        <h3>My School System</h3>
        <!-- <h3>Admin</h3> -->
        <div class="form-row">
          <div class="form-wrapper">
            <label for="">Email *</label>
            <input type="email" name="admin_email" class="form-control" placeholder="Your email">
          </div>
          <div class="form-wrapper">
          </div>
        </div>
        <div class="form-row last">
          <div class="form-wrapper">
            <label for="">Password *</label>
            <input type="password" name="password" class="form-control" placeholder="Your password">
          </div>
          <div class="form-wrapper">
          </div>
        </div>

        <button name="submit" data-text="Login">
          <span>Login</span>
        </button>
      </form>
    </div>
  </div>

  <script src="assets/login-files/js/jquery-3.3.1.min.js"></script>

  <!-- DATE-PICKER -->
  <script src="assets/login-files/vendor/date-picker/js/datepicker.js"></script>
  <script src="assets/login-files/vendor/date-picker/js/datepicker.en.js"></script>

  <script src="assets/login-files/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>