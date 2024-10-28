<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// checking the approprite access
if ($level == 'developer') {
    redirect("./");
}
?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);

// admin id
$amdin_id = escape($_SESSION['login_id']);

// the query
$query = "SELECT * FROM admin WHERE admin_id='$amdin_id' AND fk_client_id='$client'";
$get_admin = query($query);

$fetch = mysqli_fetch_assoc($get_admin);
$admin_name = $fetch['admin_name'];
$admin_email = $fetch['email'];
$admin_password = $fetch['password'];

?>

<?php
$message = "";
// form submission for update password
if (isset($_POST['submit'])) {
    $old_pass = escape($_POST['old_password']);
    $old_pass = md5($old_pass);

    // if old password is correct
    if ($old_pass == $admin_password) {
        $new_pass = escape($_POST['new_password']);
        $confirm_pass = escape($_POST['confirm_password']);
        if ($new_pass == $confirm_pass) {
            $new_pass = md5($new_pass);
            $query = "UPDATE admin SET password='$new_pass' WHERE admin_id='$amdin_id' AND fk_client_id='$client'";
            $update_pass = query($query);
            if ($update_pass) {
                redirect("./admin-profile.php?msg=Your password has been updated successfully!");
            }
        } else {
            $message = "New Password do not match, type again!";
        }
    } else {
        $message = "Your old password is not correct!";
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Admin</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div>

    <!-- End Page Title -->

    <section class="section profile">
        <div class="row">

            <?php
            // if there is a message
            if ($message != '') {
            ?>
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger">
                                <strong>
                                    <?php echo $message; ?>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <?php
            // if there is a message
            if (isset($_GET['msg'])) {
            ?>
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-success">
                                <strong>
                                    <?php echo $_GET['msg']; ?>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="col-xl-4">

                <div class="card custom-card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <!-- class="rounded-circle" -->
                        <!-- style="width: 300px; height: 150px;" -->
                        <img src="./images/school-admin-default-profile-image.jpg" width="200px" height="200px" alt="Profile">
                        <h2 class=""><?php echo $admin_name; ?></h2>
                        <h3><?php echo $admin_email; ?></h3>
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
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Change Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    <form action="" method="post">

                                        <div class="row mb-3">
                                            <label for="old_password" class="col-4 col-form-label"><strong>Old Password <code>*</code></strong></label>
                                            <div class="col-8">
                                                <input name="old_password" type="password" class="form-control" id="old_password" placeholder="***********" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="new_password" class="col-4 col-form-label"><strong>New Password <code>*</code></strong></label>
                                            <div class="col-8">
                                                <input name="new_password" type="password" class="form-control" id="new_password" placeholder="***********" minlength="8" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="confirm_password" class="col-4 col-form-label"><strong>Confirm Password <code>*</code></strong></label>
                                            <div class="col-8">
                                                <input name="confirm_password" type="password" class="form-control" id="confirm_password" placeholder="***********" required>
                                            </div>
                                        </div>

                                        <div class="text-end mt-4">
                                            <button type="submit" name="submit" class="btn btn-sm btn-success">Change Password</button>
                                        </div>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>