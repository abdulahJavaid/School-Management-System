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
        <h1>Exam Results</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="container">
            <!-- Studen Resutls Class wise -->
            <form action="" method="get">
                <label for="see_result" class="col-form-label"><strong>Class Result <code>*</code></strong></label>
                <div class="row align-items-center">
                    <!-- Name Input -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <input
                                name="year_month"
                                type="date"
                                class="form-control"
                                placeholder="date"
                                aria-label="By date"
                                aria-describedby="button-addon1"
                                value="<?php
                                        if (isset($_GET['year_month'])) {
                                            echo $_GET['year_month'];
                                        }
                                        ?>"
                                required />
                        </div>
                    </div>

                    <!-- Reg# Input -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <select name="exam_title" class="form-select" required>
                                <option value="" selected disabled>Exam</option>
                            </select>
                        </div>
                    </div>

                    <!-- Select Month -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <select id="inputState"
                                name="select"
                                class="form-select"
                                aria-describedby="button-addon1"
                                required>
                                <option value="" disabled selected>Choose Class</option>
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

                    <!-- Button for checking the report -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <button name="class_result" class="btn btn-sm btn-success" type="submit" id="button-addon3">
                                See Result
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Studen Resutls Class wise -->
            <form action="" method="get">
                <label for="see_result" class="col-form-label"><strong>Student Result <code>*</code></strong></label>
                <div class="row align-items-center">
                    <!-- Name Input -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <input
                                name="year_month1"
                                type="date"
                                class="form-control"
                                placeholder="date"
                                aria-label="By date"
                                aria-describedby="button-addon1"
                                value="<?php
                                        if (isset($_GET['year_month1'])) {
                                            echo $_GET['year_month1'];
                                        }
                                        ?>"
                                required />
                        </div>
                    </div>

                    <!-- Reg# Input -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <input
                                name="roll_no"
                                type="text"
                                class="form-control"
                                placeholder="Reg no#"
                                aria-label="By reg#"
                                aria-describedby="button-addon3"
                                value="<?php
                                        if (isset($_GET['roll_no'])) {
                                            echo $_GET['roll_no'];
                                        }
                                        ?>"
                                required />
                        </div>
                    </div>

                    <!-- Select Month -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <select id="inputState"
                                name="select1"
                                class="form-select"
                                aria-describedby="button-addon1"
                                required>
                                <option value="" disabled selected>Choose Class</option>
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

                    <!-- Button for checking the report -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <button name="student_result" class="btn btn-sm btn-success" type="submit" id="button-addon3">
                                See Result
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <?php
            // setting the message empty
            // $message = "";
            // get the student result
            if (isset($_GET['student_result'])) {
                $section_id = escape($_GET['select1']);
                $roll_no = escape($_GET['roll_no']);
                $timestamp = strtotime(escape($_GET['year_month1']));
                $exam_month = date('F', $timestamp);
                $exam_year = date('Y', $timestamp);

                // getting the student id
                $query = "SELECT student_id FROM student_profile WHERE roll_no='$roll_no' AND fk_client_id='$client'";
                $get_student = query($query);

                if (mysqli_num_rows($get_student) == 0) {
                    $message = "There is no student with reg# $roll_no";
                } else {
                }
            }
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



        </div>
    </div>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>