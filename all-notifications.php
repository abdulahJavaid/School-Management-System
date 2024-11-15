<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// if the admin is not super or developer, redirect
if ($level == 'super' || $level == 'developer') {
} else {
    redirect("./");
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Notifications</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Recent</a></li>
                <li class="breadcrumb-item active">Notices</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Right side columns -->
            <div class="col-lg-8">

                <!-- Recent Activity -->
                <div class="card">
                    <!-- <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div> -->

                    <div class="card-body">
                        <h5 class="card-title">Recent Notifications <span>| all</span></h5>

                        <div class="activity">

                            <?php
                            // getting the client id
                            $client = escape($_SESSION['client_id']);
                            // getting the notifications
                            $query = "SELECT * FROM notices WHERE fk_client_id='$client' AND notice_status='school' ORDER BY notice_id DESC";
                            $get_notices = query($query);
                            while ($notices = mysqli_fetch_assoc($get_notices)) {
                            ?>
                                <div class="activity-item d-flex">
                                    <div class="activite-label"><?php echo $notices['notice_date']; ?></div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        <?php echo $notices['notice_description']; ?>
                                    </div>
                                </div><!-- End activity item-->

                            <?php
                            }
                            ?>

                        </div>

                    </div>
                </div><!-- End Recent Activity -->

            </div>

        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>