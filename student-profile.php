<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
if (isset($_POST['submit'])) {
    // code for fetching class and section from the select
    $fetch = $_POST['classnsection'];
    $find = strpos($fetch, ' ');
    $length = strlen($fetch);
    $number = $find + 1;
    $useable = $length - $number;
    $useable1 = $find;

    $section = substr($fetch, -$useable);
    $class = substr($fetch, 0, $useable1);
    $section = (int) $section;
    $class = (int) $class;
    $name = $_POST['name'];
    $cnic = $_POST['cnic'];
    // $f_name = $_POST['f_name'];
    $mobile_no = $_POST['mobile_no'];
    // $class = $_POST['class'];
    // $section = $_POST['section'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $roll_no = $_POST['roll_no'];
    $email = $_POST['email'];
    $password = '1234567';
    $fee_amount = $_POST['fee_amount'];

    $query = "INSERT INTO student_profile(name, cnic, mobile_no, dob, ";
    $query .= "address, roll_no, email, password, fee_amount) ";
    $query .= "VALUES('$name', '$cnic', '$mobile_no', '$dob', ";
    $query .= "'$address', '$roll_no', '$email', '$password', '$fee_amount')";
    $pass_query = mysqli_query($conn, $query);
    
    if ($pass_query) {
        // getting class id
        // $get = sql_where('all_classes', 'class_name', $class);
        // $get_r = mysqli_fetch_assoc($get);
        // $class_id = $get_r['class_id'];
        // getting section id
        // $get1 = sql_where_and('class_sections', 'section_name', $section, 'fk_class_id', $class_id);
        // $get_r1 = mysqli_fetch_assoc($get1);
        // $section_id = $get_r1['section_id'];
        // getting student id
        $get2 = sql_where('student_profile', 'name', $name);
        $get_r2 = mysqli_fetch_assoc($get2);
        $student_id = $get_r2['student_id'];
        // $student_id = mysqli_insert_id($conn);
        $queri = "INSERT INTO student_class(fk_student_id, fk_class_id, fk_section_id) ";
        $queri .= "VALUES('$student_id', '$class', '$section')";

        $pass_queri = mysqli_query($conn, $queri);

        if ($pass_queri) {
            // code to add admin_log into the database
            $result = sql_where('admin', 'admin_id', $_SESSION['login_id']);
            $fetch = mysqli_fetch_assoc($result);
            $id = $_SESSION['login_id'];
            $log = "Admin with <strong>ID: $id</strong> added <strong>student: $name</strong> to Database!";
            $time = date('d/m/Y h:i a', time());
            $time = (string) $time;

            $query = "INSERT INTO admin_logs(log_message, time) VALUES('$log', '$time')";
            $pass_query2 = mysqli_query($conn, $query);
            if (!$pass_query2) {
                echo "Error: " . mysqli_error($conn);
            } else {
                redirect('./student-profile.php');
            }
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>


<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add Student</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">School name here</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Add Student</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Student Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="fullName" value="" placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="cnic" class="col-md-4 col-lg-3 col-form-label">CNIC/B-FORM</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="cnic" type="text" class="form-control" id="fullName" value="" placeholder="CNIC/Form-B">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="cnic" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="dob" type="date" class="form-control" id="fullName" value="" placeholder="DOB">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="cnic" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="fullName" value="" placeholder="Full address">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone_no" class="col-md-4 col-lg-3 col-form-label">Phone No.</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="mobile_no" type="text" class="form-control" id="Job" value="" placeholder="Contact info">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="class" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Country" value="" placeholder="Valid email">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="class" class="col-md-4 col-lg-3 col-form-label">Reg no#</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="roll_no" type="text" class="form-control" id="Country" value="" placeholder="Student reg. number">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="class" class="col-md-4 col-lg-3 col-form-label">Monthly Fee</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fee_amount" type="text" class="form-control" id="Country" value="" placeholder="Fees in - (Rs)">
                                        </div>
                                    </div>
                                    <!-- <div class="row mb-3">
                                        <label for="class" class="col-md-4 col-lg-3 col-form-label">Roll no.</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="roll_no" type="text" class="form-control" id="Country" value="" placeholder="Enter roll number">
                                        </div>
                                    </div> -->
                                    <div class="row mb-3">
                                        <label for="inputState" class="form-label">Class</label>
                                        <div class="col-md-8 col-lg-9 offset-md-3">
                                            <select id="inputState" name="classnsection" class="form-select">
                                                <option selected>Choose class</option>
                                                <?php
                                                // fetching all the classes 
                                                $result = sql_select_all("all_classes");
                                                while ($row = mysqli_fetch_assoc($result)) {

                                                ?>
                                                    <optgroup label="Class: <?php echo $row['class_name']; ?>">
                                                        <?php
                                                        // fetching the related sections
                                                        $result1 = sql_where("class_sections", "fk_class_id", $row['class_id']);
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




                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn btn-primary button">Submit</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>