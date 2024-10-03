<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">
  <?php
  $client = escape($_SESSION['client_id']);
  $query = "SELECT * FROM school_profile_ WHERE client_id='$client'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
  }
  if ($result->num_rows > 0) {
    // Fetch data
    $row = $result->fetch_assoc();
    $img = $row['image'];
    $sub_amount = $row['sub_amount'];
    $codsmine_stake = $row['codsmine_stake'];
    $client_id = $row['client_id'];
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
    <h1>Profile</h1>
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

        <div class="card custom-card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

          <!-- class="rounded-circle" -->
          <!-- style="width: 300px; height: 150px;" -->
          <?php
          if (!empty($img)) {
          ?>
            <img src="uploads/school-profile-uploads/<?php echo $img; ?>" width="200px" height="200px" alt="Profile">
            <?php } else { ?>
              <img src="uploads/school-profile-uploads/default-school-profile-image.jpg" width="200px" height="200px" alt="Profile">
              <?php } ?>
            <h2 class=""><?php echo $name; ?></h2>
            <h3><?php echo $address; ?></h3>
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
        <div class="custom-profile">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">School Profile</button>
                </li>
                <?php
                // if the login access is developer
                if ($level == 'developer') {
                ?>
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                  </li>
                <?php } ?>

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
                    <div class="col-lg-3 col-md-4 label "><strong>Client Id</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $client_id; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label "><strong>School Name</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $name; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label "><strong>Owner Name</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $o_name; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>School Slogan</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $slogan; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>School Type</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $private; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Address</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $address; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>City</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $city; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Contact No</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $contact; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Email</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $email; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"><strong>Subscription</strong></div>
                    <div class="col-lg-9 col-md-8">Rs.<?php echo $sub_amount; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label "><strong>Expiry Date</strong></div>
                    <div class="col-lg-9 col-md-8"><?php echo $expiry; ?></div>
                  </div>

                </div>

              </div>

              <div class="tab-content pt-2">
                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <form action="backend/add-school-info.php" method="post" enctype="multipart/form-data">
                    <!-- <div class="row mb-3">
                      <label for="image" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="image" type="file" class="form-control" id="fullName" placeholder="Profile Image" required>
                      </div>
                      <img src="images/school-profile.svg" alt="Profile">
                      <div class="pt-2">
                        <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                      </div>
                    </div> -->

                    <div class="row mb-3">
                      <label for="image" class="col-md-4 col-lg-3 col-form-label"><strong>Upload Photo</strong> </label>
                      <div class="col-md-8 col-lg-9">
                        <div class="text-center">
                          <img id="imagePreview" src="https://via.placeholder.com/100" alt="Image Preview" class="rounded mb-2" style="max-width: 200px;">
                        </div>
                        <div class="d-flex justify-content-center">
                          <input type="file" name="image" class="form-control d-none" id="fileInput" onchange="previewImage(event)">
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
                      <label for="about" class="col-md-4 col-lg-3 col-form-label"><strong>About School</strong></label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"><?php echo $about; ?></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="client_id" class="col-md-4 col-lg-3 col-form-label"><strong>Client Id</strong></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="client_id" type="text" class="form-control" id="fullName" placeholder="Enter School Id" value="<?php echo $client_id; ?>" readonly>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="sub_amount" class="col-md-4 col-lg-3 col-form-label"><strong>Subscription</strong></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="sub_amount" type="text" class="form-control" id="fullName" placeholder="Rs." value="<?php echo $sub_amount; ?>" readonly>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="codsmine_stake" class="col-md-4 col-lg-3 col-form-label"><strong>CodsMine stake</strong></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="codsmine_stake" type="text" class="form-control" id="fullName" placeholder="Percentage" value="<?php echo $codsmine_stake; ?>" readonly>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="name" class="col-md-4 col-lg-3 col-form-label"><strong>School Name</strong></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="fullName" placeholder="Enter School Name" value="<?php echo $name; ?>" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="o_name" class="col-md-4 col-lg-3 col-form-label"><strong>Owner Name</strong></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="o_name" type="text" class="form-control" id="fullName" placeholder="Enter Owner  Name" value="<?php echo $o_name; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="slogan" class="col-md-4 col-lg-3 col-form-label"><strong>School Slogan</strong></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="slogan" type="text" class="form-control" id="fullName" placeholder="Enter School Slogan" value="<?php echo $slogan; ?>">
                      </div>
                    </div>



                    <div class="row mb-3">
                      <label for="private" class="col-md-4 col-lg-3 col-form-label"><strong>School Type</strong></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="private" type="text" class="form-control" id="company" placeholder="School Type" value="<?php echo $private; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="address" class="col-md-4 col-lg-3 col-form-label"><strong>Address</strong></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Job" placeholder="School Location" value="<?php echo $address; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="city" class="col-md-4 col-lg-3 col-form-label"><strong>City</strong></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="city" type="text" class="form-control" id="Country" placeholder="Enter city" value="<?php echo $city; ?>" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Contact" class="col-md-4 col-lg-3 col-form-label"><strong>Contact No</strong></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="contact" type="text" class="form-control" id="Address" placeholder="Enter contact no" value="<?php echo $contact; ?>">
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label"><strong>Email</strong></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" placeholder="Email address" value="<?php echo $email; ?>">
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="expiry" class="col-md-4 col-lg-3 col-form-label"><strong>Expiry Date</strong></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="expiry" type="date" class="form-control" id="Email" placeholder="Expiry Date" value="<?php echo $expiry; ?>">
                      </div>
                    </div>

                    <div class="text-center mt-4">
                      <button type="submit" name="submit" class="btn btn-sm btn-success">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

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

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>