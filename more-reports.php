<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php

?>

<?php
// checking session for appropriate access
if ($level == 'clerk' || $level == 'super' || $level == 'accountant') {}
else {
  redirect("./");
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>More Features</h1>
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
        </div>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
            <img src="./images/coming-soon-default-image3.svg" height="440px" width="900px" style="border-radius: 10px;" alt="">
                </div>
                <!-- <div class="card">
                    <div class="card-body">
                        

                    </div>
                </div> -->
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>