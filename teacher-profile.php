<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// setting the vlaues empty when form is not submitted
$message = '';
$name = '';
$cnic = '';
$gender = '';
$f_name = '';
$phone_no = '';
$qualification = '';
$dob = '';
$address = '';
$email = '';
$school_id = '';
$salary = '';

// form submission
if (isset($_POST['submit'])) {
    $name = escape($_POST['name']);
    $cnic = escape($_POST['cnic']);
    $gender = escape($_POST['teacher_gender']);
    $f_name = escape($_POST['f_name']);
    $phone_no = escape($_POST['phone_no']);
    $qualification = escape($_POST['qualification']);
    $dob = escape($_POST['dob']);
    $address = escape($_POST['address']);
    $email = escape($_POST['email']);
    $school_id = escape($_POST['school_id']);
    $salary = escape($_POST['teacher_salary']);
    $password = '12345';

    // checking if the cnic is already associated to another teacher
    $query = "SELECT * FROM teacher_profile WHERE cnic='$cnic'";
    $check_cnic = query($query);
    if (mysqli_num_rows($check_cnic) == 0) {
        // checking if the phone number is already associated to another teacher
        $query = "SELECT * FROM teacher_profile WHERE phone_no='$phone_no'";
        $check_phone_no = query($query);
        if (mysqli_num_rows($check_phone_no) == 0) {
            // checking if the email is already associated to another teacher
            $query = "SELECT * FROM teacher_profile WHERE email='$email'";
            $check_email = query($query);
            if (mysqli_num_rows($check_email) == 0) {
                // checking if the teacher id(scholl_id) is already associated to another teacher
                $query = "SELECT * FROM teacher_profile WHERE school_id='$school_id'";
                $check_id = query($query);
                if (mysqli_num_rows($check_id) == 0) {

                    // if all the checks are cleared
                    // renaming the image and moving it to the folder
                    if (isset($_FILES['tch_img']) && !empty($_FILES['tch_img']['tmp_name'])) {
                        $tmp_img = $_FILES['tch_img']['tmp_name'];
                        $img = basename($_FILES['tch_img']['name']);

                        move_uploaded_file($tmp_img, "./uploads/teachers-profile/" . $img . "");
                        $new_img = $cnic . $school_id . $img;
                        rename("./uploads/teachers-profile/" . $img . "", "./uploads/teachers-profile/" . $new_img . "");
                    } else {
                        $new_img = '';
                    }
                    $new_img = escape($new_img);
                    $enc_password = $password;

                    // query to add teacher profile data
                    $query = "INSERT INTO teacher_profile(name, cnic, f_name, phone_no, qualification, dob, ";
                    $query .= "address, email, school_id, image, password, teacher_gender, ";
                    $query .= "teacher_salary) ";
                    $query .= "VALUES('$name', '$cnic', '$f_name', '$phone_no', '$qualification', ";
                    $query .= "'$dob', '$address', '$email', '$school_id', '$new_img', '$enc_password', '$gender', ";
                    $query .= "'$salary')";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        // getting the teacher id
                        $query = "SELECT * FROM teacher_profile WHERE name='$name' AND cnic='$cnic' AND phone_no='$phone_no'";
                        $get_result = query($query);
                        $fetch = mysqli_fetch_assoc($get_result);
                        $fk_tch_id = $fetch['teacher_id'];

                        // storing the teacher passwords into the database
                        $query = "INSERT INTO teacher_passwords(fk_teacher_id, teacher_password) ";
                        $query .= "VALUES('$fk_tch_id', '$password')";
                        $pass_query = query($query);

                        // code to add admin_log into the database
                        $adm_id = escape($_SESSION['login_id']);
                        $result = sql_where('admin', 'admin_id', $adm_id);
                        $fetch = mysqli_fetch_assoc($result);
                        $id = escape($_SESSION['login_id']);
                        $admin_name = escape($_SESSION['login_name']);
                        $log = "Admin <strong>$admin_name</strong> added new teacher <strong>$name</strong> !";
                        $time = date('d/m/Y h:i a', time());
                        $time = (string) $time;

                        $query = "INSERT INTO admin_logs(log_message, time) VALUES('$log', '$time')";
                        $pass_query2 = mysqli_query($conn, $query);
                        if (!$pass_query2) {
                            echo "Error: " . mysqli_error($conn);
                        }
                        redirect("./teacher-profile.php");
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                } else { // if the teacher id(school_id) is already associated to another teacher
                    $message = "Teacher Id '$school_id' is already assigned to another teacher";
                    $school_id = '';
                    $name = escape($_POST['name']);
                    $cnic = escape($_POST['cnic']);
                    $gender = escape($_POST['teacher_gender']);
                    $f_name = escape($_POST['f_name']);
                    $phone_no = escape($_POST['phone_no']);
                    $qualification = escape($_POST['qualification']);
                    $dob = escape($_POST['dob']);
                    $address = escape($_POST['address']);
                    $email = escape($_POST['email']);
                    $salary = escape($_POST['teacher_salary']);
                }
            } else { // if the email is already associated to another teacher
                $message = "Email '$email' is already associated to antoher teacher.";
                $email = '';
                $name = escape($_POST['name']);
                $cnic = escape($_POST['cnic']);
                $gender = escape($_POST['teacher_gender']);
                $f_name = escape($_POST['f_name']);
                $phone_no = escape($_POST['phone_no']);
                $qualification = escape($_POST['qualification']);
                $dob = escape($_POST['dob']);
                $address = escape($_POST['address']);
                $school_id = escape($_POST['school_id']);
                $salary = escape($_POST['teacher_salary']);
            }
        } else { // if the phone_no already exists in the database
            $message = "Phone# '$phone_no' is already associated to another teacher.";
            $phone_no = '';
            $name = escape($_POST['name']);
            $cnic = escape($_POST['cnic']);
            $gender = escape($_POST['teacher_gender']);
            $f_name = escape($_POST['f_name']);
            $qualification = escape($_POST['qualification']);
            $dob = escape($_POST['dob']);
            $address = escape($_POST['address']);
            $email = escape($_POST['email']);
            $school_id = escape($_POST['school_id']);
            $salary = escape($_POST['teacher_salary']);
        }
    } else { // if the cnic already exists in the database
        $message = "Cnic '$cnic' is already associated to another teacher.";
        $cnic = '';
        $name = escape($_POST['name']);
        $gender = escape($_POST['teacher_gender']);
        $f_name = escape($_POST['f_name']);
        $phone_no = escape($_POST['phone_no']);
        $qualification = escape($_POST['qualification']);
        $dob = escape($_POST['dob']);
        $address = escape($_POST['address']);
        $email = escape($_POST['email']);
        $school_id = escape($_POST['school_id']);
        $salary = escape($_POST['teacher_salary']);
    }
}
?>


