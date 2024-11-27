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

<?php
// if the students are demoted successfully
if (isset($_GET['demote'])) {
?>
    <span id="demoted"></span>
<?php
} // end if
?>

<?php
// if the students section are changed successfully
if (isset($_GET['change'])) {
?>
    <span id="changed"></span>
<?php
} // end if
?>

<?php
// if the students section are changed successfully
if (isset($_GET['left'])) {
?>
    <span id="disabled"></span>
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
    <div id="d-success-popup" style="display:none;">Students have been demoted to the selected class.</div>
    <div id="d-noStudent-popup" style="display:none;">Class is empty, no students to Demote.</div>
    <div id="d-none-selected" style="display:none;">No students selected for demotion.</div>
    <div id="d-empty-popup" style="display:none;">Selected class is empty, Demotion is not possible.</div>
    <div id="c-success-popup" style="display:none;">Students section has been successfully changed.</div>
    <div id="c-noStudent-popup" style="display:none;">Class is empty, no students available.</div>
    <div id="c-none-selected" style="display:none;">No students selected to change the section.</div>
    <div id="c-one-section" style="display:none;">This class has only one section, Section change not possible.</div>
    <div id="c-empty-popup" style="display:none;">Selected section is empty, Section change not possible.</div>
    <div id="spo-success-popup" style="display:none;">Selected student profiles have been disabled.</div>
    <div id="spo-noStudent-popup" style="display:none;">Class is empty.</div>
    <div id="spo-none-selected" style="display:none;">No students selected.</div>

    <div class="row">
        <div class="container">

            <div class="row align-items-center my-3">

                <!-- pass out students -->
                <div class="col-auto" id="show-po-main" style="display: none;">
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
                <div class="col-auto" id="show-p-main" style="display: none;">
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
                <div class="col-auto" id="show-d-main" style="display: none;">
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

                <!-- change section -->
                <div class="col-auto" id="show-c-main" style="display: none;">
                    <div class="input-group mb-2" id="classSelectDiv">
                        <button type="submit" name="add_subject" id="button-addon2" class="btn btn-sm btn-secondary">
                            Change Section
                        </button>
                        <select id="sectionId"
                            name="section"
                            class="form-select"
                            onchange="changeSection(this.value)"
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
                                        <option value="<?php echo $row['class_id'] . " " .  $row1['section_id']; ?>"><?php echo $row['class_name'] . " " . $row1['section_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </optgroup>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <!-- single student promotion -->
                <div class="col-auto" id="show-spo-main" style="display: none;">
                    <div class="input-group mb-2" id="classSelectDiv">
                        <button type="submit" name="add_subject" id="button-addon1" class="btn btn-sm btn-secondary">
                            Disable Profiles
                        </button>
                        <select id="sectionId"
                            name="section"
                            class="form-select"
                            onchange="leftSchool(this.value)"
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

                <div class="row">

                    <!-- change section -->
                    <div id="class-change" class="col-sm-12" style="display: none;">
                        <div class="card">
                            <div class="card-header card-bg-header border-0 text-dark mb-0">
                                <h5 class="mb-0">
                                    <strong>Change Section</strong>
                                    <span class="d-inline-block"
                                        tabindex="0"
                                        data-bs-toggle="tooltip"
                                        title="Section of the selected students will be changed.">
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
                                                            <button onclick="change()" class="btn btnsm btn-outline-success rounded-4" type="button">
                                                                Change Section
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
                                                                        <th>Select</th>
                                                                        <th>Reg#</th>
                                                                        <th>Name</th>
                                                                        <th>Class</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="c_students_tbody">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="c_class_id" name="hid_class_id">
                                    <input type="hidden" id="c_section_id" name="hid_section_id">
                                    <input type="hidden" id="c_class_section" name="hid_class_section">
                                    <input type="hidden" id="c_student_ids" name="hid_student_ids">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!-- left school between studies -->
                    <div id="student-left-school" class="col-sm-12" style="display: none;">
                        <div class="card">
                            <div class="card-header card-bg-header border-0 text-dark mb-0">
                                <h5 class="mb-0">
                                    <strong>Disable Profiles</strong>
                                    <span class="d-inline-block"
                                        tabindex="0"
                                        data-bs-toggle="tooltip"
                                        title="Selected student profiles will be disabled.">
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
                                                            <button onclick="left()" class="btn btnsm btn-outline-success rounded-4" type="button">
                                                                Disable
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
                                                                        <th>Select</th>
                                                                        <th>Reg#</th>
                                                                        <th>Name</th>
                                                                        <th>Class</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="spo_students_tbody">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="spo_section_id" name="hid_section_id">
                                    <input type="hidden" id="spo_class_section" name="hid_class_section">
                                    <input type="hidden" id="spo_student_ids" name="hid_student_ids">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- The cards to show on the main page -->
                <div class="container mt1 pt4">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12 mt4 pt2" id="po-main">
                            <div class="card border-0 bg-light rounded shadow">
                                <div class="card-body p-4">
                                    <span class="badge rounded-pill bg-success float-md-end mb-3 mb-sm-0">Pass Out Class</span>
                                    <!-- <h5>Web Designer</h5> -->
                                    <div class="mt-3">
                                        <span class="text-muted d-block fw-normal"><i class="fa fa-info-circle" aria-hidden="true"></i>
                                            <!-- <a href="#" target="_blank" class="text-muted"> -->
                                            To pass out the senior classes when they have completed their studies.
                                            <!-- </a> -->
                                        </span>
                                        <!-- <span class="text-muted d-block"><i class="fa fa-home" aria-hidden="true"></i> <a href="#" target="_blank" class="text-muted">Bootdey.com LLC.</a></span>
                                    <span class="text-muted d-block"><i class="fa fa-map-marker" aria-hidden="true"></i> USA</span> -->
                                    </div>

                                    <div class="mt-3">
                                        <button onclick="unhide('show-po-main')" type="button" class="btn btn-success">Pass Out</button>
                                        <!-- <a href="#" class="btn btn-success">Pass Out</a> -->
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt4 pt2" id="p-main">
                            <div class="card border-0 bg-light rounded shadow">
                                <div class="card-body p-4">
                                    <span class="badge rounded-pill bg-success float-md-end mb-3 mb-sm-0">Promote Class</span>
                                    <div class="mt-3">
                                        <span class="text-muted d-block fw-normal"><i class="fa fa-info-circle" aria-hidden="true"></i>
                                            To promote a class to another class at the end of Study Year.
                                        </span>
                                    </div>

                                    <div class="mt-3">
                                        <button onclick="unhide('show-p-main')" type="button" class="btn btn-success">Promote</button>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt4 pt2" id="d-main">
                            <div class="card border-0 bg-light rounded shadow">
                                <div class="card-body p-4">
                                    <span class="badge rounded-pill bg-success float-md-end mb-3 mb-sm-0">Demote Students</span>
                                    <div class="mt-3">
                                        <span class="text-muted d-block fw-normal"><i class="fa fa-info-circle" aria-hidden="true"></i>
                                            To demote some students to a junior class who have not performed well.
                                        </span>
                                    </div>

                                    <div class="mt-3">
                                        <button onclick="unhide('show-d-main')" type="button" class="btn btn-success">Demote</button>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt4 pt2" id="c-main">
                            <div class="card border-0 bg-light rounded shadow">
                                <div class="card-body p-4">
                                    <span class="badge rounded-pill bg-success float-md-end mb-3 mb-sm-0">Change Section</span>
                                    <div class="mt-3">
                                        <span class="text-muted d-block fw-normal"><i class="fa fa-info-circle" aria-hidden="true"></i>
                                            To change section of students for the same class.
                                        </span>
                                    </div>

                                    <div class="mt-3">
                                        <button onclick="unhide('show-c-main')" type="button" class="btn btn-success">Change</button>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt4 pt2" id="spo-main">
                            <div class="card border-0 bg-light rounded shadow">
                                <div class="card-body p-4">
                                    <span class="badge rounded-pill bg-success float-md-end mb-3 mb-sm-0">Disable Student Profile</span>
                                    <div class="mt-3">
                                        <span class="text-muted d-block fw-normal"><i class="fa fa-info-circle" aria-hidden="true"></i>
                                            This action means that one/few students are no longer the students of this school due to any reason.
                                        </span>
                                    </div>

                                    <div class="mt-3">
                                        <button onclick="unhide('show-spo-main')" type="button" class="btn btn-success">Disable</button>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>

                <!-- ====== Modals for this page =======  -->
                <?php include_once("./refactoring/promote-class-modals.php"); ?>

            </section>
        </div>
    </div>

</main><!-- End #main -->

<!-- ====== Js code for this page =======  -->
<?php include_once("./refactoring/promote-class-js.php"); ?>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>