

<?php

session_start();
    ob_start();
    require_once('../db_connection/configs.php');
    require_once('../db_connection/connection.php');
    require_once('../includes/functions.php');



// $image= $_POST['image'];
$comment= $_POST['comment'];
$receving= $_POST['receving'];
$query="INSERT INTO add_receiving (comment,receving) VALUES('$comment', '$receving')";
$result = mysqli_query($conn,$query);
if ($result){
    echo "data has been successfully inserted";
}
else{
    echo"Error: " . mysqli_error($conn);
}
mysqli_close($conn);
?>

