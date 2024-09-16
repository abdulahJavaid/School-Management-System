<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Teachers</h1>
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
                    <a class="btn btn-success" href="./teacher-profile.php">Add Teacher</a>
                </div>
            </div>
        </div>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Teachers Details</h5>
                        <p>Teacher Details of All the registered Teacher of <code><?php echo $_SESSION['school_name']; ?></code>.</p>

                        <!-- Primary Color Bordered Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered border-primary table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Teacher Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Qualification</th>
                                        <th scope="col">Date of Birth</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Email</th>
                                        <!-- <th scope="col">Assign Classes</th> -->
                                        <th scope="col">See Profile</th>
                                        <th scope="col">Edit Profile</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //     // Selecting all teacher records from database
                                    $quer = "SELECT * FROM teacher_profile WHERE teacher_status='1' AND fk_client_id='$client'";
                                    $get = query($quer);
                                    while ($row = mysqli_fetch_assoc($get)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['school_id']; ?></td><!--scope="row" -->
                                            <td><?php echo $row['name']; ?></td>

                                            <td><?php echo $row['qualification']; ?></td>

                                            <td><?php echo $row['dob']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <!-- assigning the teacher to a class goes here -->
                                            <td><a href="view-teacher.php?id=<?php echo $row['teacher_id']; ?>">View profile</a></td>
                                            <td><a href="edit-teacher.php?id=<?php echo $row['teacher_id']; ?>">Edit profile</a></td>

                                        </tr>
                                    <?php
                                    } // end of while loop - fetching teacher records
                                    // }
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
<script>
    //     function keepDropdownOpen(event, url) {
    //     event.preventDefault(); // Prevent the link from being followed
    //     event.stopPropagation(); // Prevent the dropdown from closing
    //     window.location.href = url; // Manually navigate to the URL
    // }
    // function keepDropdownOpen(event, url) {
    //     event.preventDefault(); // Prevent the link from being followed
    //     event.stopPropagation(); // Prevent the dropdown from closing

    //     // Delay the navigation to keep the dropdown open briefly
    //     setTimeout(function() {
    //         window.location.href = url;
    //     }, 20000000); // 200 milliseconds delay
    // }
</script>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>