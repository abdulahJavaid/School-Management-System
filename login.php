<?php require_once("includes/init.php"); // inclusion fo init file ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>My School System</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="assets/css/login.css" rel="stylesheet">
    <!--Stylesheet-->
   
</head>
<?php // to check if the password and id match

  $message = '';
  if(isset($_POST['submit'])) {
    $admin_id = $_POST['admin_id'];
    $password = $_POST['password'];

    $get_result = sql_where('admin', 'admin_id', $admin_id);
    $result = mysqli_fetch_assoc($get_result);
    if($result){
      if($password == $result['password']){
        $_SESSION['login_access'] = $result['access'];
        redirect('./');
      }else{
        $message = "Your password is not correct!";
      }
    }else{
      $message = "The Admin id is not valid!";
    }
  }


?>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="" method="post">
        <h3>Login Here</h3>
        <span class="bg-danger"><?php echo $message; ?></span>

        <label for="username">Admin Id</label>
        <input type="text" placeholder="Admin id" id="username" name="admin_id">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password">

        <button name="submit">Log In</button><br><br>
        <p class="login-link">Reset password? <a href="signup.php">Sign up</a></p>
        <!-- <div class="social">
          <div class="go"><i class="fab fa-google"></i>  Google</div>
          <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div> -->
    </form>
  
</body>
</html>
