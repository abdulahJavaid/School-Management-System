<?php
// all the functions

// function for issuing Employee Salaries
function employee_salary()
{
    global $conn;
    if (isset($_SESSION['client_id'])) {
        $client = escape($_SESSION['client_id']);

        $year = date('Y', time());
        $month = date('F', time());
        // checking if the salary for the current month is issued
        $query = "SELECT * FROM employee_salary WHERE year='$year' AND month='$month' AND fk_client_id='$client'";
        $check_record = query($query);
        if (mysqli_num_rows($check_record) == 0) {
            $date = date('d', time());
            if ($date == '28') {
                // teachers salary
                $query = "SELECT * FROM teacher_profile WHERE teacher_status='1' AND fk_client_id='$client'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $year = date('Y', time());
                    $month = date('F', time());
                    $teacher_id = $row['teacher_id'];
                    $teacher_salary = $row['teacher_salary'];
                    $query = "INSERT INTO employee_salary(fk_teacher_id, fk_staff_id, year, month, ";
                    $query .= "salary_amount, fk_client_id) VALUES('$teacher_id', '0', '$year', '$month', ";
                    $query .= "'$teacher_salary', '$client')";
                    $issue_salary = query($query);
                }
                // staff salary
                $query = "SELECT * FROM staff_profile WHERE staff_status='1' AND fk_client_id='$client'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $year = date('Y', time());
                    $month = date('F', time());
                    $staff_id = $row['staff_id'];
                    $staff_salary = $row['staff_salary'];
                    $query = "INSERT INTO employee_salary(fk_teacher_id, fk_staff_id, year, month, ";
                    $query .= "salary_amount, fk_client_id) VALUES('', '$staff_id', '$year', '$month', ";
                    $query .= "'$staff_salary', '$client')";
                    $issue_staff_salary = query($query);
                }
            }
        }
    }
}
// On the selected date call the salary function
$date = date('d', time());
if ($date == '28') {
    employee_salary(); // calling the function
}

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

// checking if the thumb impression exists in the database
function check_finger($name, $id)
{
    global $conn;
    if (isset($_SESSION['client_id'])) {
        $client = escape($_SESSION['client_id']);
    }
    $query = "SELECT * FROM teacher_fingers WHERE fk_teacher_id='$id' AND finger_name='$name' ";
    $query .= "AND fk_client_id='$client'";
    $result = query($query);
    if (mysqli_num_rows($result) == 1) {
        return "yes";
    } else {
        return "no";
    }
}

// to get the last id of the insert record
function last_id()
{
    global $conn;
    return mysqli_insert_id($conn);
}
