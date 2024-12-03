<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<?php
// checking session for appropriate access
if ($level == 'clerk' || $level == 'super') {
} else {
    redirect("./");
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Class Attendance</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>

    </div><!-- End Page Title -->

    <!-- class and sections -->
    <div class="pagetitle">
        <div class="row">
            <form action="" method="post">
                <label for="daily_attendance" class="col-form-label"><strong>Daily attendance <code>*</code></strong></label>
                <div class="row align-items-center mb-2">
                    <div class="col-auto">
                        <div class="input-group">
                            <select id="inputState" name="select" class="form-select" required>
                                <option selected value="">Choose Class</option>
                                <?php
                                // fetching all the classes 
                                $query = "SELECT * FROM all_classes WHERE fk_client_id='$client'";
                                $result = query($query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $clas_id = $row['class_id'];
                                ?>
                                    <optgroup label="Class: <?php echo $row['class_name']; ?>">
                                        <?php
                                        // fetching the related sections
                                        $query = "SELECT * FROM class_sections WHERE fk_class_id='$clas_id' AND fk_client_id='$client'";
                                        $result1 = query($query);
                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                        ?>
                                            <option value="<?php echo $row['class_id'] . " " . $row1['section_id']; ?>"><?php echo $row['class_name'] . " " . $row1['section_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- </br> -->
                    <div class="col-auto">
                        <div class="input-group">
                            <input
                                name="date"
                                type="date"
                                class="form-control"
                                placeholder="By name"
                                aria-label="Example input"
                                aria-describedby="button-addon2" required />
                            <button name="view_attendance" class="btn btn-sm btn-success" type="submit" id="button-addon2">
                                View Attendance
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <!--  -->
            <!-- Monthly attendance -->
            <!--  -->
            <form action="" method="post">
                <label for="monthly_attendance" class="col-form-label"><strong>Monthly attendance <code>*</code></strong></label>
                <div class="row align-items-center mb-2">
                    <div class="col-auto">
                        <div class="input-group">
                            <select id="inputState" name="select_monthly" class="form-select" required>
                                <option selected value="">Choose Class</option>
                                <?php
                                // fetching all the classes 
                                $query = "SELECT * FROM all_classes WHERE fk_client_id='$client'";
                                $result = query($query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $clas_id = $row['class_id'];
                                ?>
                                    <optgroup label="Class: <?php echo $row['class_name']; ?>">
                                        <?php
                                        // fetching the related sections
                                        $query = "SELECT * FROM class_sections WHERE fk_class_id='$clas_id' AND fk_client_id='$client'";
                                        $result1 = query($query);
                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                        ?>
                                            <option value="<?php echo $row1['section_id']; ?>"><?php echo $row['class_name'] . " " . $row1['section_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- </br> -->
                    <div class="col-auto">
                        <div class="input-group">
                            <input
                                name="date_monthly"
                                type="month"
                                class="form-control"
                                placeholder="By name"
                                aria-label="Example input"
                                aria-describedby="button-addon2" required />
                            <button name="attendance_monthly" class="btn btn-sm btn-success" type="submit" id="button-addon2">
                                View Attendance
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- End Select Student and add Student -->
    <?php
    // checking if the admin has selected the class
    if (isset($_POST['view_attendance']) && $_POST['select'] == 'choose_class') {
        $message = "Please select a class to view the attendance!";
    }
    ?>
    <?php if (isset($message)) { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger"><strong>
                        <?php echo $message; ?>
                    </strong></div>
            </div>
        </div>
    <?php } ?>

    <?php
    // show the diary for the selected date
    if (isset($_POST['view_attendance']) && $_POST['select'] != 'choose_class') {
        // separating the section and class {id} from POST data
        $fetch = $_POST['select'];
        $length = strlen($fetch);
        $find = strpos($fetch, ' ');
        $number = $find + 1;
        $useable = $length - $number;
        $useable1 = $find;

        $section = substr($fetch, -$useable);
        $class = substr($fetch, 0, $find);
        $section = (int) $section;
        $class = (int) $class;
        $section = escape($section);
        $class = escape($class);

        $date = escape($_POST['date']);

        // getting class and section names
        $q = "SELECT * FROM class_sections INNER JOIN all_classes ON ";
        $q .= "class_sections.fk_class_id=all_classes.class_id ";
        $q .= "WHERE section_id='$section' AND class_sections.fk_client_id='$client'";
        $res = query($q);
        $rows = mysqli_fetch_assoc($res);


        $qu = "SELECT * FROM student_class INNER JOIN student_profile ON ";
        $qu .= "student_class.fk_student_id=student_profile.student_id INNER JOIN attendance ON ";
        $qu .= "student_profile.student_id=attendance.fk_student_id ";
        $qu .= "WHERE fk_section_id='$section' AND student_class.status='1' ";
        $qu .= "AND student_status='1' AND date='$date' AND student_class.fk_client_id='$client'";
        $get = query($qu);
    ?>
        <div class="container my-5">
            <!-- <h1 class="text-center mb-4">Class Attendance</h1> -->

            <!-- Class attendance Card -->
            <div class="card">
                <div class="card-header card-bg-header text-white mb-2">
                    <h5 class="mb-0 text-dark d-flex justify-content-between w-100">
                        <strong>
                            <i class="fas fa-check-square pro-header-icon"></i>
                            Class: <?php echo $rows['class_name'] . " " . $rows['section_name']; ?> / <?php echo date("jS \of F Y", strtotime($date)); ?>
                        </strong>
                        <i id="rel-id" style="position: relative;" class="fas fa-info-circle pro-header-icon text-dark"></i>
                        <div id="abs-id" style="display: none;">
                            <div class="card border-0 bg-light rounded shadow">
                                <div class="card-body p-3">
                                    <div class="">
                                        <span class="text-muted d-block fw-normal">
                                            <span class="text-secondary"><i class="fa fa-info-circle" aria-hidden="true"></i> un-marked</span><br>
                                            <span class="text-success"><i class="fa fa-info-circle" aria-hidden="true"></i> present</span><br>
                                            <span class="text-danger"><i class="fa fa-info-circle" aria-hidden="true"></i> absent</span><br>
                                            <span class="text-warning"><i class="fa fa-info-circle" aria-hidden="true"></i> leave</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </h5>
                </div>

                <?php
                if (mysqli_num_rows($get)) {
                ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Registration#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Present</th>
                                    <th scope="col">Absent</th>
                                    <th scope="col">Leave</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($get)) {
                                ?>
                                    <tr>
                                        <td class="ps-3"><?php echo $row['roll_no']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <?php
                                        if ($row['attendance'] == 'present') {
                                        ?>
                                            <td><input type='checkbox' class='form-check-input is-valid' checked disabled></td>
                                            <td><input type='checkbox' class='form-check-input' style='background-color: #6c757d; border-color: #6c757d;' checked disabled></td>
                                            <td><input type='checkbox' class='form-check-input' style='background-color: #6c757d; border-color: #6c757d;' checked disabled></td>
                                            <!-- <td><input class="raadio_c" type="radio" value="present" name="attendance<?php //echo $row['student_id']; 
                                                                                                                            ?>" checked></td>
                                            <td><input class="raadio_c" type="radio" value="absent" name="attendance<?php //echo $row['student_id']; 
                                                                                                                    ?>" disabled></td>
                                            <td><input class="raadio_c" type="radio" value="leave" name="attendance<?php //echo $row['student_id']; 
                                                                                                                    ?>" disabled></td> -->
                                        <?php } elseif ($row['attendance'] == 'absent') {
                                        ?>
                                            <td><input type='checkbox' class='form-check-input' style='background-color: #6c757d; border-color: #6c757d;' checked disabled></td>
                                            <td><input type='checkbox' class='form-check-input is-invalid' checked disabled></td>
                                            <td><input type='checkbox' class='form-check-input' style='background-color: #6c757d; border-color: #6c757d;' checked disabled></td>
                                            <!-- <td><input class="raadio_c" type="radio" value="present" name="attendance<?php //echo $row['student_id']; 
                                                                                                                            ?>" disabled></td>
                                            <td><input class="raadio_c" type="radio" value="absent" name="attendance<?php //echo $row['student_id']; 
                                                                                                                    ?>" checked></td>
                                            <td><input class="raadio_c" type="radio" value="leave" name="attendance<?php //echo $row['student_id']; 
                                                                                                                    ?>" disabled></td> -->
                                        <?php } elseif ($row['attendance'] == 'leave') {
                                        ?>
                                            <td><input type='checkbox' class='form-check-input' style='background-color: #6c757d; border-color: #6c757d;' checked disabled></td>
                                            <td><input type='checkbox' class='form-check-input' style='background-color: #6c757d; border-color: #6c757d;' checked disabled></td>
                                            <td><input type='checkbox' class='form-check-input' style='background-color: #e0a800; border-color: #e0a800;' checked disabled></td>
                                            <!-- <td><input class="raadio_c" type="radio" value="present" name="attendance<?php //echo $row['student_id']; 
                                                                                                                            ?>" disabled></td>
                                            <td><input class="raadio_c" type="radio" value="absent" name="attendance<?php //echo $row['student_id']; 
                                                                                                                    ?>" disabled></td>
                                            <td><input class="raadio_c" type="radio" value="leave" name="attendance<?php //echo $row['student_id']; 
                                                                                                                    ?>" checked></td> -->
                                        <?php }
                                        ?>

                                    </tr>

                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    <?php
                } elseif (mysqli_num_rows($get) == 0 || !$get) { // end of inner if - start else

    ?>
        <div class="row ps-5 pe-5 pt-2">
            <div class="col-sm-12">
                <div class="alert alert-info">
                    <!-- <strong> -->
                    There was no attendance added on this day for Class <?php echo $rows['class_name'] . "-" . $rows['section_name']; ?>!
                    <!-- </strong> -->
                </div>
            </div>
        </div>
        </div>
        </div>
<?php

                } // inside else code
            } // main if
?>

<?php
// show the diary for the selected date
if (isset($_POST['attendance_monthly'])) {

    $section_id = escape($_POST['select_monthly']);

    $date = escape($_POST['date_monthly']);
    list($year, $month) = explode('-', $date);
    $month_days = cal_days_in_month(CAL_GREGORIAN, (int)$month, (int)$year);
    $month_start = trim($date) . '-01';
    $month_end = trim($date) . '-' . (string)$month_days;

    // getting class and section names
    $q = "SELECT * FROM class_sections INNER JOIN all_classes ON ";
    $q .= "class_sections.fk_class_id=all_classes.class_id ";
    $q .= "WHERE section_id='$section_id' AND class_sections.fk_client_id='$client'";
    $res = query($q);
    $rows = mysqli_fetch_assoc($res);


    $qu = "SELECT * FROM student_class INNER JOIN student_profile ON ";
    $qu .= "student_class.fk_student_id=student_profile.student_id INNER JOIN attendance ON ";
    $qu .= "student_profile.student_id=attendance.fk_student_id ";
    $qu .= "WHERE fk_section_id='$section_id' AND student_class.status='1' ";
    $qu .= "AND student_status='1' AND date BETWEEN '$month_start' AND '$month_end' AND student_class.fk_client_id='$client'";
    $get = query($qu);

    $data = [];
    $days = [];

    // Fetch all rows from the query
    $all_rows = [];
    while ($row = mysqli_fetch_assoc($get)) {
        $all_rows[] = $row;
    }

    // Setting the student IDs
    foreach ($all_rows as $row) {
        $std_id = $row['fk_student_id'];
        if (!isset($data[$std_id])) {
            $data[$std_id] = [
                'roll_no' => $row['roll_no'],
                'name' => $row['name']
            ];
        }
    }

    // Setting each day for student attendance
    for ($i = 1; $i <= $month_days; $i++) {
        $itterating_day = trim($date) . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
        $current_day = date('Y-m-d', strtotime($itterating_day));
        foreach ($data as $key => $val) {
            $data[$key][$current_day] = 'not-set';
        }
    }

    // Storing each day name
    for ($i = 1; $i <= $month_days; $i++) {
        $itterating_day = trim($date) . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
        $normalize_date = date('Y-m-d', strtotime($itterating_day));
        $current_day = date('d, D', strtotime($normalize_date));
        // $current_day = date('d', strtotime($normalize_date));
        $days[] = $current_day;
    }

    // Setting student attendance
    foreach ($all_rows as $row) {
        $std_id = $row['fk_student_id'];
        $row_date = $row['date'];
        $attendance = $row['attendance'];

        $data[$std_id][$row_date] = $attendance;
    }

    // echo "<pre>";
    // print_r($days);
    // echo "</pre>";

?>
    <div class="container my-5">
        <!-- <h1 class="text-center mb-4">Class Attendance</h1> -->

        <!-- Class attendance Card -->
        <div class="card">
            <div class="card-header card-bg-header text-white mb-2">
                <h5 class="mb-0 text-dark d-flex justify-content-between w-100">
                    <strong>
                        <i class="fas fa-check-square pro-header-icon"></i>
                        Class: <?php echo $rows['class_name'] . " " . $rows['section_name']; ?> / <?php echo date("F, Y", strtotime($date)); ?>
                    </strong>
                    <i id="relative-id" style="position: relative;" class="fas fa-info-circle pro-header-icon text-dark"></i>
                    <div id="absolute-id" style="display: none;">
                        <div class="card border-0 bg-light rounded shadow">
                            <div class="card-body p-3">
                                <div class="">
                                    <span class="text-muted d-block fw-normal">
                                        <span class="text-secondary"><i class="fa fa-info-circle" aria-hidden="true"></i> un-marked</span><br>
                                        <span class="text-success"><i class="fa fa-info-circle" aria-hidden="true"></i> present</span><br>
                                        <span class="text-danger"><i class="fa fa-info-circle" aria-hidden="true"></i> absent</span><br>
                                        <span class="text-warning"><i class="fa fa-info-circle" aria-hidden="true"></i> leave</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </h5>

            </div>

            <?php
            if (mysqli_num_rows($get)) {
            ?>
                <div class="table-responsive p-2 pt-0">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Reg#</th>
                                <th scope="col">Name</th>
                                <?php
                                foreach ($days as $day) {
                                ?>
                                    <th><?php echo $day; ?></th>
                                <?php
                                }
                                ?>
                                <th class="text-success">Present</th>
                                <th class="text-danger">Absent</th>
                                <th class="text-warning">Leave</th>
                                <th class="text-secondary">Un-marked</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            foreach ($data as $key => $val) {
                            ?>
                                <tr>
                                    <td class="ps-3"><?php echo $data[$key]['roll_no']; ?></td>
                                    <td><?php echo $data[$key]['name']; ?></td>

                                    <?php
                                    $present = 0;
                                    $absent = 0;
                                    $leave = 0;
                                    $un_marked = 0;
                                    for ($i = 1; $i <= $month_days; $i++) {
                                        $itterating_day = trim($date) . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
                                        $current_day = date('Y-m-d', strtotime($itterating_day));
                                    ?>
                                        <td>
                                            <?php
                                            if ($data[$key][$current_day] == 'not-set') {
                                                echo "<input type='checkbox' class='form-check-input' style='background-color: #6c757d; border-color: #6c757d;' checked disabled>";
                                                $un_marked++;
                                            } else {
                                                if ($data[$key][$current_day] == 'present') {
                                                    echo "<input type='checkbox' class='form-check-input is-valid' checked disabled>";
                                                    $present++;
                                                } elseif ($data[$key][$current_day] == 'absent') {
                                                    echo "<input type='checkbox' class='form-check-input is-invalid' checked disabled>";
                                                    $absent++;
                                                } elseif ($data[$key][$current_day] == 'leave') {
                                                    echo "<input type='checkbox' class='form-check-input' style='background-color: #e0a800; border-color: #e0a800;' checked disabled>";
                                                    $leave++;
                                                }
                                            } ?>

                                        </td>
                                    <?php
                                    }
                                    ?>
                                    <td><?php echo $present; ?></td>
                                    <td><?php echo $absent; ?></td>
                                    <td><?php echo $leave; ?></td>
                                    <td><?php echo $un_marked; ?></td>
                                </tr>

                            <?php
                            } // end foreach
                            ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
<?php
            } elseif (mysqli_num_rows($get) == 0 || !$get) { // end of inner if - start else

?>
    <div class="row ps-5 pe-5 pt-2">
        <div class="col-sm-12">
            <div class="alert alert-info">
                <!-- <strong> -->
                There was no attendance added in this month for Class <?php echo $rows['class_name'] . "-" . $rows['section_name']; ?>!
                <!-- </strong> -->
            </div>
        </div>
    </div>
    </div>
    </div>
<?php

            } // inside else code
        } // main if
?>

</main><!-- End #main -->

<script>
    <?php
    if (isset($_POST['attendance_monthly'])) {
    ?>
        let theId = document.getElementById('relative-id');
        theId.addEventListener('mouseover', mouseOver);
        theId.addEventListener('mouseout', mouseOut);
    <?php } ?>
    <?php
    if (isset($_POST['view_attendance'])) {
    ?>
        let otherId = document.getElementById('rel-id');
        otherId.addEventListener('mouseover', mouseOve);
        otherId.addEventListener('mouseout', mouseOu);
    <?php } ?>

    function mouseOver() {
        let absId = document.getElementById('absolute-id');
        absId.style.display = "inline-block";
        absId.style.position = "absolute";
        absId.style.zIndex = "500";
        absId.style.right = "5%";
    }

    function mouseOut() {
        let absId = document.getElementById('absolute-id');
        absId.style.display = "none";
        absId.style.position = "";
    }

    function mouseOve() {
        var absOtherId = document.getElementById('abs-id');
        absOtherId.style.display = "inline-block";
        absOtherId.style.position = "absolute";
        absOtherId.style.zIndex = "500";
        absOtherId.style.right = "5%";
    }

    function mouseOu() {
        var absOtherId = document.getElementById('abs-id');
        absOtherId.style.display = "none";
        absOtherId.style.position = "";
    }
</script>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>