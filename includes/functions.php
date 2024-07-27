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

    // for selecting all of the database
    function sql_select_all($table){
        global $conn;
        $query = "SELECT * FROM " . $table . "";
        $result = mysqli_query($conn, $query);
        return ($result) ? $result : false;
    }

    // for selecting multiple required rows
    function sql_where_and($table, $op1, $val1, $op2, $val2){
        global $conn;
        $query = "SELECT * FROM " . $table . " WHERE "; 
        $query .= "" . $op1 . "=" . $val1 ." AND " . $op2 . "='" . $val2 . "'";
        $result = mysqli_query($conn, $query);
        return ($result) ? $result : false;
    }

?>