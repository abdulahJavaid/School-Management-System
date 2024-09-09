<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// when there is no form submission, for form values
$message = '';
$name = '';
$cnic = '';
$gender = '';
$f_name = '';
$f_cnic = '';
$mobile_no = '';
$dob = '';
$address = '';
$roll_no = '';
$email = '';
$fee_amount = '';

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
    $class = escape($class);
    $section = escape($section);

    $name = escape($_POST['name']);
    $cnic = escape($_POST['cnic']);
    $gender = escape($_POST['student_gender']);
    $f_name = escape($_POST['f_name']);
    $f_cnic = escape($_POST['f_cnic']);
    $mobile_no = escape($_POST['mobile_no']);
    $dob = escape($_POST['dob']);
    $address = escape($_POST['address']);
    $roll_no = escape($_POST['roll_no']);
    $email = escape($_POST['email']);
    $password = escape('12345');
    $fee_amount = escape($_POST['fee_amount']);

    // checking if the admin has selected the class
    $classnsection = $_POST['classnsection'];
    if ($classnsection != 'choose-class') {
        // checking if the roll number is not assigned to another student
        $query = "SELECT * FROM student_profile WHERE roll_no='$roll_no'";
        $find_roll = query($query);
        if (mysqli_num_rows($find_roll) == 0) {
            // checking if the cnic/b-form is already assosiated to another student
            $query = "SELECT * FROM student_profile WHERE cnic='$cnic'";
            $find_cnic = query($query);
            if (mysqli_num_rows($find_cnic) == 0) {
                // channging the picture name and moving to the folder
                if (isset($_FILES['std_img']) && !empty($_FILES['std_img']['tmp_name'])) {
                    $tmp_img = $_FILES['std_img']['tmp_name'];
                    $img = basename($_FILES['std_img']['name']);

                    move_uploaded_file($tmp_img, "./uploads/students-profile/" . $img . "");
                    // making the picture unique using his/her cnic or his/her father cnic & roll_no
                    if (empty($cnic)) {
                        $new_img = $f_cnic . $roll_no . $img;
                    } else {
                        $new_img = $cnic . $roll_no . $img;
                    }
                    rename("./uploads/students-profile/" . $img . "", "./uploads/students-profile/" . $new_img . "");
                } else {
                    $new_img = '';
                }

                $enc_password = $password;

                // query to add student
                $query = "INSERT INTO student_profile(name, cnic, mobile_no, dob, ";
                $query .= "address, roll_no, email, password, fee_amount, ";
                $query .= "father_name, father_cnic, image, student_gender) ";
                $query .= "VALUES('$name', '$cnic', '$mobile_no', '$dob', ";
                $query .= "'$address', '$roll_no', '$email', '$enc_password', ";
                $query .= "'$fee_amount', '$f_name', '$f_cnic', '$new_img', '$gender')";
                $pass_query = mysqli_query($conn, $query);

                if ($pass_query) {
                    // getting student id
                    $gets = "SELECT student_id FROM student_profile WHERE name='$name' AND cnic='$cnic' AND father_name='$f_name' AND roll_no='$roll_no' ";
                    $gets .= "AND roll_no='$roll_no'";
                    $get2 = query($gets);
                    $get_r2 = mysqli_fetch_assoc($get2);
                    $student_id = $get_r2['student_id'];
                    // $student_id = mysqli_insert_id($conn);

                    // storing the student passwords into the database
                    $query = "INSERT INTO student_passwords(fk_student_id, student_password) ";
                    $query .= "VALUES('$student_id', '$password')";
                    $pass_query = query($query);

                    // adding the class and section of the student
                    $queri = "INSERT INTO student_class(fk_student_id, fk_class_id, fk_section_id) ";
                    $queri .= "VALUES('$student_id', '$class', '$section')";
                    $pass_queri = mysqli_query($conn, $queri);

                    if ($pass_queri) {
                        // code to add admin activity into the logs
                        $adm_id = escape($_SESSION['login_id']);
                        $result = sql_where('admin', 'admin_id', $adm_id);
                        $fetch = mysqli_fetch_assoc($result);
                        $id = escape($_SESSION['login_id']);
                        $admin_name = escape($_SESSION['login_name']);
                        $log = "Admin <strong>$admin_name</strong> added new student <strong>$name</strong> !";
                        $time = date('d/m/Y h:i a', time());
                        $time = (string) $time;

                        // adding activity into the logs
                        $query = "INSERT INTO admin_logs(log_message, time) VALUES('$log', '$time')";
                        $pass_query2 = mysqli_query($conn, $query);
                        if (!$pass_query2) {
                            echo "Error: " . mysqli_error($conn);
                        } else {
                            redirect('./student-profile.php');
                        }
                    }
                } else {
                    $message = "There was an issue addin user, try again!";
                }
            } else { // else if the cnic already exists in the database
                $message = "CNIC '$cnic' is already assosiated to another student.";
                $cnic = '';
                $name = escape($_POST['name']);
                $gender = escape($_POST['student_gender']);
                $f_name = escape($_POST['f_name']);
                $f_cnic = escape($_POST['f_cnic']);
                $mobile_no = escape($_POST['mobile_no']);
                $dob = escape($_POST['dob']);
                $address = escape($_POST['address']);
                $roll_no = escape($_POST['roll_no']);
                $email = escape($_POST['email']);
                $password = escape('12345');
                $fee_amount = escape($_POST['fee_amount']);
            }
        } else { // else if the roll number is already assigned to another student
            $message = "Registration# '$roll_no' is already assigned to another student.";
            $roll_no = '';
            $name = escape($_POST['name']);
            $cnic = escape($_POST['cnic']);
            $gender = escape($_POST['student_gender']);
            $f_name = escape($_POST['f_name']);
            $f_cnic = escape($_POST['f_cnic']);
            $mobile_no = escape($_POST['mobile_no']);
            $dob = escape($_POST['dob']);
            $address = escape($_POST['address']);
            $email = escape($_POST['email']);
            $password = escape('12345');
            $fee_amount = escape($_POST['fee_amount']);
        }
    } else { // else if the admin has not selected the class
        $message = "Please select a class for the student.";
        $name = escape($_POST['name']);
        $cnic = escape($_POST['cnic']);
        $gender = escape($_POST['student_gender']);
        $f_name = escape($_POST['f_name']);
        $f_cnic = escape($_POST['f_cnic']);
        $mobile_no = escape($_POST['mobile_no']);
        $dob = escape($_POST['dob']);
        $address = escape($_POST['address']);
        $roll_no = escape($_POST['roll_no']);
        $email = escape($_POST['email']);
        $password = escape('12345');
        $fee_amount = escape($_POST['fee_amount']);
    }
}
?>


