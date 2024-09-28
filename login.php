<?php require_once("includes/init.php"); // inclusion fo init file 
?>

<?php
// cheking if the user is logged in
if (isset($_SESSION['login_access'])) {
  redirect("./");
}
// $level = escape($_SESSION['login_access']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Design by foolishdeveloper.com -->
  <title>My School System</title>

  
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="assets/css/login.css" rel="stylesheet">
  
  <!--Stylesheet-->
  <style>
  </style>

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

<body class="bg-image">
  <!-- <div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
  </div> -->
  <div class="container">
    <div class="row h-100">
    <div class="d-sm-none d-md-block col-md-5 mt-3">
      <div class="d-flex justify-content-start align-items-center h-100 pb-4">
        <!-- <h3 class="h3 text-info">Welcome to,</h3><br> -->
        <h1 class="h1 text-light h1-login">My School System!</h1>
      </div>
    </div>
    <div class="col-md-5 col-sm-8 offset-sm-2 col-10 offset-1 mt-3">
    <form action="" method="post">
    <h3><strong>Login Here</strong></h3>
    <span class="bg-danger"><?php echo $message; ?></span>

    <label for="username"><strong>Admin Email</strong></label>
    <input type="email" placeholder="example@mail.com" id="username" name="admin_email" required>

    <label for="password"><strong>Password</strong></label>
    <input type="password" placeholder="Password" id="password" name="password" required>

    <button name="submit">Log In</button><br><br>
    <!-- <p class="login-link">Reset password? <a href="signup.php">Sign up</a></p> -->
    <!-- <div class="social">
      <div class="go"><i class="fab fa-google"></i>  Google</div>
      <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
    </div> -->
  </form>
</div>
    </div>
  </div>

</body>

</html>