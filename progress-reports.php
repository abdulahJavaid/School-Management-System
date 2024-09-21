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
        <h1>Progress Reports</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="container">
            <!-- Row for Name and Reg# Inputs -->
            <form action="" method="post">
                <div class="row align-items-center">
                    <!-- Name Input -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <input
                                name="name"
                                type="text"
                                size="20"
                                class="form-control"
                                placeholder="Student name"
                                aria-label="By name"
                                aria-describedby="button-addon2"
                                required />
                        </div>
                    </div>

                    <!-- Reg# Input -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <input
                                name="roll_no"
                                type="text"
                                size="10"
                                class="form-control"
                                placeholder="Reg no#"
                                aria-label="By reg#"
                                aria-describedby="button-addon3"
                                required />
                        </div>
                    </div>

                    <!-- Select Month -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <input
                                name="date"
                                type="month"
                                size="10"
                                class="form-control"
                                placeholder="Enter date"
                                aria-label="For date"
                                aria-describedby="button-addon3"
                                required />
                        </div>
                    </div>

                    <!-- Button for checking the report -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <button name="view_progress" class="btn btn-sm btn-success" type="submit" id="button-addon3">
                                View Progress Report
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <?php
            // view progeress report of the student
            if (isset($_POST['view_progress'])) {
                $name = escape($_POST['name']);
                $roll_no = escape($_POST['roll_no']);
                $query = "SELECT student_id FROM student_profile WHERE name='$name' AND roll_no='$roll_no' ";
                $query .= "AND student_status='1' AND fk_client_id='$client'";
                $result = query($query);
                if (mysqli_num_rows($result) != 0) {
                    $student = mysqli_fetch_assoc($result);
                    $std_id = $student['student_id'];
                } else {
                    $message = "There is no <strong>student: $name</strong> with <strong>registration# $roll_no</strong> in the school!";
            ?>

                    <?php if (isset($message)) { ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="alert alert-danger">
                                    <?php echo $message; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
            <?php
                }
            }
            ?>

            <?php if (isset($_POST['view_progress']) && mysqli_num_rows($result) != 0) { ?>
                <!-- Progress Report cards -->
                <div class="container my-5">
                    <h1 class="text-center mb-5 pro-text-shadow">Student Progress Report</h1>

                    <!-- Row for the first two weeks -->
                    <div class="row mb-4">
                        <!-- Week 1 -->
                        <div class="col-md-6">
                            <div class="card pro-card">
                                <div class="card-header pro-card-header pro-glow">
                                    <i class="fas fa-calendar-alt pro-header-icon"></i>
                                    <h5 class="mb-0">Week 1</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // week 1 progress report
                                    $date = $_POST['date'] . '-01';
                                    $date = escape($date);
                                    $date1 = $_POST['date'] . '-07';
                                    $date1 = escape($date1);
                                    $query = "SELECT * FROM progress_report WHERE fk_student_id='$std_id' AND date BETWEEN '$date' AND '$date1' ";
                                    $query .= "AND fk_client_id='$client'";
                                    $result = query($query);
                                    if (mysqli_num_rows($result) != 0) {
                                        while ($one = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <div class="mb-4 pt-3">
                                                <h6 class="fw-bold"><i class="fas fa-calculator pro-icon"></i> <?php echo $one['subject']; ?></h6>
                                                <!-- <div class="progress pro-progress mb-2" style="height: 20px;"> -->
                                                <?php echo $one['progress_grade']; ?>
                                                <!-- <div class="progress-bar pro-progress-bar bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div> -->
                                                <!-- </div> -->
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="row mt-2">
                                            <div class="col-xl-12">
                                                <div class="alert alert-info">
                                                    No Progress report for this week!
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <!-- <div class="mb-4 pt-3">
                                        <h6 class="fw-bold"><i class="fas fa-flask pro-icon"></i> Science</h6>
                                        <div class="progress pro-progress mb-2" style="height: 20px;">
                                            <div class="progress-bar pro-progress-bar bg-info" role="progressbar" style="width: 78%;" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100">78%</div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- Week 2 -->
                        <div class="col-md-6">
                            <div class="card pro-card">
                                <div class="card-header pro-card-header pro-glow">
                                    <i class="fas fa-calendar-alt pro-header-icon"></i>
                                    <h5 class="mb-0">Week 2</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // week 1 progress report
                                    $date2 = $_POST['date'] . '-08';
                                    $date2 = escape($date2);
                                    $date3 = $_POST['date'] . '-14';
                                    $date3 = escape($date3);
                                    $query = "SELECT * FROM progress_report WHERE fk_student_id='$std_id' AND date BETWEEN '$date2' AND '$date3' ";
                                    $query .= "AND fk_client_id='$client'";
                                    $result = query($query);
                                    if (mysqli_num_rows($result) != 0) {
                                        while ($two = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <div class="mb-4 pt-3">
                                                <h6 class="fw-bold"><i class="fas fa-calculator pro-icon"></i> <?php echo $two['subject']; ?></h6>
                                                <!-- <div class="progress pro-progress mb-2" style="height: 20px;"> -->
                                                <?php echo $two['progress_grade']; ?>
                                                <!-- <div class="progress-bar pro-progress-bar bg-success" role="progressbar" style="width: 88%;" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">88%</div> -->
                                                <!-- </div> -->
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="row mt-2">
                                            <div class="col-xl-12">
                                                <div class="alert alert-info">
                                                    No Progress report for this week!
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <!-- <div class="mb-4 pt-3">
                                        <h6 class="fw-bold"><i class="fas fa-flask pro-icon"></i> Science</h6>
                                        <div class="progress pro-progress mb-2" style="height: 20px;">
                                            <div class="progress-bar pro-progress-bar bg-info" role="progressbar" style="width: 82%;" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100">82%</div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row for the last two weeks -->
                    <div class="row mb-4">
                        <!-- Week 3 -->
                        <div class="col-md-6">
                            <div class="card pro-card">
                                <div class="card-header pro-card-header pro-glow">
                                    <i class="fas fa-calendar-alt pro-header-icon"></i>
                                    <h5 class="mb-0">Week 3</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // week 1 progress report
                                    $date4 = $_POST['date'] . '-15';
                                    $date4 = escape($date4);
                                    $date5 = $_POST['date'] . '-21';
                                    $date5 = escape($date5);
                                    $query = "SELECT * FROM progress_report WHERE fk_student_id='$std_id' AND date BETWEEN '$date4' AND '$date5' ";
                                    $query .= "AND fk_client_id='$client'";
                                    $result = query($query);
                                    if (mysqli_num_rows($result) != 0) {
                                        while ($three = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <div class="mb-4 pt-3">
                                                <h6 class="fw-bold"><i class="fas fa-calculator pro-icon"></i> <?php echo $three['subject']; ?></h6>
                                                <!-- <div class="progress pro-progress mb-2" style="height: 20px;"> -->
                                                <?php echo $three['progress_grade']; ?>
                                                <!-- <div class="progress-bar pro-progress-bar bg-success" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">90%</div> -->
                                                <!-- </div> -->
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="row mt-2">
                                            <div class="col-xl-12">
                                                <div class="alert alert-info">
                                                    No Progress report for this week!
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <!-- <div class="mb-4 pt-3">
                                        <h6 class="fw-bold"><i class="fas fa-flask pro-icon"></i> Science</h6>
                                        <div class="progress pro-progress mb-2" style="height: 20px;">
                                            <div class="progress-bar pro-progress-bar bg-info" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- Week 4 -->
                        <div class="col-md-6">
                            <div class="card pro-card">
                                <div class="card-header pro-card-header pro-glow">
                                    <i class="fas fa-calendar-alt pro-header-icon"></i>
                                    <h5 class="mb-0">Week 4</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // week 1 progress report
                                    $date6 = $_POST['date'] . '-22';
                                    $date6 = escape($date6);
                                    $date7 = $_POST['date'] . '-28';
                                    $date7 = escape($date7);
                                    $query = "SELECT * FROM progress_report WHERE fk_student_id='$std_id' AND date BETWEEN '$date6' AND '$date7' ";
                                    $query .= "AND fk_client_id='$client'";
                                    $result = query($query);
                                    if (mysqli_num_rows($result) != 0) {
                                        while ($four = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <div class="mb-4 pt-3">
                                                <h6 class="fw-bold"><i class="fas fa-calculator pro-icon"></i> <?php echo $three['subject']; ?></h6>
                                                <!-- <div class="progress pro-progress mb-2" style="height: 20px;"> -->
                                                <?php echo $three['progress_grade']; ?>
                                                <!-- <div class="progress-bar pro-progress-bar bg-success" role="progressbar" style="width: 92%;" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100">92%</div> -->
                                                <!-- </div> -->
                                            </div>

                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="row mt-2">
                                            <div class="col-xl-12">
                                                <div class="alert alert-info">
                                                    No Progress report for this week!
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <!-- <div class="mb-4 pt-3">
                                        <h6 class="fw-bold"><i class="fas fa-flask pro-icon"></i> Science</h6>
                                        <div class="progress pro-progress mb-2" style="height: 20px;">
                                            <div class="progress-bar pro-progress-bar bg-info" role="progressbar" style="width: 89%;" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100">89%</div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>