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
// adding the subject
if (isset($_POST['add_subject'])) {
    $fetch = $_POST['select'];
    $length = strlen($fetch);
    $find = strpos($fetch, ' ');
    $number = $find + 1;
    $useable = $length - $number;
    $useable1 = $find;

    $section = substr($fetch, -$useable);
    $class = substr($fetch, 0, $find);
    $section = (int) $section;
    $class = (int) $class;
    $section_id = escape($section);
    $class_id = escape($class);

    $subject_name = escape($_POST['subject']);

    $query = "INSERT INTO section_subjects(fk_section_id, subject_name, fk_client_id) ";
    $query .= "VALUES('$section_id', '$subject_name', '$client')";
    $pass_query = query($query);

    if ($pass_query) {
        redirect("./add-section-subjects.php");
    }
}

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Subjects</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="container">

            <form action="" method="post">
                <div class="row align-items-center my-3">

                    <!-- Select the Board -->
                    <div class="col-auto">
                        <div class="input-group mb-2" id="classSelectDiv">
                            <select id="inputState"
                                name="select"
                                class="form-select"
                                onchange="showSubjects()"
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
                                            <option value="<?php echo $row['class_id'] . " " . $row1['section_id']; ?>"><?php echo $row['class_name'] . " " . $row1['section_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </optgroup>
                                <?php } ?>
                            </select>

                            <button type="submit" name="add_subject" id="button-addon1" class="btn btn-sm btn-success">
                                Add Subject
                            </button>
                        </div>
                    </div>

                    <div class="col-auto" id="subjectInput" style="display: none;">
                        <div class="input-group">
                            <input
                                name="subject"
                                type="text"
                                class="form-control"
                                placeholder="Subject Name"
                                aria-label="Example input"
                                aria-describedby="button-addon2"
                                required />
                            <button type="submit" name="add_subject" id="button-addon2" class="btn btn-sm btn-success">
                                Add Subject
                            </button>
                        </div>
                    </div>

                </div>
            </form>

            <section class="section profile">
                <div class="row">
                    
                <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body pt-3">
                                <h5 class="card-title">Class & Sections</h5>
                                <div class="tab-content pt-2">
                                    <?php
                                    // getting all the classes and related sections
                                    $query = "SELECT * FROM all_classes INNER JOIN class_sections ON ";
                                    $query .= "all_classes.class_id=class_sections.fk_class_id ";
                                    $query .= "INNER JOIN section_subjects ON class_sections.section_id=section_subjects.fk_section_id ";
                                    $query .= "WHERE class_sections.fk_client_id='$client'";
                                    $query .= "ORDER BY fk_class_id, section_id, subject_id";
                                    $get_sections = query($query);

                                    $data = [];
                                    while ($row = mysqli_fetch_assoc($get_sections)) {
                                        if (!isset($data[$row['class_name'] . ' ' . $row['section_name']])) {
                                            $data[$row['class_name'] . ' ' . $row['section_name']] = [];
                                        }
                                        $data[$row['class_name'] . ' ' . $row['section_name']][] = $row['subject_name'];
                                    }

                                    foreach ($data as $key => $value) {
                                        echo "<strong>Class</strong>: " . $key . "<br>";

                                        foreach ($value as $subject) {
                                            echo "<strong>---</strong> " . $subject . "<br>";
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
    function showSubjects() {

        document.getElementById('button-addon1').style.display = "none";
        document.getElementById('classSelectDiv').classList.remove('input-group');
        document.getElementById('subjectInput').style.display = "block";
    }
</script>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>