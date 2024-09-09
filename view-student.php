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
    <h1>View Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <?php
  // fetching the student data here
  $id = escape($_GET['id']);
  $query = "SELECT * FROM all_classes ";
  $query .= "INNER JOIN class_sections ON all_classes.class_id = class_sections.fk_class_id ";
  $query .= "INNER JOIN student_class ON class_sections.section_id = student_class.fk_section_id ";
  $query .= "INNER JOIN student_profile ON student_class.fk_student_id = student_profile.student_id ";
  $query .= "WHERE student_id = '$id' AND status='1'";
  $pass = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($pass);
  ?>


  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">
        <div class="card custom-card">
          <div class="card-body profile-card d-flex flex-column align-items-center">
            <?php
            // displaying the image
            if (!empty($row['image'])) {
            ?>
              <img src="./uploads/students-profile/<?php echo $row['image']; ?>" alt="Profile">
            <?php
            } else {
            ?>
              <img src="./uploads/students-profile/student-profile-default-image.jpg" alt="Profile">
            <?php
            }
            ?>
            <h2><?php echo $row['name']; ?></h2>
            <h3>Class: <?php echo $row['class_name'] . ' ' . $row['section_name']; ?></h3>
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
            <a href="./student-profile.php" class="btn btn-sm btn-success mb-3">Add new Student</a>
          </div>
          <div class="justify-content-end">
            <a href="./edit-student.php?id=<?php echo $id; ?>" class="btn btn-sm btn-success mb-3">Update this profile</a>
          </div>
        </div>

      </div>

      <div class="col-xl-8">
        <div class="custom-profile">
          <div class="card">
            <div class="card-body pt-3">
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Student Profile</button>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Details</h5>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Name</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['name']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Registration#</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['roll_no']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Class</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['class_name'] . " " . $row['section_name']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Cnic/B-form</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['cnic']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Date of Birth</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['dob']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Gender</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['student_gender']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Father Name</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['father_name']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Father Cnic</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['father_cnic']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Phone#</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['mobile_no']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>E-mail</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['email']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Monthly Fee</strong></div>
                    <div class="col-lg-9 col-md-8">Rs.<?php echo $row['fee_amount']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Address</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['address']; ?></div>
                  </div>
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