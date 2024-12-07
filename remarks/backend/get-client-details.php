<?php
// // database connection constants
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', '_myschool_db');
// database connection constants
// define('DB_SERVER', 'localhost');
// define('DB_USER', 'u650672385_ghulam_murtaza');
// define('DB_PASSWORD', 'ghulam_Murtaza123!@#');
// define('DB_NAME', 'u650672385_myschool_db');
// database connection
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
if (!$conn) {
    die("Connection to database failed" . mysqli_connect_error());
}

// Set the content type to JSON
header('Content-Type: application/json');

if (isset($_POST['temp_client_id'])) {
    $the_id = mysqli_real_escape_string($conn, $_POST['temp_client_id']);
    $matches = [];

    $query = "SELECT * FROM temp_clients WHERE temp_client_id='$the_id'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $matches[$the_id]['main'] = $row;
    }

    $query = "SELECT * FROM temp_client_remarks WHERE fk_temp_client_id='$the_id'";
    $get_result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($get_result)) {
        $matches[$the_id]['remarks'][] = $row;
    }

    echo json_encode($matches);
}