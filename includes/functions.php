<?php
    // all the general functions to be used

    // for redirections
    function redirect($location) {
        header("Location: $location");
        exit();
    }

    // for selecting a row
    function sql_where($table, $column, $value) {
        global $conn;
        $query = "SELECT * FROM " . $table . " WHERE " . $column . "=" . $value . "";
        $result = mysqli_query($conn, $query);
        return ($result) ? $result : false;
    }

?>