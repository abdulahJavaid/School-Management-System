<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>
<?php
// if the get request is not set
if (!isset($_GET['id'])) {
  redirect('./students.php');
}
?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Edit Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
        <li class="breadcrumb-item active">School name here</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <?php
  // updating student
  if ("")


  ?>




  <?php
// fetching the student data here
$id = $_GET['id'];
$query = "SELECT * FROM all_classes ";
$query .= "INNER JOIN class_sections ON all_classes.class_id = class_sections.fk_class_id ";
$query .= "INNER JOIN student_class ON class_sections.section_id = student_class.fk_section_id ";
$query .= "INNER JOIN student_profile ON student_class.fk_student_id = student_profile.student_id ";
$query .= "WHERE student_id = '$id'";
$pass = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($pass);
  ?>

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="images/profile.jpeg" alt="Profile" class="rounded-circle">
            <h2><?php echo $row['name']; ?></h2>
            <h3><?php echo $row['address']; ?></h3>
            <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
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
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

              <!-- <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
            </li> -->

            </ul>

            <div class="tab-pane fade active show profile-edit pt-3" id="profile-edit">

              <!-- Profile Edit Form -->
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                  <div class="col-md-8 col-lg-9">
                    <img src="images/school-profile.svg" alt="Profile">
                    <div class="pt-2">
                      <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                      <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="name" type="text" class="form-control" id="fullName" value="<?php echo $row['name']; ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Registration#</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="roll_no" type="text" class="form-control" id="fullName" value="<?php echo $row['roll_no']; ?>">
                  </div>
                </div>

                <!-- <div class="row mb-3">
                  <label for="about" class="col-md-4 col-lg-3 col-form-label">Registration#</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="roll_no" class="form-control" id="about" style="height: 100px">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
                  </div>
                </div> -->

                <div class="row mb-3">
                  <label for="company" class="col-md-4 col-lg-3 col-form-label">Class</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="class_name" type="text" class="form-control" id="company" value="<?php echo $row['class_name']; ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="company" class="col-md-4 col-lg-3 col-form-label">Section</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="section_name" type="text" class="form-control" id="company" value="<?php echo $row['section_name']; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Job" class="col-md-4 col-lg-3 col-form-label">Cnic/B-form</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="cnic" type="text" class="form-control" id="Job" value="<?php echo $row['cnic']; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Country" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="dob" type="text" class="form-control" id="Country" value="<?php echo $row['dob']; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="address" type="text" class="form-control" id="Address" value="<?php echo $row['address']; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Mobile#</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="mobile_no" type="text" class="form-control" id="Phone" value="<?php echo $row['mobile_no']; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email" type="email" class="form-control" id="Email" value="<?php echo $row['email']; ?>">
                  </div>
                </div>

                <!-- <div class="row mb-3">
                  <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/#">
                  </div>
                </div> -->

                <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
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