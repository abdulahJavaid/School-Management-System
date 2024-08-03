<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting teacher name
$id = $_GET['id'];
$query = "SELECT name FROM teacher_profile WHERE teacher_id = '$id'";
$result = query($query);
$get_r = mysqli_fetch_assoc($result);
$t_name = $get_r['name'];


?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Assign Classes</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active">School name here</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">


            <div class="col-xl-12">

                <div class="card">
                    <div class="card-body pt-3">

                        <div class="row">
                            <?php
                                // code to get all classes and sections
                                $query = "SELECT * FROM all_classes";
                                $result = query($query);
                                while($row = mysqli_fetch_assoc($result)){
                                    $cid = $row['class_id'];
                                    $query = "SELECT * FROM class_sections WHERE fk_class_id = '$cid'";
                                    $result1 = query($query);
                                    while($row1 = mysqli_fetch_assoc($result1)){
                            ?>
                            <div class="col-md-3">
                                <div class="card">
                                    <!-- <img src="" class="card-img-top" alt="..."> -->
                                    <div class="card-body">
                                        <h5 class="card-title">Class: <?php echo $row['class_name'] . " " . $row1['section_name']; ?></h5>

                                        <div class="row mb-3">
                                            <!-- <div class="col-md-8 col-lg-9"> -->
                                            <input name="name" type="text" class="form-control" id="fullName" placeholder="Enter Subject">

                                        </div>
                                        <div class="row mb-3">
                                            <button type="submit" class="btn btn-sm btn-primary button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Assign class to teacher: <?php echo $t_name; ?>">
                                                Assign
                                            </button>
                                        </div>


                                        <!-- </div> -->

                                        <!--  -->
                                    </div>
                                </div>
                            </div>
                            <?php
                                }}
                            ?>

                        </div>











                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>