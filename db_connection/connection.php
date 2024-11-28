<?php
// database connection
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
if (!$conn) {
    die("Connection to database failed" . mysqli_connect_error());
}
