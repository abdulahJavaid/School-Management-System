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
if (isset($_SESSION['username'])) {
    header("Location: ./index.php");
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .login-form h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<?php
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM temp_client_login where username='$username'";
    $get_result = mysqli_query($conn, $query);

    if (mysqli_num_rows($get_result)) {
        $row = mysqli_fetch_assoc($get_result);
        $the_password = $row['password'];
        if (md5($password) == $the_password) {
            $_SESSION['username'] = $username;
            header("Location: ./index.php");
        } else {
            echo "<script>alert('The password is incorrect!')</script>";
        }
    } else {
        echo "<script>alert('The username is not valid!')</script>";
    }
}
?>

<body>
    <form class="login-form" action="" method="post">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="submit">Login</button>
    </form>
</body>

</html>