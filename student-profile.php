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
    $class = escape($class);
    $section = escape($section);

    $name = escape($_POST['name']);
    $cnic = escape($_POST['cnic']);
    $f_name = escape($_POST['f_name']);
    $f_cnic = escape($_POST['f_cnic']);
    $mobile_no = escape($_POST['mobile_no']);
    $dob = escape($_POST['dob']);
    $address = escape($_POST['address']);
    $roll_no = escape($_POST['roll_no']);
    $email = escape($_POST['email']);
    $password = escape('12345');
    $fee_amount = escape($_POST['fee_amount']);

    if (isset($_FILES['std_img'])) {
        $tmp_img = $_FILES['std_img']['tmp_name'];
        $img = basename($_FILES['std_img']['name']);

        move_uploaded_file($tmp_img, "./uploads/students-profile/" . $img . "");
        $new_img = $email . $roll_no . $img;
        rename("./uploads/students-profile/" . $img . "", "./uploads/students-profile/" . $new_img . "");
    }

    $query = "INSERT INTO student_profile(name, cnic, mobile_no, dob, ";
    $query .= "address, roll_no, email, password, fee_amount, father_name, father_cnic, image) ";
    $query .= "VALUES('$name', '$cnic', '$mobile_no', '$dob', ";
    $query .= "'$address', '$roll_no', '$email', '$password', '$fee_amount', '$f_name', '$f_cnic', '$new_img')";
    $pass_query = mysqli_query($conn, $query);

    if ($pass_query) {
        // getting student id
        $gets = "SELECT student_id FROM student_profile WHERE name='$name' AND cnic='$cnic' AND father_name='$f_name' ";
        $gets .= "AND roll_no='$roll_no'";
        $get2 = query($gets);
        $get_r2 = mysqli_fetch_assoc($get2);
        $student_id = $get_r2['student_id'];
        // $student_id = mysqli_insert_id($conn);
        $queri = "INSERT INTO student_class(fk_student_id, fk_class_id, fk_section_id) ";
        $queri .= "VALUES('$student_id', '$class', '$section')";

        $pass_queri = mysqli_query($conn, $queri);

        if ($pass_queri) {
            // code to add admin_log into the database
            $adm_id = escape($_SESSION['login_id']);
            $result = sql_where('admin', 'admin_id', $adm_id);
            $fetch = mysqli_fetch_assoc($result);
            $id = escape($_SESSION['login_id']);
            $admin_name = escape($_SESSION['login_name']);
            $log = "Admin <strong>id: $id</strong>, <strong>name: $admin_name</strong> added <strong>student: $name</strong> to Database!";
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
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
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
                                                <input type="file" name="std_img" class="form-control d-none" id="fileInput" required onchange="previewImage(event)">
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
                                            <input name="name" type="text" class="form-control" id="fullName" value="" placeholder="Full name" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="cnic" class="col-md-4 col-lg-3 col-form-label"><strong>CNIC/B-FORM</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="cnic" type="text" class="form-control" id="fullName" value="" placeholder="CNIC/Form-B" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="cnic" class="col-md-4 col-lg-3 col-form-label"><strong>Date of Birth</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="dob" type="date" class="form-control" id="fullName" value="" placeholder="DOB" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="f_name" class="col-md-4 col-lg-3 col-form-label"><strong>Father Name</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="f_name" type="text" class="form-control" id="fullName" value="" placeholder="Father name" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="f_cnic" class="col-md-4 col-lg-3 col-form-label"><strong>Father CNIC</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="f_cnic" type="text" class="form-control" id="fullName" value="" placeholder="Father cnic" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="address" class="col-md-4 col-lg-3 col-form-label"><strong>Address</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="fullName" value="" placeholder="Home address" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone_no" class="col-md-4 col-lg-3 col-form-label"><strong>Phone#</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="mobile_no" type="text" class="form-control" id="Job" value="" placeholder="Phone number" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="class" class="col-md-4 col-lg-3 col-form-label"><strong>Email</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Country" value="" placeholder="Email address" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="class" class="col-md-4 col-lg-3 col-form-label"><strong>Reg no#</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="roll_no" type="text" class="form-control" id="Country" value="" placeholder="Student reg. number" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="class" class="col-md-4 col-lg-3 col-form-label"><strong>Monthly Fee</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fee_amount" type="text" class="form-control" id="Country" value="" placeholder="Fees in - (Rs)" required>
                                        </div>
                                    </div>
                                    <!-- <div class="row mb-3">
                                        <label for="class" class="col-md-4 col-lg-3 col-form-label">Roll no. <code>*</code></label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="roll_no" type="text" class="form-control" id="Country" value="" placeholder="Enter roll number">
                                        </div>
                                    </div> -->
                                    <div class="row mb-3">
                                        <label for="inputState" class="form-label"><strong>Class</strong> <code>*</code></label>
                                        <div class="col-md-8 col-lg-9 offset-md-3">
                                            <select id="inputState" name="classnsection" class="form-select" required>
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