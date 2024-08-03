<?php require_once("includes/header.php"); ?>

  <!-- ======= Sidebar ======= -->
  <?php require_once("includes/sidebar.php"); ?>

  <main id="main" class="main">
  <?php
$query = "SELECT * FROM school_profile_ ORDER BY id DESC LIMIT 1";  
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {}
if ($result->num_rows > 0) {
    // Fetch data
    $row = $result->fetch_assoc();
    $school_id = $row['school_id'];
    $about = $row['about'];
    $name = $row['name'];
    $o_name = $row['o_name'];
    $slogan = $row['slogan'];
    $private = $row['private'];
    $address = $row['address'];
    $city = $row['city'];
    $contact = $row['contact'];
    $email = $row['email'];
    $expiry = $row['expiry'];
} else {
    echo "No data found";
}
$conn->close();
?>
<div class="pagetitle">
  <h1>School Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
      <li class="breadcrumb-item active"><?php echo $name; ?></li>
    </ol>
  </nav>
</div>

<!-- End Page Title -->




<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

          <img src="images/savy.png" alt="Profile" class="rounded-circle">
          <h2>School Name</h2>
          <h3><?php echo $name; ?></h3>
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

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">School Profile</button>
            </li>

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


<div class="tab-pane fade show active profile-overview" id="profile-overview">
              <h5 class="card-title">About School</h5>
              <p class="small fst-italic"><?php echo $about; ?></p>

              <h5 class="card-title">School Details</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">School Id</div>
                <div class="col-lg-9 col-md-8"><?php echo $school_id; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">School Name</div>
                <div class="col-lg-9 col-md-8"><?php echo $name; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Owner Name</div>
                <div class="col-lg-9 col-md-8"><?php echo $o_name; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">School Slogan</div>
                <div class="col-lg-9 col-md-8"><?php echo $slogan; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">School Type</div>
                <div class="col-lg-9 col-md-8"><?php echo $private; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Address</div>
                <div class="col-lg-9 col-md-8"><?php echo $address; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">City</div>
                <div class="col-lg-9 col-md-8"><?php echo $city; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Contact No</div>
                <div class="col-lg-9 col-md-8"><?php echo $contact; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8"><?php echo $email; ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Expiry Date</div>
                <div class="col-lg-9 col-md-8"><?php echo $expiry; ?></div>
              </div>

            </div>

</div>

          <div class="tab-content pt-2">          
          <div class="tab-pane fade profile-edit pt-3" id="profile-edit">



              <!-- Profile Edit Form -->
  

              <form action="includes/add-school-info.php" method="post" enctype="multipart/form-data">
              <!-- <div class="row mb-3">
                  <label for="about" class="col-md-4 col-lg-3 col-form-label">About School</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="about" type="text" class="form-control" id="fullName" placeholder="School Descrption" value="<?php //echo $about; ?>"> 
                  </div>
                </div> -->
                <div class="row mb-3">
                  <label for="about" class="col-md-4 col-lg-3 col-form-label">About School</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="about" class="form-control" id="about" style="height: 100px"><?php echo $about; ?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="image" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="image" type="file" class="form-control" id="fullName" placeholder="Profile Image">
                  </div>
                    <!-- <img src="images/school-profile.svg" alt="Profile">
                    <div class="pt-2">
                      <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                      <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                    </div> -->
                  </div>

                  <div class="row mb-3">
                  <label for="school_id" class="col-md-4 col-lg-3 col-form-label">School Id</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="school_id" type="text" class="form-control" id="fullName" placeholder="Enter School Id" value="<?php echo $school_id; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="name" class="col-md-4 col-lg-3 col-form-label">School Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="name" type="text" class="form-control" id="fullName" placeholder="Enter School Name" value="<?php echo $name; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="o_name" class="col-md-4 col-lg-3 col-form-label">Owner Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="o_name" type="text" class="form-control" id="fullName" placeholder="Enter Owner  Name" value="<?php echo $o_name; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="slogan" class="col-md-4 col-lg-3 col-form-label">School Slogan</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="slogan" type="text" class="form-control" id="fullName" placeholder="Enter School Slogan" value="<?php echo $slogan; ?>">
                  </div>
                </div>


                
                <div class="row mb-3">
                  <label for="private" class="col-md-4 col-lg-3 col-form-label">School Type</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="private" type="text" class="form-control" id="company" placeholder="School Type" value="<?php echo $private; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="address" type="text" class="form-control" id="Job" placeholder="School Location" value="<?php echo $address; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="city" class="col-md-4 col-lg-3 col-form-label">City</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="city" type="text" class="form-control" id="Country" placeholder="Enter city" value="<?php echo $city; ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Contact" class="col-md-4 col-lg-3 col-form-label">Contact No</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="contact" type="text" class="form-control" id="Address" placeholder="Ennter contact no" value="<?php echo $contact; ?>">
                  </div>
                </div>


                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email" type="email" class="form-control" id="Email" placeholder="Email address" value="<?php echo $email; ?>">
                  </div>
                </div>

                
                <div class="row mb-3">
                  <label for="expiry" class="col-md-4 col-lg-3 col-form-label">Expiry Date</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="expiry" type="date" class="form-control" id="Email" placeholder="Expiry Date" value="<?php echo $expiry; ?>">
                  </div>
                </div>

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