<?php
// all the general functions to be used

// function for issuing Teacher Salaries
function employee_salary()
{
    global $conn;

    $year = date('Y', time());
    $month = date('F', time());
    $query = "SELECT * FROM employee_salary WHERE year='$year' AND month='$month'";
    $check_record = query($query);
    if (mysqli_num_rows($check_record) == 0) {
        $date = date('d', time());
        if ($date == '10') {
            $query = "SELECT * FROM teacher_profile WHERE teacher_status='1'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $year = date('Y', time());
                $month = date('F', time());
                $teacher_id = $row['teacher_id'];
                $teacher_salary = $row['teacher_salary'];
                $query = "INSERT INTO employee_salary(fk_teacher_id, fk_staff_id, year, month, ";
                $query .= "salary_amount) VALUES('$teacher_id', '0', '$year', '$month', ";
                $query .= "'$teacher_salary')";
                $issue_salary = query($query);
            }
        }
    }
}
employee_salary();

// for redirections
function redirect($location)
{
    header("Location: $location");
    exit();
}

// for selecting all of the database
function sql_select_all($table)
{
    global $conn;
    $query = "SELECT * FROM " . $table . "";
    $result = mysqli_query($conn, $query);
    return ($result) ? $result : false;
}

// for selecting a row
function sql_where($table, $column, $value, $q = "")
{
    global $conn;
    $query = "SELECT * FROM " . $table . " WHERE " . $column . "='" . $value . "' " . $q;
    $result = mysqli_query($conn, $query);
    return ($result) ? $result : false;
}

// for selecting multiple required rows
function sql_where_and($table, $op1, $val1, $op2, $val2, $q = "")
{
    global $conn;
    $query = "SELECT * FROM " . $table . " WHERE ";
    $query .= "" . $op1 . "=" . $val1 . " AND " . $op2 . "='" . $val2 . "' " . $q;
    $result = mysqli_query($conn, $query);
    return ($result) ? $result : false;
}

// for passing the query
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    // return ($result) ? $result : false;
    return $result;
}

// escape the string
function escape($string)
{
    global $conn;
    return mysqli_real_escape_string($conn, $string);
}
