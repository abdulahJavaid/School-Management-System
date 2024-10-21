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

<?php
// add new section
if (isset($_POST['add_section'])) {
    $class_id = escape($_POST['class']);
    $section_name = escape($_POST['section']);

    $query = "INSERT INTO class_sections(fk_class_id, section_name, fk_client_id) ";
    $query .= "VALUES('$class_id', '$section_name', '$client')";
    $pass_query = query($query);

    if ($pass_query) {
        redirect("./add-class-section.php");
    }
}

// add new class and section
if (isset($_POST['submit_class'])) {
    $class_name = escape($_POST['class_name']);
    $section_name = escape($_POST['section_name']);

    $query = "INSERT INTO all_classes(class_name, fk_client_id) ";
    $query .= "VALUES('$class_name', '$client')";
    $add_class = query($query);

    if ($add_class) {
        $class_id = last_id();
        $query = "INSERT INTO class_sections(fk_class_id, section_name, fk_client_id) ";
        $query .= "VALUES('$class_id', '$section_name', '$client')";
        $add_section = query($query);

        if ($add_section) {
            redirect("./add-class-section.php");
        }
    }
}

?>



<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Class & Section's</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="container">
            <?php
            // if add class option is selected then hide this
            if (!isset($_GET['add_class'])) {
            ?>
                <div class="row align-items-center my-3">
                    <form action="" method="get">
                        <button type="submit" name="add_class" class="btn btn-sm btn-success w-25">Add New Class</button>
                    </form>
                </div>
            <?php
            } // end of if (hide if add_class is selected)
            ?>

            <?php
            // if add class option is selected then hide this
            if (!isset($_GET['add_class'])) {
            ?>
                <form action="" method="post">
                    <div class="row align-items-center my-3">

                        <!-- Select the Board -->
                        <div class="col-auto">
                            <div class="input-group mb-2" id="classSelectDiv">
                                <select id="classSelect"
                                    name="class"
                                    class="form-select"
                                    aria-describedby="button-addon1"
                                    onchange="showSections()"
                                    required>
                                    <option value="" disabled selected>Select Class</option>
                                    <?php
                                    // showing all the board names
                                    $query = "SELECT * FROM all_classes WHERE fk_client_id='$client'";
                                    $get_all_classes = query($query);
                                    while ($row = mysqli_fetch_assoc($get_all_classes)) {
                                    ?>
                                        <option value="<?php echo $row['class_id']; ?>"><?php echo $row['class_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>

                                <button type="submit" name="add_section" id="button-addon1" class="btn btn-sm btn-success">
                                    Add Section
                                </button>
                            </div>
                        </div>

                        <div class="col-auto" id="sectionInput" style="display: none;">
                            <div class="input-group">
                                <input
                                    name="section"
                                    type="text"
                                    class="form-control"
                                    placeholder="Section Name"
                                    aria-label="Example input"
                                    aria-describedby="button-addon2"
                                    required />
                                <button type="submit" name="add_section" id="button-addon2" class="btn btn-sm btn-success">
                                    Add Section
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            <?php
            } // end of if (hide if add_class is selected)
            ?>

            <section class="section profile">
                <div class="row">
                    <?php
                    // add class form
                    if (isset($_GET['add_class'])) {
                    ?>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body pt-3">
                                    <h5 class="card-title">Add New Class</h5>
                                    <div class="tab-content pt-2">
                                        <form method="post" action="">
                                            <div class="row mb-3">
                                                <label for="class_name" class="col-6 col-form-label text-secondary"><strong>Class Name</strong> <code>*</code></label>
                                                <div class="col-6">
                                                    <input name="class_name" type="text" class="form-control" id="class_name" placeholder="Class name" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="section_name" class="col-6 col-form-label text-secondary"><strong>Section Name</strong> <code>*</code></label>
                                                <div class="col-6">
                                                    <input name="section_name" type="text" class="form-control" id="section_name" placeholder="Section name" required>
                                                </div>
                                            </div>

                                            <div class="text-end">
                                                <a href="./add-class-section.php" class="btn btn-sm btn-outline-danger">Cancel</a>
                                                <button type="submit" name="submit_class" class="btn btn-sm btn-success">Add Class</button>
                                            </div>
                                        </form><!-- End Profile Edit Form -->
                                    </div><!-- End Bordered Tabs -->

                                </div>
                            </div>

                        </div>
                    <?php
                    } // end of add class form if
                    ?>


                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body pt-3">
                                <h5 class="card-title">Class & Sections</h5>
                                <div class="tab-content pt-2">
                                    <?php
                                    // getting all the classes and related sections
                                    $query = "SELECT * FROM all_classes INNER JOIN class_sections ON ";
                                    $query .= "all_classes.class_id=class_sections.fk_class_id ";
                                    $query .= "WHERE class_sections.fk_client_id='$client'";
                                    $query .= "ORDER BY fk_class_id, section_id";
                                    $get_sections = query($query);

                                    $data = [];
                                    while ($row = mysqli_fetch_assoc($get_sections)) {
                                        if (!isset($data[$row['class_name']])) {
                                            $data[$row['class_name']] = [];
                                        }
                                        $data[$row['class_name']][] = $row['section_name'];
                                    }

                                    foreach ($data as $key => $value) {
                                        echo "<strong>Class</strong>: " . $key . "<br>";

                                        foreach ($value as $section) {
                                            echo "<strong>---</strong> " . $section . "<br>";
                                        }
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </section>

        </div>
    </div>

</main><!-- End #main -->

<script>
    // Function to update class options based on the selected Board
    function showSections() {
        const classId = document.getElementById('classSelect').value;

        document.getElementById('button-addon1').style.display = "none";
        document.getElementById('classSelectDiv').classList.remove('input-group');
        document.getElementById('sectionInput').style.display = "block";
    }
</script>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>