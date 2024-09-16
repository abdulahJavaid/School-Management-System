<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Logs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Recent</a></li>
                <li class="breadcrumb-item active">Activities</li>
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
                        <h5 class="card-title">Recent Activity <span>| all actions</span></h5>

                        <div class="activity">

                            <?php
                            // fetching recent 5 actions
                            $client = escape($_SESSION['client_id']);
                            $query = "SELECT * FROM admin_logs WHERE fk_client_id='$client' ORDER BY admin_log_id DESC";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <div class="activity-item d-flex">
                                    <div class="activite-label"><?php echo $row['time']; ?></div>
                                    <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                    <div class="activity-content">
                                        <?php echo $row['log_message']; ?>
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