<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<?php
// checking session for appropriate access
if ($level == 'clerk' || $level == 'super') {
} else {
    redirect("./");
}
?>

<?php include_once("./refactoring/promote-class-php.php"); ?>

<?php
// if the students are passed out successfully
if (isset($_GET['passOut'])) {
?>
    <span id="passed-out"></span>
<?php
} // end if
?>

<?php
// if the students are promoted successfully
if (isset($_GET['promote'])) {
?>
    <span id="promoted"></span>
<?php
} // end if
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Change Class-section</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div id="po-success-popup" style="display:none;">Passed Out students are now aluminis of this school.</div>
    <div id="po-noStudent-popup" style="display:none;">Class is empty, no students to Pass Out.</div>
    <div id="p-success-popup" style="display:none;">Students have been successfully promoted to the next class.</div>
    <div id="p-noStudent-popup" style="display:none;">Class is empty, no students to Promote.</div>
    <div id="p-notEmpty-popup" style="display:none;">Selected class is not empty, Promotion is not possible.</div>
    <div id="d-noStudent-popup" style="display:none;">Class is empty, no students to Demote.</div>
    <div id="d-none-selected" style="display:none;">No students selected for demotion.</div>
    <div id="d-empty-popup" style="display:none;">Selected class is empty, Demotion is not possible.</div>

    <div class="row">
        <div class="container">

            <div class="row align-items-center my-3">

                <!-- pass out students -->
                <div class="col-auto">
                    <div class="input-group mb-2" id="classSelectDiv">
                        <button type="submit" name="add_subject" id="button-addon1" class="btn btn-sm btn-secondary">
                            Pass Out
                        </button>
                        <select id="sectionId"
                            name="section"
                            class="form-select"
                            onchange="passOutStudents(this.value)"
                            aria-describedby="button-addon1"
                            required>
                            <option value="" disabled selected>Choose Class</option>
                            <?php
                            // fetching all the classes
                            $query = "SELECT * FROM all_classes WHERE fk_client_id='$client'";
                            $result = query($query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $clas_id = $row['class_id'];
                            ?>
                                <optgroup label="Class: <?php echo $row['class_name']; ?>">
                                    <?php
                                    // fetching the related sections
                                    $query = "SELECT * FROM class_sections WHERE fk_class_id='$clas_id' AND fk_client_id='$client'";
                                    $result1 = query($query);
                                    while ($row1 = mysqli_fetch_assoc($result1)) {
                                    ?>
                                        <option value="<?php echo $row1['section_id']; ?>"><?php echo $row['class_name'] . " " . $row1['section_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </optgroup>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <!-- promote students -->
                <div class="col-auto">
                    <div class="input-group mb-2" id="classSelectDiv">
                        <button type="submit" name="add_subject" id="button-addon2" class="btn btn-sm btn-secondary">
                            Promote Class
                        </button>
                        <select id="sectionId"
                            name="section"
                            class="form-select"
                            onchange="promoteStudents(this.value)"
                            aria-describedby="button-addon1"
                            required>
                            <option value="" disabled selected>Choose Class</option>
                            <?php
                            // fetching all the classes
                            $query = "SELECT * FROM all_classes WHERE fk_client_id='$client'";
                            $result = query($query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $clas_id = $row['class_id'];
                            ?>
                                <optgroup label="Class: <?php echo $row['class_name']; ?>">
                                    <?php
                                    // fetching the related sections
                                    $query = "SELECT * FROM class_sections WHERE fk_class_id='$clas_id' AND fk_client_id='$client'";
                                    $result1 = query($query);
                                    while ($row1 = mysqli_fetch_assoc($result1)) {
                                    ?>
                                        <option value="<?php echo $row1['section_id']; ?>"><?php echo $row['class_name'] . " " . $row1['section_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </optgroup>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <!-- demote students -->
                <div class="col-auto">
                    <div class="input-group mb-2" id="classSelectDiv">
                        <button type="submit" name="add_subject" id="button-addon2" class="btn btn-sm btn-secondary">
                            Demote Students
                        </button>
                        <select id="sectionId"
                            name="section"
                            class="form-select"
                            onchange="demoteStudents(this.value)"
                            aria-describedby="button-addon1"
                            required>
                            <option value="" disabled selected>Choose Class</option>
                            <?php
                            // fetching all the classes
                            $query = "SELECT * FROM all_classes WHERE fk_client_id='$client'";
                            $result = query($query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $clas_id = $row['class_id'];
                            ?>
                                <optgroup label="Class: <?php echo $row['class_name']; ?>">
                                    <?php
                                    // fetching the related sections
                                    $query = "SELECT * FROM class_sections WHERE fk_class_id='$clas_id' AND fk_client_id='$client'";
                                    $result1 = query($query);
                                    while ($row1 = mysqli_fetch_assoc($result1)) {
                                    ?>
                                        <option value="<?php echo $row1['section_id']; ?>"><?php echo $row['class_name'] . " " . $row1['section_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </optgroup>
                            <?php } ?>
                        </select>
                    </div>
                </div>

            </div>

            <section class="section profile">
                <!--  -->
                <!--  -->
                <!--  -->
                <style>
                    .card {
                        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
                    }

                    .avatar.sm {
                        width: 2.25rem;
                        height: 2.25rem;
                        font-size: .818125rem;
                    }

                    .table-nowrap .table td,
                    .table-nowrap .table th {
                        white-space: nowrap;
                    }

                    .table>:not(caption)>*>* {
                        padding: 0.75rem 1.25rem;
                        border-bottom-width: 1px;
                    }

                    table th {
                        font-weight: 600;
                        background-color: #eeecfd !important;
                    }
                </style>

                <div class="row">

                    <!-- pass-out -->
                    <div id="class-pass-out" class="col-sm-12" style="display: none;">
                        <div class="card">
                            <div class="card-header card-bg-header border-0 text-dark mb-0">
                                <h5 class="mb-0">
                                    <strong>Pass Out Class</strong>
                                    <span class="d-inline-block"
                                        tabindex="0"
                                        data-bs-toggle="tooltip"
                                        title="The class has completed their study at <?php echo $_SESSION['school_name']; ?>">
                                        <button type="button" class="btn btn-sm btn-outline-light"><i class="fa-solid fa-question"></i></button>
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body px-0 pb-0">
                                <div class="row">
                                    <div class="col-sm-12 pe-">
                                        <!-- <div class="card border border-info border-end rounded-start">One</div> -->
                                        <!-- <div id="one" class="card border border-info border-end rounded-start m-0 p-4" style='border-right: 1px solid #17a2b8 !important; border-radius: 0 0 0 0.375rem !important;'> -->
                                        <div id="one" class="">
                                            <div class="row">
                                                <div class="col-12 mb- mb-lg-">
                                                    <div class="overflow-hidden card table-nowrap table-card custom-profile">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h5 class="mb-0 text-dark">
                                                                Class Students
                                                                <span class="d-inline-block"
                                                                    tabindex="0"
                                                                    data-bs-toggle="tooltip"
                                                                    title="Students of the selected class.">
                                                                    <button type="button" class="btn btn-sm btn-outline-dark"><i class="fa-solid fa-question"></i></button>
                                                                </span>
                                                            </h5>
                                                            <button onclick="passOut()" class="btn btnsm btn-outline-success rounded-4" type="button">
                                                                Pass Out Class
                                                                <span class="bg-success rounded-circle text-white px-2 py-1">
                                                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                                    <!-- <i class="fas fa-chevron-right"></i> -->
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table mb-0">
                                                                <thead class="small text-uppercase bg-body text-muted">
                                                                    <tr>
                                                                        <th>Reg#</th>
                                                                        <th>Name</th>
                                                                        <th>Class</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="po_students_tbody">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="po_section_id" name="hid_section_id">
                                    <input type="hidden" id="po_class_section" name="hid_class_section">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!-- promote -->
                    <div id="class-promote" class="col-sm-12" style="display: none;">
                        <div class="card">
                            <div class="card-header card-bg-header border-0 text-dark mb-0">
                                <h5 class="mb-0">
                                    <strong>Promote Class</strong>
                                    <span class="d-inline-block"
                                        tabindex="0"
                                        data-bs-toggle="tooltip"
                                        title="End of session! Students will be promoted to the next class.">
                                        <button type="button" class="btn btn-sm btn-outline-light"><i class="fa-solid fa-question"></i></button>
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body px-0 pb-0">
                                <div class="row">
                                    <div class="col-sm-12 pe-">
                                        <div id="one" class="">
                                            <div class="row">
                                                <div class="col-12 mb- mb-lg-">
                                                    <div class="overflow-hidden card table-nowrap table-card custom-profile">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h5 class="mb-0 text-dark">
                                                                Class Students
                                                                <span class="d-inline-block"
                                                                    tabindex="0"
                                                                    data-bs-toggle="tooltip"
                                                                    title="Students of the selected class.">
                                                                    <button type="button" class="btn btn-sm btn-outline-dark"><i class="fa-solid fa-question"></i></button>
                                                                </span>
                                                            </h5>
                                                            <button onclick="promote()" class="btn btnsm btn-outline-success rounded-4" type="button">
                                                                Promote Class
                                                                <span class="bg-success rounded-circle text-white px-2 py-1">
                                                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                                    <!-- <i class="fas fa-chevron-right"></i> -->
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table mb-0">
                                                                <thead class="small text-uppercase bg-body text-muted">
                                                                    <tr>
                                                                        <th>Reg#</th>
                                                                        <th>Name</th>
                                                                        <th>Class</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="p_students_tbody">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="p_section_id" name="hid_section_id">
                                    <input type="hidden" id="p_class_section" name="hid_class_section">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!-- demote -->
                    <div id="class-demote" class="col-sm-12" style="display: none;">
                        <div class="card">
                            <div class="card-header card-bg-header border-0 text-dark mb-0">
                                <h5 class="mb-0">
                                    <strong>Students Demotion</strong>
                                    <span class="d-inline-block"
                                        tabindex="0"
                                        data-bs-toggle="tooltip"
                                        title="Selected students will be demoted to the lower class.">
                                        <button type="button" class="btn btn-sm btn-outline-light"><i class="fa-solid fa-question"></i></button>
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body px-0 pb-0">
                                <div class="row">
                                    <div class="col-sm-12 pe-">
                                        <div id="one" class="">
                                            <div class="row">
                                                <div class="col-12 mb- mb-lg-">
                                                    <div class="overflow-hidden card table-nowrap table-card custom-profile">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h5 class="mb-0 text-dark">
                                                                Class Students
                                                                <span class="d-inline-block"
                                                                    tabindex="0"
                                                                    data-bs-toggle="tooltip"
                                                                    title="Students of the selected class.">
                                                                    <button type="button" class="btn btn-sm btn-outline-dark"><i class="fa-solid fa-question"></i></button>
                                                                </span>
                                                            </h5>
                                                            <button onclick="demote()" class="btn btnsm btn-outline-danger rounded-4" type="button">
                                                                Demote Students
                                                                <span class="bg-danger rounded-circle text-white px-2 py-1">
                                                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                                    <!-- <i class="fas fa-chevron-right"></i> -->
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table mb-0">
                                                                <thead class="small text-uppercase bg-body text-muted">
                                                                    <tr>
                                                                        <th>Select</th>
                                                                        <th>Reg#</th>
                                                                        <th>Name</th>
                                                                        <th>Class</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="d_students_tbody">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="d_section_id" name="hid_section_id">
                                    <input type="hidden" id="d_class_section" name="hid_class_section">
                                    <input type="hidden" id="d_student_ids" name="hid_student_ids">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!--  -->
                <!--  -->
                <!--  -->

                <!-- ====== Modals for this page =======  -->
                <?php include_once("./refactoring/promote-class-modals.php"); ?>

            </section>
            <!--  -->
            <!--  -->
            <!--  -->
            <!--  -->
            <div class="container mt-5 pt-4">
                <!-- <div class="row align-items-end mb-4 pb-2">
                    <div class="col-md-8">
                        <div class="section-title text-center text-md-start">
                            <h4 class="title mb-4">Find the perfect jobs</h4>
                            <p class="text-muted mb-0 para-desc">Start work with Leaping. Build responsive, mobile-first projects on the web with the world's most popular front-end component library.</p>
                        </div>
                    </div>

                    <div class="col-md-4 mt-4 mt-sm-0 d-none d-md-block">
                        <div class="text-center text-md-end">
                            <a href="#" class="text-primary">View more Jobs <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right fea icon-sm">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg></a>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="card border-0 bg-light rounded shadow">
                            <div class="card-body p-4">
                                <span class="badge rounded-pill bg-primary float-md-end mb-3 mb-sm-0">Full time</span>
                                <h5>Web Designer</h5>
                                <div class="mt-3">
                                    <span class="text-muted d-block"><i class="fa fa-home" aria-hidden="true"></i> <a href="#" target="_blank" class="text-muted">Bootdey.com LLC.</a></span>
                                    <span class="text-muted d-block"><i class="fa fa-map-marker" aria-hidden="true"></i> USA</span>
                                </div>

                                <div class="mt-3">
                                    <a href="#" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="card border-0 bg-light rounded shadow">
                            <div class="card-body p-4">
                                <span class="badge rounded-pill bg-primary float-md-end mb-3 mb-sm-0">Remote</span>
                                <h5>Front-end Developer</h5>
                                <div class="mt-3">
                                    <span class="text-muted d-block"><i class="fa fa-home" aria-hidden="true"></i> <a href="#" target="_blank" class="text-muted">Bootdey.com LLC.</a></span>
                                    <span class="text-muted d-block"><i class="fa fa-map-marker" aria-hidden="true"></i> USA</span>
                                </div>

                                <div class="mt-3">
                                    <a href="#" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="card border-0 bg-light rounded shadow">
                            <div class="card-body p-4">
                                <span class="badge rounded-pill bg-primary float-md-end mb-3 mb-sm-0">Contract</span>
                                <h5>Web Developer</h5>
                                <div class="mt-3">
                                    <span class="text-muted d-block"><i class="fa fa-home" aria-hidden="true"></i> <a href="#" target="_blank" class="text-muted">Bootdey.com LLC.</a></span>
                                    <span class="text-muted d-block"><i class="fa fa-map-marker" aria-hidden="true"></i> USA</span>
                                </div>

                                <div class="mt-3">
                                    <a href="#" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="card border-0 bg-light rounded shadow">
                            <div class="card-body p-4">
                                <span class="badge rounded-pill bg-primary float-md-end mb-3 mb-sm-0">WFH</span>
                                <h5>Back-end Developer</h5>
                                <div class="mt-3">
                                    <span class="text-muted d-block"><i class="fa fa-home" aria-hidden="true"></i> <a href="#" target="_blank" class="text-muted">Bootdey.com LLC.</a></span>
                                    <span class="text-muted d-block"><i class="fa fa-map-marker" aria-hidden="true"></i> USA</span>
                                </div>

                                <div class="mt-3">
                                    <a href="#" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="card border-0 bg-light rounded shadow">
                            <div class="card-body p-4">
                                <span class="badge rounded-pill bg-primary float-md-end mb-3 mb-sm-0">Full time</span>
                                <h5>UX / UI Designer</h5>
                                <div class="mt-3">
                                    <span class="text-muted d-block"><i class="fa fa-home" aria-hidden="true"></i> <a href="#" target="_blank" class="text-muted">Bootdey.com LLC.</a></span>
                                    <span class="text-muted d-block"><i class="fa fa-map-marker" aria-hidden="true"></i> USA</span>
                                </div>

                                <div class="mt-3">
                                    <a href="#" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="card border-0 bg-light rounded shadow">
                            <div class="card-body p-4">
                                <span class="badge rounded-pill bg-primary float-md-end mb-3 mb-sm-0">Remote</span>
                                <h5>Tester</h5>
                                <div class="mt-3">
                                    <span class="text-muted d-block"><i class="fa fa-home" aria-hidden="true"></i> <a href="#" target="_blank" class="text-muted">Bootdey.com LLC.</a></span>
                                    <span class="text-muted d-block"><i class="fa fa-map-marker" aria-hidden="true"></i> USA</span>
                                </div>

                                <div class="mt-3">
                                    <a href="#" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-12 mt-4 pt-2 d-block d-md-none text-center">
                        <a href="#" class="btn btn-primary">View more Jobs <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right fea icon-sm">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg></a>
                    </div><!--end col-->
                </div><!--end row-->
            </div>
        </div>
    </div>

</main><!-- End #main -->

<!-- ====== Js code for this page =======  -->
<?php include_once("./refactoring/promote-class-js.php"); ?>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>