<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>
<?php
// if the get request is not set
if (!isset($_GET['id'])) {
  redirect('./students.php');
}
?>
<?php
// fetching the student data here
$id = escape($_GET['id']);
$query = "SELECT * FROM all_classes ";
$query .= "INNER JOIN class_sections ON all_classes.class_id = class_sections.fk_class_id ";
$query .= "INNER JOIN student_class ON class_sections.section_id = student_class.fk_section_id ";
$query .= "INNER JOIN student_profile ON student_class.fk_student_id = student_profile.student_id ";
$query .= "WHERE student_id = '$id' AND student_class.status='1'";
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
  // updating student
  if (isset($_POST['submit'])) {
    $cid = escape($_GET['id']);
    $name = escape($_POST['name']);
    $roll_no = escape($_POST['roll_no']);
    $cnic = escape($_POST['cnic']);
    $dob = escape($_POST['dob']);
    $address = escape($_POST['address']);
    $mobile_no = escape($_POST['mobile_no']);
    $email = escape($_POST['email']);
    $f_name = escape($_POST['f_name']);
    $f_cnic = escape($_POST['f_cnic']);
    $fee_amount = escape($_POST['fee_amount']);

    if (isset($_FILES['std_img']) && !empty($_FILES['std_img']['tmp_name'])) {
      $tmp_img = $_FILES['std_img']['tmp_name'];
      $img = basename($_FILES['std_img']['name']);

      unlink("./uploads/students-profile/" . $row['image'] . "");
      move_uploaded_file($tmp_img, "./uploads/students-profile/" . $img . "");
      $new_img = $email . $roll_no . $img;
      rename("./uploads/students-profile/" . $img . "", "./uploads/students-profile/" . $new_img . "");
    } else {
      $new_img = $row['image'];
    }

    $query = "UPDATE student_profile SET name='$name', roll_no='$roll_no', cnic='$cnic', dob='$dob', ";
    $query .= "address='$address', email='$email', mobile_no='$mobile_no', father_name='$f_name', ";
    $query .= "father_cnic='$f_cnic', fee_amount='$fee_amount', image='$new_img' ";
    $query .= "WHERE student_id='$cid'";
    $get = query($query);

    if ($get) {
      // code to add admin_log into the database
      $adm_id = escape($_SESSION['login_id']);
      $result = sql_where('admin', 'admin_id', $adm_id);
      $fetch = mysqli_fetch_assoc($result);
      $id = escape($_SESSION['login_id']);
      $admin_name = escape($_SESSION['login_name']);
      $log = "Admin <strong>$admin_name</strong> updated profile of student <strong>$name</strong> !";
      $time = date('d/m/Y h:i a', time());
      $time = (string) $time;

      $query = "INSERT INTO admin_logs(log_message, time) VALUES('$log', '$time')";
      $pass_query2 = mysqli_query($conn, $query);
      if (!$pass_query2) {
        echo "Error: " . mysqli_error($conn);
      }
      redirect("./edit-student.php?id=$cid");
    }
  }


  ?>

  <!-- <div class="d-flex justify-content-end">
    <a href="./student-profile.php" class="btn btn-sm btn-success mb-3">Add Student</a>
  </div> -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
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
            <a href="./student-profile.php" class="btn btn-sm btn-success mb-3">Add new Student</a>
          </div>
          <div class="justify-content-end">
            <a href="./view-student.php?id=<?php echo $id; ?>" class="btn btn-sm btn-success mb-3">View this profile</a>
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
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Student</button>
              </li>
            </ul>

            <div class="tab-pane fade active show profile-edit pt-3" id="profile-edit">
              <!-- Profile Edit Form -->
              <form action="" method="post" enctype="multipart/form-data">
                <!-- <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                  <div class="col-md-8 col-lg-9">
                    <img src="uploads/students-profile/aaron.jpg" alt="Profile">
                    <div class="pt-2">
                      <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                      <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                    </div>
                  </div>
                </div> -->
                <div class="row mb-3">
                  <label for="name" class="col-md-4 col-lg-3 col-form-label"><strong>Student Photo</strong> </label>
                  <div class="col-md-8 col-lg-9">
                    <div class="text-start">
                      <img id="imagePreview" src="https://via.placeholder.com/100" alt="Image Preview" class="rounded mb-2" style="max-width: 200px;">
                    </div>
                    <div class="justify-content-start">
                      <input type="file" name="std_img" class="form-control d-none" id="fileInput" onchange="previewImage(event)">
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
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><strong>Student Name</strong></label>
                  <div class="col-md-8 col-lg-9">
                    <input name="name" type="text" class="form-control" id="fullName" value="<?php echo $row['name']; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><strong>Registration#</strong></label>
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
                  <label for="Job" class="col-md-4 col-lg-3 col-form-label"><strong>Cnic/B-form</strong></label>
                  <div class="col-md-8 col-lg-9">
                    <input name="cnic" type="text" class="form-control" id="Job" value="<?php echo $row['cnic']; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Country" class="col-md-4 col-lg-3 col-form-label"><strong>Date of Birth</strong></label>
                  <div class="col-md-8 col-lg-9">
                    <input name="dob" type="date" class="form-control" id="Country" value="<?php echo $row['dob']; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><strong>Father Name</strong></label>
                  <div class="col-md-8 col-lg-9">
                    <input name="f_name" type="text" class="form-control" id="fullName" value="<?php echo $row['father_name']; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><strong>Father Cnic</strong></label>
                  <div class="col-md-8 col-lg-9">
                    <input name="f_cnic" type="text" class="form-control" id="fullName" value="<?php echo $row['father_cnic']; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Address" class="col-md-4 col-lg-3 col-form-label"><strong>Address</strong></label>
                  <div class="col-md-8 col-lg-9">
                    <input name="address" type="text" class="form-control" id="Address" value="<?php echo $row['address']; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Phone" class="col-md-4 col-lg-3 col-form-label"><strong>Phone#</strong></label>
                  <div class="col-md-8 col-lg-9">
                    <input name="mobile_no" type="text" class="form-control" id="Phone" value="<?php echo $row['mobile_no']; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label"><strong>Email</strong></label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email" type="email" class="form-control" id="Email" value="<?php echo $row['email']; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Phone" class="col-md-4 col-lg-3 col-form-label"><strong>Monthly Fee</strong></label>
                  <div class="col-md-8 col-lg-9">
                    <input name="fee_amount" type="text" class="form-control" id="Phone" value="<?php echo $row['fee_amount']; ?>">
                  </div>
                </div>

                <!-- <div class="row mb-3">
                  <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
                  </div>
                </div> -->

                <div class="text-end">
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