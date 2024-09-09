<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>
<?php
// if the get request is not set
if (!isset($_GET['id'])) {
  redirect('./teachers.php');
}
?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>View Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
        <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <?php
  // fetching the student data here
  $id = escape($_GET['id']);
  $query = "SELECT * FROM teacher_profile WHERE teacher_id='$id'";
  $pass = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($pass);
  ?>

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card custom-card">
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
            <a href="./edit-teacher.php?id=<?php echo $id; ?>" class="btn btn-sm btn-success mb-3">Update this profile</a>
          </div>
        </div>

      </div>

      <div class="col-xl-8">
        <div class="custom-profile">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Teacher Profile</button>
                </li>

                <!-- <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
            </li> -->

                <!-- <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
            </li> -->

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <!-- <h5 class="card-title">About</h5>
                <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->

                  <h5 class="card-title">Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label "><strong>Name</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['name']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label "><strong>Teacher Id</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['school_id']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label "><strong>CNIC</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['cnic']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Date of Birth</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['dob']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label "><strong>Gender</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['teacher_gender']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label "><strong>Qualification</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['qualification']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label "><strong>Father Name</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['f_name']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Phone#</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['phone_no']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Email</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['email']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Salary</strong></div>
                    <div class="col-lg-9 col-md-8">Rs.<?php echo $row['teacher_salary']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Address</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['address']; ?></div>
                  </div>

                  <!-- <div class="row">
                  <div class="col-lg-3 col-md-4 label">E-mail</div>
                  <div class="col-lg-9 col-md-8"><?php //echo $row['email']; 
                                                  ?></div>
                </div> -->

                  <!-- <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">k.anderson@example.com</div>
                </div> -->

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                  <!-- Profile Edit Form -->
                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>