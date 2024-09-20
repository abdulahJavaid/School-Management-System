<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<?php
// when there is no form submission, for form values
$message = '';
$name = '';
$cnic = '';
$gender = '';
$phone_no = '';
$address = '';
$staff_id = '';
$designation = '';
$salary = '';

if (isset($_POST['submit'])) {
    // assigning post data to the variables
    $name = escape($_POST['name']);
    $cnic = escape($_POST['cnic']);
    $gender = escape($_POST['staff_gender']);
    $phone_no = escape($_POST['phone_no']);
    $address = escape($_POST['address']);
    $staff_id = escape($_POST['staff_school_id']);
    $designation = escape($_POST['staff_designation']);
    $salary = escape($_POST['staff_salary']);

    // checking if the staff id is assigned to another teacher
    $query = "SELECT * FROM teacher_profile WHERE school_id='$staff_id' AND teacher_status='1' AND fk_client_id='$client'";
    $find_tch_id = query($query);
    if (mysqli_num_rows($find_tch_id) == 0) {
        // checking if the staff id assigned to another staff member
        $query = "SELECT * FROM staff_profile WHERE staff_school_id='$staff_id' AND staff_status='1' AND fk_client_id='$client'";
        $find_staff_id = query($query);
        if (mysqli_num_rows($find_staff_id) == 0) {
            // checking if the cnic is already assosiated to another teacher
            $query = "SELECT * FROM teacher_profile WHERE cnic='$cnic' AND teacher_status='1' AND fk_client_id='$client'";
            $find_tch_cnic = query($query);
            if (mysqli_num_rows($find_tch_cnic) == 0) {
                // checking if the cnic is already assosiated to another staff member
                $query = "SELECT * FROM staff_profile WHERE cnic='$cnic' AND staff_status='1' AND fk_client_id='$client'";
                $find_staff_cnic = query($query);
                if (mysqli_num_rows($find_staff_cnic) == 0) {
                    // checking if the phone# is already associated to another teacher
                    $query = "SELECT * FROM teacher_profile WHERE phone_no='$phone_no' AND teacher_status='1' AND fk_client_id='$client'";
                    $find_tch_phone = query($query);
                    if (mysqli_num_rows($find_tch_phone) == 0) {
                        // checking if the phone# is already associated to another staff member
                        $query = "SELECT * FROM staff_profile WHERE phone_no='$phone_no' AND staff_status='1' AND fk_client_id='$client'";
                        $find_staff_phone = query($query);
                        if (mysqli_num_rows($find_staff_phone) == 0) {

                            // channging the picture name and moving to the folder
                            if (isset($_FILES['staff_img']) && !empty($_FILES['staff_img']['tmp_name'])) {
                                $tmp_img = $_FILES['staff_img']['tmp_name'];
                                $img = basename($_FILES['staff_img']['name']);

                                move_uploaded_file($tmp_img, "./uploads/staffs-profile/" . $img . "");
                                // making the picture unique using his/her cnic or his/her father cnic & roll_no
                                if (empty($cnic)) {
                                    $new_img = $client . $staff_id . $img;
                                } else {
                                    $new_img = $client . $cnic . $staff_id . $img;
                                }
                                rename("./uploads/staffs-profile/" . $img . "", "./uploads/staffs-profile/" . $new_img . "");
                            } else {
                                $new_img = '';
                            }
                            $new_img = escape($new_img);

                            // query to add staff
                            $query = "INSERT INTO staff_profile(name, cnic, phone_no, staff_gender, ";
                            $query .= "address, staff_school_id, staff_designation, staff_salary, ";
                            $query .= "image, fk_client_id) ";
                            $query .= "VALUES('$name', '$cnic', '$phone_no', '$gender', ";
                            $query .= "'$address', '$staff_id', '$designation', '$salary', ";
                            $query .= "'$new_img', '$client')";
                            $pass_query = mysqli_query($conn, $query);

                            if ($pass_query) {
                                // code to add admin activity into the logs
                                $adm_id = escape($_SESSION['login_id']);
                                $result = sql_where('admin', 'admin_id', $adm_id);
                                $fetch = mysqli_fetch_assoc($result);
                                $id = escape($_SESSION['login_id']);
                                $admin_name = escape($_SESSION['login_name']);
                                $log = "Admin <strong>$admin_name</strong> added new $designation <strong>$name</strong> !";
                                $time = date('d/m/Y h:i a', time());
                                $time = (string) $time;

                                // adding activity into the logs
                                $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$time', '$client')";
                                $pass_query2 = mysqli_query($conn, $query);
                                if (!$pass_query2) {
                                    echo "Error: " . mysqli_error($conn);
                                } else {
                                    redirect('./staff-profile.php');
                                }
                            } else {
                                $message = "There was an issue adding staff, try again!";
                            }
                        } else { // esle if the phone# is already associated to another staff member
                            $message = "Phone# '$phone_no' is already assosiated to another staff member.";
                            $phone_no = '';
                            $cnic = escape($_POST['cnic']);
                            $staff_id = escape($_POST['staff_school_id']);
                            $name = escape($_POST['name']);
                            $gender = escape($_POST['staff_gender']);
                            $address = escape($_POST['address']);
                            $designation = escape($_POST['staff_designation']);
                            $salary = escape($_POST['staff_salary']);
                        }
                    } else { // esle if the phone# is already associated to another teacher
                        $message = "Phone# '$phone_no' is already assosiated to another teacher.";
                        $phone_no = '';
                        $cnic = escape($_POST['cnic']);
                        $staff_id = escape($_POST['staff_school_id']);
                        $name = escape($_POST['name']);
                        $gender = escape($_POST['staff_gender']);
                        $address = escape($_POST['address']);
                        $designation = escape($_POST['staff_designation']);
                        $salary = escape($_POST['staff_salary']);
                    }
                } else { // else if the cnic already exists in the staff_profile
                    $message = "CNIC '$cnic' is already assosiated to another staff member.";
                    $cnic = '';
                    $staff_id = escape($_POST['staff_school_id']);
                    $name = escape($_POST['name']);
                    $gender = escape($_POST['staff_gender']);
                    $phone_no = escape($_POST['phone_no']);
                    $address = escape($_POST['address']);
                    $designation = escape($_POST['staff_designation']);
                    $salary = escape($_POST['staff_salary']);
                }
            } else { // else if the cnic already exists in the teacher_profile
                $message = "CNIC '$cnic' is already assosiated to another teacher.";
                $cnic = '';
                $staff_id = escape($_POST['staff_school_id']);
                $name = escape($_POST['name']);
                $gender = escape($_POST['staff_gender']);
                $phone_no = escape($_POST['phone_no']);
                $address = escape($_POST['address']);
                $designation = escape($_POST['staff_designation']);
                $salary = escape($_POST['staff_salary']);
            }
        } else { // else if the staff id is already assigned to another staff member
            $message = "Id# '$staff_id' is assigned to another staff member.";
            $staff_id = '';
            $name = escape($_POST['name']);
            $cnic = escape($_POST['cnic']);
            $gender = escape($_POST['staff_gender']);
            $phone_no = escape($_POST['phone_no']);
            $address = escape($_POST['address']);
            $designation = escape($_POST['staff_designation']);
            $salary = escape($_POST['staff_salary']);
        }
    } else { // else if the staff id is already assigned to another teacher
        $message = "Id# '$staff_id' is assigned to another teacher.";
        $staff_id = '';
        $name = escape($_POST['name']);
        $cnic = escape($_POST['cnic']);
        $gender = escape($_POST['staff_gender']);
        $phone_no = escape($_POST['phone_no']);
        $address = escape($_POST['address']);
        $designation = escape($_POST['staff_designation']);
        $salary = escape($_POST['staff_salary']);
    }
}
?>


