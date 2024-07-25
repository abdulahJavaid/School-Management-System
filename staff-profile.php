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
    $issue_code = $_POST['issue_code'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $staff_status = $_POST['staff_status'];

    $query = "INSERT INTO teacher_profile(name, cnic, f_name, phone_no, qualification, issue_code, address, dob, password, staff_status) 
VALUES('$name', '$cnic', '$f_name', '$phone_no', '$qualification', '$issue_code', '$address', '$dob', '$password', '$staff_status')";
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
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Staff Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="fullName" value="" placeholder="Enter Staff Name">
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
                                        <label for="issue_code" class="col-md-4 col-lg-3 col-form-label">Issue code</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="issue_code" type="text" class="form-control" id="Address" value="" placeholder="Enter section">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="Phone" value="" placeholder="Date your Address">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="dob" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="dob" type="text" class="form-control" id="Email" value="" placeholder="Enter Date of birth">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="text" class="form-control" id="Twitter" value="" placeholder="Enter Password">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="staff_status" class="col-md-4 col-lg-3 col-form-label">Staff ststus</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="staff_status" type="text" class="form-control" id="Facebook" value="" placeholder="Enter your status">
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