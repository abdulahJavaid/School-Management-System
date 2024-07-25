<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $cnic = $_POST['cnic'];
    $f_name = $_POST['f_name'];
    $phone_no = $_POST['phone_no'];
    $class = $_POST['class'];
    $section = $_POST['section'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $issue_code = $_POST['issue_code'];
    $password = $_POST['password'];

    $query = "INSERT INTO student_profile(name, cnic, f_name, phone_no, class, section, dob, address, issue_code, password) 
VALUES('$name', '$cnic', '$f_name', '$phone_no', '$class', '$section', '$dob', '$address', '$issue_code', '$password')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "data has been successfully inserted";
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

                                <!-- Profile Edit Form -->

                                <!-- <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                  <div class="col-md-8 col-lg-9">
                    <img src="images/school-profile.svg" alt="Profile">
                    <div class="pt-2">
                      <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                      <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                    </div>
                  </div>
                </div> -->
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Student Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="fullName" value="" placeholder="Enter Student Name">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="cnic" class="col-md-4 col-lg-3 col-form-label">CNIC/B-FORM</label>
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
                                        <label for="class" class="col-md-4 col-lg-3 col-form-label">Class</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="class" type="text" class="form-control" id="Country" value="" placeholder="Enter class">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="section" class="col-md-4 col-lg-3 col-form-label">Section</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="section" type="text" class="form-control" id="Address" value="" placeholder="Enter section">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="dob" class="col-md-4 col-lg-3 col-form-label">Date Of Birth</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="dob" type="date" class="form-control" id="Phone" value="" placeholder="Date of birth">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="Email" value="" placeholder="Enter Address">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="issue_code" class="col-md-4 col-lg-3 col-form-label">Issue code</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="issue_code" type="text" class="form-control" id="Twitter" value="" placeholder="Enter issue code">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="text" class="form-control" id="Facebook" value="" placeholder="Enter password">
                                        </div>
                                    </div>



                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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