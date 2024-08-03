<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $cnic = $_POST['cnic'];
    $f_name = $_POST['f_name'];
    $phone_no = $_POST['phone_no'];
    $qualification = $_POST['qualification'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $school_id = $_POST['school_id'];
    $image = $_POST['image'];
    $password = $_POST['password'];

    $query = "INSERT INTO teacher_profile(name, cnic, f_name, phone_no, qualification, dob, address, email, school_id, image, password) 
VALUES('$name', '$cnic', '$f_name', '$phone_no', '$qualification', '$dob', '$address', '$email', '$school_id', '$image', '$password')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "data has been successfully inserted";
        redirect("./teacher-profile.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>


<main id="main" class="main">


    <div class="pagetitle">
        <h1>School Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
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

                            <!-- <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">School Profile</button>
            </li> -->

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>

                            <!-- <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
            </li> -->

                        </ul>
                        <div class="tab-content pt-2">


                            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                             <form method="post" action="" enctype="multipart/form-data">
                                   
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="fullName" value="" placeholder="Enter Teacher Name">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="cnic" class="col-md-4 col-lg-3 col-form-label">CNIC</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="cnic" type="text" class="form-control" id="fullName" value="" placeholder="Enter CNIC">
                                        </div>
                                    </div>




                                    <div class="row mb-3">
                                        <label for="f_name" class="col-md-4 col-lg-3 col-form-label">Father Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="f_name" type="text" class="form-control" id="company" value="" placeholder="Enter Father Name">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone_no" class="col-md-4 col-lg-3 col-form-label">Phone No.</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone_no" type="text" class="form-control" id="Job" value="" placeholder="Enter Phone No">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="qualification" class="col-md-4 col-lg-3 col-form-label">Qualification</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="qualification" type="text" class="form-control" id="Country" value="" placeholder="Enter Qualification">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="dob" class="col-md-4 col-lg-3 col-form-label">Date of  Birth</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="dob" type="date" class="form-control" id="Address" value="" placeholder="Enter Date of Birth">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="Phone" value="" placeholder="Enter Address">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="text" class="form-control" id="Email" value="" placeholder="Enter Email Address">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <label for="school_id" class="col-md-4 col-lg-3 col-form-label">School Id</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="school_id" type="no" class="form-control" id="Email" value="" placeholder="Enter School Id">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <label for="image" class="col-md-4 col-lg-3 col-form-label">Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="image" type="file" class="form-control" id="Email" value="" placeholder="Upload Image">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="text" class="form-control" id="Twitter" value="" placeholder="Enter Password">
                                        </div>
                                    </div>

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
                                    </div>
 -->


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