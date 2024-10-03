<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php



?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Syllabus MCQS</h1>
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
                
<h1 class="syllabus-h"><b>Choose Class</b></h1>
<br>
<ul class="decoration">
    <li class="de-li"><a class="style" href="10thclass.php">10<sup>th</sup> Class</a></li>
    <br>
    <li class="de-li"><a class="style" href="9thclass.php">9<sup>th</sup> Class</a></li>
</ul>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>