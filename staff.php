<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>School Staff</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
                <!-- <li class="breadcrumb-item d-flex justify-content-end"></li> -->
            </ol>
        </nav>

    </div><!-- End Page Title -->

    <!-- class and sections -->
    <div class="pagetitle">
        <div class="row">
            <div class="row">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-success" href="./staff-profile.php">Add Staff</a>
                </div>
            </div>
        </div>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Staff Details</h5>
                        <p>Details of all working staff of <code><?php echo $_SESSION['school_name']; ?></code>.</p>

                        <!-- Primary Color Bordered Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered border-primary table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Staff Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Profile</th>
                                        <th scope="col">Profile</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $quer = "SELECT * FROM staff_profile WHERE staff_status='1' AND fk_client_id='$client'";
                                    $get = query($quer);
                                    while ($row = mysqli_fetch_assoc($get)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['staff_school_id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><a href="view-staff.php?id=<?php echo $row['staff_id']; ?>"><u>View</u></a></td>
                                            <td><a href="edit-staff.php?id=<?php echo $row['staff_id']; ?>"><u>Edit</u></a></td>
                                        </tr>
                                    <?php
                                    } // end of while loop - fetching teacher records
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Primary Color Bordered Table -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>