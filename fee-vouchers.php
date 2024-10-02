<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<?php
// checking session for appropriate access
if ($level == 'clerk' || $level == 'super' || $level == 'accountant') {}
else {
  redirect("./");
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Fee Vouchers</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>

    </div><!-- End Page Title -->

    <!-- class and sections -->
    <div class="pagetitle">
        <div class="row">
            <?php
            // download vouchers
            if (!isset($_GET['download_vouchers'])) {
            ?>
                <div class="row mb-3">
                    <div class="col-md-3 mb-3">
                        <form action="" method="get">
                            <button type="submit" name="download_vouchers" class="btn btn-sm btn-success w-100">Download vouchers</button>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
            <?php
            if (isset($_GET['download_vouchers'])) {
                // unset($_GET['ms']);
                // unset($_GET['m']);
            ?>
                <div class="row mb-3">
                    <form action="generate-pdf.php" method="post">
                        <div class="col-sm-4">
                            <label for="due-date" class="form-label"><strong>Student Reg. no</strong> <code>*</code></label>
                            <div class="col-auto">
                                <div class="input-group">
                                    <input
                                        name="roll_no_voucher"
                                        type="text"
                                        class="form-control"
                                        aria-label="Example input"
                                        value=""
                                        placeholder="reg#"
                                        aria-describedby="button-addon2" required />
                                    <button type="submit" name="download_student_voucher" id="button-addon3" class="btn btn-sm btn-success">
                                        Download Voucher
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="generate-pdf.php" method="post">
                        <div class="col-sm-4">
                            <label for="due-date" class="form-label"><strong>Select Class</strong> <code>*</code></label>
                            <div class="col-auto">
                                <div class="input-group">
                                    <select id="inputState" name="select" aria-label="Example input" aria-describedby="button-addon3" class="form-select">
                                        <option selected value="choose_class">Class</option>
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
                                    <button type="submit" name="download_class_vouchers" id="button-addon3" class="btn btn-sm btn-success">
                                        Download Vouchers
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="generate-pdf.php" method="post">
                        <div class="col-sm-4">
                            <label for="due-date" class="form-label"><strong>For School</strong> <code>*</code></label>
                            <div class="col-auto">
                                <div class="input-group">
                                    <input
                                        name="all_students"
                                        type="text"
                                        class="form-control"
                                        aria-label="Example input"
                                        value="All students"
                                        aria-describedby="button-addon2" readonly required />
                                    <button type="submit" name="download_school_vouchers" id="button-addon3" class="btn btn-sm btn-success">
                                        Download Vouchers
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php
            }
            ?>

            <?php
            // if admin did not selected the class or reg# is not valid
            if (isset($_GET['m']) || isset($_GET['ms'])) {
                // $message = $_GET['m'];
            ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-danger"><strong>
                                <?php
                                // displaying the messages
                                if (isset($_GET['m']))
                                    echo "Please slect a class to download vouchers!";
                                elseif (isset($_GET['ms']))
                                    echo "The registration# is invalid!";
                                ?>
                            </strong></div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div><!-- End Select Student and add Student -->


</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>