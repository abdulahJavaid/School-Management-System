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

<?php
// if the get request is not set
if (!isset($_GET['id'])) {
    redirect('./teachers.php');
}
?>
<?php
// fetching the student data here
$id = escape($_GET['id']);
$query = "SELECT * FROM teacher_profile ";
$query .= "WHERE teacher_id = '$id' AND teacher_status='1' AND fk_client_id='$client'";
$pass = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($pass);
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <?php
    // setting values empty when the form is not submitted
    $message = '';
    $name = '';
    $school_id = '';
    $qualification = '';
    $f_name = '';
    $cnic = '';
    $dob = '';
    $phone_no = '';
    $email = '';
    $address = '';
    $gender = '';
    $salary = '';

    // updating teacher profile
    if (isset($_POST['submit'])) {
        $cid = escape($_GET['id']);
        $name = escape($_POST['name']);
        $school_id = escape($_POST['school_id']);
        $qualification = escape($_POST['qualification']);
        $f_name = escape($_POST['f_name']);
        $cnic = escape($_POST['cnic']);
        $dob = escape($_POST['dob']);
        $phone_no = escape($_POST['phone_no']);
        $email = escape($_POST['email']);
        $address = escape($_POST['address']);
        $gender = escape($_POST['teacher_gender']);
        $salary = escape($_POST['teacher_salary']);


        // checking if the cnic is already associated to another teacher
        $query = "SELECT * FROM teacher_profile WHERE cnic='$cnic' AND teacher_status='1' AND fk_client_id='$client' AND NOT teacher_id='$cid'";
        $check_cnic = query($query);
        if (mysqli_num_rows($check_cnic) == 0) {
            // checking if the cnic is already associated to another staff member
            $query = "SELECT * FROM staff_profile WHERE cnic='$cnic' AND staff_status='1' AND fk_client_id='$client'";
            $check_staff_cnic = query($query);
            if (mysqli_num_rows($check_staff_cnic) == 0) {
                // checking if the phone number is already associated to another teacher
                $query = "SELECT * FROM teacher_profile WHERE phone_no='$phone_no' AND teacher_status='1' AND fk_client_id='$client' AND NOT teacher_id='$cid'";
                $check_phone_no = query($query);
                if (mysqli_num_rows($check_phone_no) == 0) {
                    // checking if the phone number is already associated to another staff member
                    $query = "SELECT * FROM staff_profile WHERE phone_no='$phone_no' AND staff_status='1' AND fk_client_id='$client'";
                    $check_staff_phone = query($query);
                    if (mysqli_num_rows($check_staff_phone) == 0) {
                        // checking if the email is already associated to another teacher
                        $query = "SELECT * FROM teacher_profile WHERE email='$email' AND teacher_status='1' AND fk_client_id='$client' AND NOT teacher_id='$cid'";
                        $check_email = query($query);
                        if (mysqli_num_rows($check_email) == 0) {
                            // checking if the teacher id is already associated to another teacher
                            $query = "SELECT * FROM teacher_profile WHERE school_id='$school_id' AND teacher_status='1' AND fk_client_id='$client' AND NOT teacher_id='$cid'";
                            $check_id = query($query);
                            if (mysqli_num_rows($check_id) == 0) {
                                // checking if the teacher id is already associated to another staff member
                                $query = "SELECT * FROM staff_profile WHERE staff_school_id='$school_id' AND staff_status='1' AND fk_client_id='$client'";
                                $check_staff_id = query($query);
                                if (mysqli_num_rows($check_staff_id) == 0) {

                                    // if all the checks are clear
                                    // reaming the iamge and moving it to the folder
                                    if (isset($_FILES['tch_img']) && !empty($_FILES['tch_img']['tmp_name'])) {
                                        $tmp_img = $_FILES['tch_img']['tmp_name'];
                                        $img = basename($_FILES['tch_img']['name']);

                                        unlink("./uploads/teachers-profile/" . $row['image'] . "");
                                        move_uploaded_file($tmp_img, "./uploads/teachers-profile/" . $img . "");
                                        $new_img = $client . $cnic . $school_id . $img;
                                        rename("./uploads/teachers-profile/" . $img . "", "./uploads/teachers-profile/" . $new_img . "");
                                    } else {
                                        $new_img = $row['image'];
                                    }
                                    $new_img = escape($new_img);

                                    $query = "UPDATE teacher_profile SET name='$name', school_id='$school_id', ";
                                    $query .= "qualification='$qualification', f_name='$f_name', ";
                                    $query .= "cnic='$cnic', dob='$dob', phone_no='$phone_no', email='$email', ";
                                    $query .= "address='$address', teacher_gender='$gender', teacher_salary='$salary', ";
                                    $query .= "image='$new_img'";
                                    $query .= "WHERE teacher_id='$cid' AND fk_client_id='$client' AND teacher_status='1'";

                                    $get = query($query);
                                    if ($get) {
                                        // code to add admin_log into the database
                                        $adm_id = escape($_SESSION['login_id']);
                                        $result = sql_where('admin', 'admin_id', $adm_id);
                                        $fetch = mysqli_fetch_assoc($result);
                                        $id = escape($_SESSION['login_id']);
                                        $admin_name = escape($_SESSION['login_name']);
                                        $log = "Admin <strong>$admin_name</strong> updated profile of teacher <strong>$name</strong> !";
                                        $time = date('d/m/Y h:i a', time());
                                        $time = (string) $time;

                                        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$time', '$client')";
                                        $pass_query2 = mysqli_query($conn, $query);
                                        if (!$pass_query2) {
                                            echo "Error: " . mysqli_error($conn);
                                        }
                                        redirect("./edit-teacher.php?id=$cid");
                                    }
                                } else { // if the teacher id is already associated to another staff member
                                    $message = "Id# '$school_id' is assigned to another staff member.";
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
                            } else { // if the teacher id is already associated to another teacher
                                $message = "Id# '$school_id' is assigned to another teacher.";
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
                    } else { // if the phone_no already exists in the staff_profile
                        $message = "Phone# '$phone_no' is already associated to another staff member.";
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
                } else { // if the phone_no already exists in the teacher_profile
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
            } else { // if the cnic already exists in the staff_profile
                $message = "Cnic '$cnic' is already associated to another staff member.";
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
        } else { // if the cnic already exists in the teacher_profile
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

    <section class="section profile">
        <div class="row">
            <?php
            // if there is a message
            if ($message != '') {
            ?>
                <div class="col-sm-12">
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
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <?php
                        // displaying the image
                        if (!empty($row['image'])) {
                        ?>
                            <img src="./uploads/teachers-profile/<?php echo $row['image']; ?>" alt="Profile">
                        <?php
                        } else {
                        ?>
                            <img src="./uploads/teachers-profile/teacher-profile-default-image.jpeg" alt="Profile">
                        <?php
                        }
                        ?>
                        <!-- <img src="images/profile.jpeg" alt="Profile" class="rounded-circle"> -->
                        <h2><?php echo $row['name']; ?></h2>
                        <h3>Qualification: <?php echo $row['qualification']; ?></h3>
                        <!-- <div class="dropdown">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Link 1</a></li>
                            <li><a class="dropdown-item" href="#">Link 2</a></li>
                            <li><a class="dropdown-item" href="#">Link 3</a></li>
                        </ul>
                        </div> -->

                        <!-- <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div> -->
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="justify-content-start">
                        <a href="./teacher-profile.php" class="btn btn-sm btn-success mb-3">Add new Teacher</a>
                    </div>
                    <div class="justify-content-end">
                        <a href="./view-teacher.php?id=<?php echo $id; ?>" class="btn btn-sm btn-success mb-3">View this profile</a>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <!-- <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">School Profile</button>
                            </li> -->
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Teacher</button>
                            </li>
                        </ul>

                        <div class="tab-pane fade active show profile-edit pt-3" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-lg-3 col-form-label"><strong>Teacher Photo</strong> </label>
                                    <div class="col-md-8 col-lg-9">
                                        <div class="text-start">
                                            <img id="imagePreview" src="https://via.placeholder.com/100" alt="Image Preview" class="rounded mb-2" style="max-width: 200px;">
                                        </div>
                                        <div class="justify-content-start">
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
                                    <label for="name" class="col-md-4 col-lg-3 col-form-label"><strong>Name</strong></label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="name" type="text" class="form-control" id="fullName" value="<?php echo ($name == '') ? $row['name'] : $name; ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="school_id" class="col-md-4 col-lg-3 col-form-label"><strong>Teacher Id</strong></label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="school_id" type="text" class="form-control" id="fullName" value="<?php echo ($school_id == '') ? $row['school_id'] : $school_id; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="cnic" class="col-md-4 col-lg-3 col-form-label"><strong>CNIC</strong></label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="cnic" type="text" class="form-control" id="Address" value="<?php echo ($cnic == '') ? $row['cnic'] : $cnic; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="teacher_gender" class="col-md-4 col-lg-3 col-form-label"><strong>Gender</strong></label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="teacher_gender" type="text" class="form-control" id="Address" value="<?php echo ($gender == '') ? $row['teacher_gender'] : $gender; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="dob" class="col-md-4 col-lg-3 col-form-label"><strong>Date of Birth</strong></label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="dob" type="date" class="form-control" id="Phone" value="<?php echo ($dob == '') ? $row['dob'] : $dob; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="qualification" class="col-md-4 col-lg-3 col-form-label"><strong>Qualification</strong></label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="qualification" type="text" class="form-control" id="Job" value="<?php echo ($qualification == '') ? $row['qualification'] : $qualification; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="f_name" class="col-md-4 col-lg-3 col-form-label"><strong>Father Name</strong></label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="f_name" type="text" class="form-control" id="Country" value="<?php echo ($f_name == '') ? $row['f_name'] : $f_name; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="phone_no" class="col-md-4 col-lg-3 col-form-label"><strong>Phone#</strong></label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="phone_no" type="text" class="form-control" id="Email" value="<?php echo ($phone_no == '') ? $row['phone_no'] : $phone_no; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-lg-3 col-form-label"><strong>Email</strong></label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="Email" value="<?php echo ($email == '') ? $row['email'] : $email; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="address" class="col-md-4 col-lg-3 col-form-label"><strong>Address</strong></label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="address" type="text" class="form-control" id="Email" value="<?php echo ($address == '') ? $row['address'] : $address; ?>" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="teacher_salary" class="col-md-4 col-lg-3 col-form-label"><strong>Salary</strong></label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="teacher_salary" type="text" class="form-control" id="Email" value="<?php echo ($salary == '') ? $row['teacher_salary'] : $salary; ?>" required>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <a class="btn btn-sm btn-outline-danger" href="./teachers.php">Cancel</a>
                                    <button type="submit" name="submit" class="btn btn-sm btn-success">Update Profile</button>
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