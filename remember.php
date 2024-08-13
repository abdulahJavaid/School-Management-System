<?php
    // <-- --> this sign means not valid anymore

    // 1. <-- Teacher log/activity for marking the class attendance is missing -->
    // 2. passwords encryption on all site
    // 3. image uploads on all site
    // 4. hover for buttons
    // 5. define access level for teacher & admins(accountant, profiler, scheduler)
    // 6. students parents are missing
    // 7. Required missing from all form fields
    // 8. Set password for teachers and students profile
    // 9. School name missing on all pages (admin-panel)
    // 10. teacher_status missing from db_table teacher_profile
    // 11. escape_string missing on form fields
    // 12. bug on add-student page (important)*
    // 13. changes in database (table = timetable)
    // 13. create new table (subjects)
    // 14. Promote student option missing - student profile page
    // 15. Log/activity missing on most of the sections
    // 16. Add paid_fee (amount) in receivings
    // 17. Add received_amount column in (student_fee) table
    // 18. Add code for unique registration number (php)
?>


<?php 
// session_start();
// ob_start();
// require_once('db_connection/configs.php');
// require_once('db_connection/connection.php');
// require_once('includes/functions.php');

// $date = date('Y-m-d', time());

// $query = "SELECT * FROM expense_receiving WHERE date='$date'";
// $result = mysqli_query($conn, $query);
// $exp = 0;
// $rec = 0;
// while ($row = mysqli_fetch_assoc($result)) {
//     $exp += (int) $row['expense'];
//     $rec += (int) $row['receiving'];
// }
// echo $exp;
// echo ' '.$rec;




?>






<?php
// 
    $class1 = "10";
    $class2 = "9";
    $name1 = "Hamza";
    $name2 = "Ali";
    $address1 = "Gujranwala";
    $address2 = "Lahore";



    if($class2 == "8"){
        if($name2 == "Ali"){
            if($address2 = "Lahore"){
                echo "<h1>Welcome " . $name2 . "</h1>";
            }
        }

    }elseif($class1 == "10"){
        if($name1 == "Hamza"){
            if($address1 = "Gujranwala"){
                echo "<h1>Welcome " . $name1 . "</h1>";
            }
        }

    }


?>