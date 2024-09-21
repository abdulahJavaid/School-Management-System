<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<?php
// checking session for appropriate access
if ($level == 'clerk' || $level == 'super') {}
else {
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
                <div class="col-lg-4">
                    <select id="inputState" name="select" class="form-select">
                        <option selected value="choose_class">Choose Class</option>
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
                    </br>
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
        </div>
    </div><!-- End Select Student and add Student -->
    <?php
    // checking if the admin has selected the class
    if (isset($_POST['view_diary']) && $_POST['select'] == 'choose_class') {
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

    <!-- <section class="section profile">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Student Details</h5>
                        <p>Student Details of All the registered students of <code>School Name</code>.</p> -->
    <!--  -->
    <!--  -->
    <!--  -->

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
        $qu .= "WHERE fk_section_id='$section' AND student_status='1' AND date='$date' AND student_class.fk_client_id='$client'";
        $get = query($qu);
    ?>
        <div class="container my-5">
            <h1 class="text-center mb-4">Class Attendance</h1>

            <!-- Class attendance Card -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Class: <?php echo $rows['class_name'] . " " . $rows['section_name']; ?> / <?php echo date("jS \of F Y", strtotime($date)); ?></h5>
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
                                        <td><?php echo $row['roll_no']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <?php
                                        if ($row['attendance'] == 'present') {
                                        ?>
                                            <td><input class="raadio_c" type="radio" value="present" name="attendance<?php echo $row['student_id']; ?>" checked></td>
                                            <td><input class="raadio_c" type="radio" value="absent" name="attendance<?php echo $row['student_id']; ?>" disabled></td>
                                            <td><input class="raadio_c" type="radio" value="leave" name="attendance<?php echo $row['student_id']; ?>" disabled></td>
                                        <?php } elseif ($row['attendance'] == 'absent') {
                                        ?>
                                            <td><input class="raadio_c" type="radio" value="present" name="attendance<?php echo $row['student_id']; ?>" disabled></td>
                                            <td><input class="raadio_c" type="radio" value="absent" name="attendance<?php echo $row['student_id']; ?>" checked></td>
                                            <td><input class="raadio_c" type="radio" value="leave" name="attendance<?php echo $row['student_id']; ?>" disabled></td>
                                        <?php } elseif ($row['attendance'] == 'leave') {
                                        ?>
                                            <td><input class="raadio_c" type="radio" value="present" name="attendance<?php echo $row['student_id']; ?>" disabled></td>
                                            <td><input class="raadio_c" type="radio" value="absent" name="attendance<?php echo $row['student_id']; ?>" disabled></td>
                                            <td><input class="raadio_c" type="radio" value="leave" name="attendance<?php echo $row['student_id']; ?>" checked></td>
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

<!--  -->
<!--  -->
<!--  -->
<!-- </div>
                </div>
            </div>
        </div>
    </section> -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>