<main id="main" class="main">


    <div class="pagetitle">
        <h1>Add Teacher</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li> -->
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
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <!-- <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">School Profile</button>
                            </li> -->

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Add Teacher</button>
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
                                                <input type="file" name="tch_img" class="form-control d-none" id="fileInput" onchange="previewImage(event)">
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
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label"><strong>Name</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="fullName" value="<?php echo ($name == '') ? '' : $name; ?>" placeholder="Teacher name" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="cnic" class="col-md-4 col-lg-3 col-form-label"><strong>CNIC</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="cnic" type="text" class="form-control" id="fullName" value="<?php echo ($cnic == '') ? '' : $cnic; ?>" placeholder="Enter cnic" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="teacher_gender" class="col-md-4 col-lg-3 col-form-label"><strong>Gender</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="teacher_gender" type="text" class="form-control" id="fullName" value="<?php echo ($gender == '') ? '' : $gender; ?>" placeholder="male/female" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="f_name" class="col-md-4 col-lg-3 col-form-label"><strong>Father Name</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="f_name" type="text" class="form-control" id="company" value="<?php echo ($f_name == '') ? '' : $f_name; ?>" placeholder="Father name" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone_no" class="col-md-4 col-lg-3 col-form-label"><strong>Phone#</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone_no" type="text" class="form-control" id="Job" value="<?php echo ($phone_no == '') ? '' : $phone_no; ?>" placeholder="Phone number" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="qualification" class="col-md-4 col-lg-3 col-form-label"><strong>Qualification</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="qualification" type="text" class="form-control" id="Country" value="<?php echo ($qualification == '') ? '' : $qualification; ?>" placeholder="Education" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="dob" class="col-md-4 col-lg-3 col-form-label"><strong>Date of Birth</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="dob" type="date" class="form-control" id="Address" value="<?php echo ($dob == '') ? '' : $dob; ?>" placeholder="Date of Birth" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="address" class="col-md-4 col-lg-3 col-form-label"><strong>Address</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="Phone" value="<?php echo ($address == '') ? '' : $address; ?>" placeholder="Home Address" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label"><strong>Email</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email" value="<?php echo ($email == '') ? '' : $email; ?>" placeholder="Email address" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="school_id" class="col-md-4 col-lg-3 col-form-label"><strong>Teacher Id</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="school_id" type="text" class="form-control" id="Email" value="<?php echo ($school_id == '') ? '' : $school_id; ?>" placeholder="Teacher Id" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="teacher_salary" class="col-md-4 col-lg-3 col-form-label"><strong>Teacher Salary</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="teacher_salary" type="text" class="form-control" id="Email" value="<?php echo ($salary == '') ? '' : $salary; ?>" placeholder="Rs." required>
                                        </div>
                                    </div>

                                    <!-- <div class="row mb-3">
                                        <label for="image" class="col-md-4 col-lg-3 col-form-label">Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="image" type="file" class="form-control" id="Email" value="" placeholder="Upload Image">
                                        </div>
                                    </div> -->

                                    <!-- <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="text" class="form-control" id="Twitter" value="" placeholder="Enter Password">
                                        </div>
                                    </div> -->

                                    <!-- <div class="row mb-3">
                                        <label for="staff_status" class="col-md-4 col-lg-3 col-form-label">Staff ststus</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select id="inputState" name="section" class="form-select">
                                                <option selected value="<?php echo "other"; ?>">Select</option>
                                                <option value="<?php echo "administration"; ?>">Administration</option>
                                                <option value="<?php echo "teacher"; ?>">Teacher</option>
                                                <option value="<?php echo "other"; ?>">Other</option>
                                                <option value="<?php echo "D"; ?>">D</option>
                                                <option value="<?php echo "E"; ?>">E</option>
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="text-end">
                                        <button type="submit" name="submit" class="btn btn-sm btn-success">Add teacher</button>
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