<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add Student</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <?php
            // if there is a message
            if ($message != '') {
            ?>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger"><strong>
                                    <?php echo $message; ?>
                                </strong></div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Add Student</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label"><strong>Upload Photo</strong> </label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="text-center">
                                                <img id="imagePreview" src="https://via.placeholder.com/100" alt="Image Preview" class="rounded mb-2" style="max-width: 200px;">
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <input type="file" name="std_img" class="form-control d-none" id="fileInput" onchange="previewImage(event)">
                                                <button class="btn btn-sm btn-secondary" type="button" id="uploadButton">
                                                    <i class="bi bi-upload"></i>
                                                </button>&nbsp;
                                                <button class="btn btn-sm btn-danger" type="button" id="deleteButton">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                            <!-- <input name="name" type="text" class="form-control" id="fullName" value="" placeholder="Full Name" required> -->
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label"><strong>Student Name</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="fullName" value="<?php echo ($name == '') ? '' : $name; ?>" placeholder="Full name" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="cnic" class="col-md-4 col-lg-3 col-form-label"><strong>CNIC/B-FORM</strong> </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="cnic" type="text" class="form-control" id="fullName" value="<?php echo ($cnic == '') ? '' : $cnic; ?>" placeholder="CNIC/Form-B">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="student_gender" class="col-md-4 col-lg-3 col-form-label"><strong>Gender</strong> </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="student_gender" type="text" class="form-control" id="fullName" value="<?php echo ($gender == '') ? '' : $gender; ?>" placeholder="male/female">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="dob" class="col-md-4 col-lg-3 col-form-label"><strong>Date of Birth</strong> </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="dob" type="date" class="form-control" id="fullName" value="<?php echo ($dob == '') ? '' : $dob; ?>" placeholder="DOB">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="f_name" class="col-md-4 col-lg-3 col-form-label"><strong>Father Name</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="f_name" type="text" class="form-control" id="fullName" value="<?php echo ($f_name == '') ? '' : $f_name; ?>" placeholder="Father name" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="f_cnic" class="col-md-4 col-lg-3 col-form-label"><strong>Father CNIC</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="f_cnic" type="text" class="form-control" id="fullName" value="<?php echo ($f_cnic == '') ? '' : $f_cnic; ?>" placeholder="Father cnic">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="address" class="col-md-4 col-lg-3 col-form-label"><strong>Address</strong> </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="fullName" value="<?php echo ($address == '') ? '' : $address; ?>" placeholder="Home address">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone_no" class="col-md-4 col-lg-3 col-form-label"><strong>Phone#</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="mobile_no" type="text" class="form-control" id="Job" value="<?php echo ($mobile_no == '') ? '' : $mobile_no; ?>" placeholder="Phone number" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="class" class="col-md-4 col-lg-3 col-form-label"><strong>Email</strong> </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Country" value="<?php echo ($email == '') ? '' : $email; ?>" placeholder="Email address">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="class" class="col-md-4 col-lg-3 col-form-label"><strong>Reg no#</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="roll_no" type="text" class="form-control" id="Country" value="<?php echo ($roll_no == '') ? '' : $roll_no; ?>" placeholder="Student reg. number" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="class" class="col-md-4 col-lg-3 col-form-label"><strong>Monthly Fee</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fee_amount" type="text" class="form-control" id="Country" value="<?php echo ($fee_amount == '') ? '' : $fee_amount; ?>" placeholder="Fees in - (Rs)" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputState" class="form-label"><strong>Class</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9 offset-md-3">
                                            <select id="inputState" name="classnsection" class="form-select" required>
                                                <option selected value="choose-class">Choose class</option>
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

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-sm btn-success">Add Student</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php
    ?>

</main><!-- End #main -->

<script>
    // code to upload and view the image
    document.getElementById('uploadButton').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });
    document.getElementById('deleteButton').addEventListener('click', function() {
        document.getElementById('fileInput').value = '';
        document.getElementById('imagePreview').src = 'https://via.placeholder.com/100';
    });

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>