<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add Staff</h1>
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
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Add Staff</button>
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
                                                <input type="file" name="staff_img" class="form-control d-none" id="fileInput" onchange="previewImage(event)">
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
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label"><strong>Staff Name</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="fullName" value="<?php echo ($name == '') ? '' : $name; ?>" placeholder="Full name" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="cnic" class="col-md-4 col-lg-3 col-form-label"><strong>CNIC</strong> </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="cnic" type="text" class="form-control" id="fullName" value="<?php echo ($cnic == '') ? '' : $cnic; ?>" placeholder="CNIC">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="staff_gender" class="col-md-4 col-lg-3 col-form-label"><strong>Gender</strong> </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="staff_gender" type="text" class="form-control" id="fullName" value="<?php echo ($gender == '') ? '' : $gender; ?>" placeholder="male/female">
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
                                            <input name="phone_no" type="text" class="form-control" id="Job" value="<?php echo ($phone_no == '') ? '' : $phone_no; ?>" placeholder="Phone number" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="staff_school_id" class="col-md-4 col-lg-3 col-form-label"><strong>Staff Id</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="staff_school_id" type="text" class="form-control" id="Country" value="<?php echo ($staff_id == '') ? '' : $staff_id; ?>" placeholder="Staff Id" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="staff_designation" class="col-md-4 col-lg-3 col-form-label"><strong>Designation</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="staff_designation" type="text" class="form-control" id="Country" value="<?php echo ($designation == '') ? '' : $designation; ?>" placeholder="eg: Watchman" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="staff_salary" class="col-md-4 col-lg-3 col-form-label"><strong>Staff Salary</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="staff_salary" type="text" class="form-control" id="Country" value="<?php echo ($salary == '') ? '' : $salary; ?>" placeholder="Rs." required>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-sm btn-success">Add Staff</button>
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