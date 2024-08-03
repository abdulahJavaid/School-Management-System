<?php
    // all the general functions to be used

    // for redirections
    function redirect($location) {
        header("Location: $location");
        exit();
    }

    // for selecting all of the database
    function sql_select_all($table){
        global $conn;
        $query = "SELECT * FROM " . $table . "";
        $result = mysqli_query($conn, $query);
        return ($result) ? $result : false;
    }    

    // for selecting a row
    function sql_where($table, $column, $value, $q = "") {
        global $conn;
        $query = "SELECT * FROM " . $table . " WHERE " . $column . "='" . $value ."' " .$q;
        $result = mysqli_query($conn, $query);
        return ($result) ? $result : false;
    }

    // for selecting multiple required rows
    function sql_where_and($table, $op1, $val1, $op2, $val2, $q = ""){
        global $conn;
        $query = "SELECT * FROM " . $table . " WHERE "; 
        $query .= "" . $op1 . "=" . $val1 ." AND " . $op2 . "='" . $val2 . "' " . $q;
        $result = mysqli_query($conn, $query);
        return ($result) ? $result : false;
    }

    // for passing the query
    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        return ($result) ? $result : false;
    }

?>