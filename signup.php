<?php require_once("includes/init.php"); // inclusion of init file ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>My School System</title>
    
    <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="assets/css/login.css" rel="stylesheet">
</head>
<body>
<?php

$name= $_POST['name'];
$email= $_POST['email'];
$password= $_POST['password'];
$query="INSERT INTO admin (name,email,password) VALUES('$name','$email', '$password')";
$result = mysqli_query($conn,$query);
if ($result){
    echo "Account create sucessfully";
}
else{
    echo"Error: " . mysqli_error($conn);
}
mysqli_close($conn);
?>




    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="" method="post">
    
        <h3>Sign up</h3>
    
        
        <div class="mb-0">
            <label for="username">Admin Id</label>
            <input type="text" class="form-control" placeholder="Admin id" id="username" name="admin_id">
        </div>
        
        <div class="mb-0">
            <label for="name">User Name</label>
            <input type="text" class="form-control" placeholder="name" id="name" name="name">
        </div>
        
        <div class="mb-0">
            <label for="email">Email</label>
            <input type="email" class="form-control" placeholder="Enter your Email" id="email" name="email">
        </div>
        
        <div class="mb-0">
            <label for="password">Password</label>
            <input type="password" class="form-control" placeholder="Password" id="password" name="password">
        </div>
            
        <button name="submit">Sign Up</button>
        <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
        </form>
     
    
    </form>
</body>
</html>
