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

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Exam Results</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="container">
            <!-- Studen Resutls Class wise -->
            <form action="" method="get">
                <label for="see_result" class="col-form-label"><strong>Class Result <code>*</code></strong></label>
                <div class="row align-items-center">
                    <!-- Name Input -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <input
                                name="year_month"
                                type="month"
                                class="form-control"
                                placeholder="date"
                                aria-label="By date"
                                aria-describedby="button-addon1"
                                value="<?php
                                        if (isset($_GET['year_month'])) {
                                            echo $_GET['year_month'];
                                        }
                                        ?>"
                                required />
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <select name="exam_title" class="form-select" required>
                                <option value="" selected disabled>Exam</option>
                            </select>
                        </div>
                    </div>

                    <!-- Select Month -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <select id="inputState"
                                name="select"
                                class="form-select"
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
                        </div>
                    </div>

                    <!-- Button for checking the report -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <button name="class_result" class="btn btn-sm btn-success" type="submit" id="button-addon3">
                                See Result
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Studen Resutls Class wise -->
            <form action="" method="get">
                <label for="see_result" class="col-form-label"><strong>Student Result <code>*</code></strong></label>
                <div class="row align-items-center">
                    <!-- Reg# Input -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <input
                                id="roll_no"
                                name="roll_no"
                                type="text"
                                class="form-control"
                                placeholder="Reg no#"
                                onkeyup="showExams()"
                                aria-label="By reg#"
                                aria-describedby="button-addon3"
                                value="<?php
                                        if (isset($_GET['roll_no'])) {
                                            echo $_GET['roll_no'];
                                        }
                                        ?>"
                                required />
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <select name="s_exam_title" id="student_exam_titles" class="form-select" required>
                                <option value="" selected disabled>Exam</option>
                            </select>
                        </div>
                    </div>

                    <!-- Button for checking the report -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <button name="student_result" class="btn btn-sm btn-success" type="submit" id="button-addon3">
                                See Result
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <?php
            // get the student result
            if (isset($_GET['s_exam_title']) && $_GET['s_exam_title'] == 'no-match') {
                $message = "No Results to show!";
            } else {
                if (isset($_GET['student_result'])) {
                    // $section_id = escape($_GET['select1']);
                    $roll_no = escape($_GET['roll_no']);
                    $exam_title_id = escape($_GET['s_exam_title']);
                    // $timestamp = strtotime(escape($_GET['year_month1']));
                    // $exam_month = date('F', $timestamp);
                    // $exam_year = date('Y', $timestamp);

                    // getting the student id
                    $query = "SELECT exam_result.*, exam_title.*, section_subjects.subject_name, student_profile.name, ";
                    $query .= "student_profile.roll_no, student_class.fk_section_id, ";
                    $query .= "class_sections.section_name, all_classes.class_name ";
                    $query .= "FROM exam_result INNER JOIN exam_title ON ";
                    $query .= "exam_result.fk_exam_title_id=exam_title.exam_title_id ";
                    $query .= "INNER JOIN section_subjects ON ";
                    $query .= "exam_result.fk_subject_id=section_subjects.subject_id ";
                    $query .= "INNER JOIN student_profile ON ";
                    $query .= "exam_result.fk_student_id=student_profile.student_id ";
                    $query .= "INNER JOIN student_class ON ";
                    $query .= "student_profile.student_id=student_class.fk_student_id ";
                    $query .= "INNER JOIN class_sections ON ";
                    $query .= "student_class.fk_section_id=class_sections.section_id ";
                    $query .= "INNER JOIN all_classes ON ";
                    $query .= "class_sections.fk_class_id=all_classes.class_id ";
                    $query .= "WHERE exam_result.fk_exam_title_id='$exam_title_id' ";
                    $query .= "AND student_profile.roll_no='$roll_no' AND exam_result.fk_client_id='$client'";
                    $get_result = query($query);

                    $data = [];
                    while ($row = mysqli_fetch_assoc($get_result)) {
                        $title_id = $row['fk_exam_title_id'];
                        if (!isset($data[$title_id])) {
                            $data[$title_id] = [];
                            $data[$title_id] = [
                                'exam_title' => $row['exam_title'],
                                'student_name' => $row['name'],
                                'student_class' => $row['class_name'] . ' ' . $row['section_name'],
                                'student_roll_no' => $row['roll_no'],
                                'exam_data' => []
                            ];
                        }
                        $data[$title_id]['exam_data'][] = $row;
                    }
            ?>
                    <?php
                    // looping data mapped to get the result of student
                    foreach ($data as $key => $val) {
                    ?>
                        <div class="card">
                            <div class="card-body pt-3">
                                <h5 class="card-title pb-0 mb-0">Class: <?php echo $val['student_class']; ?></h5>
                                <p class="lead mb-0 mt-3">Name: <?php echo $val['student_name']; ?></p>
                                <p class="lead mb-0">Reg# <?php echo $val['student_roll_no']; ?></p>
                                <div class="d-flex justify-content-end">
                                    <form action="generate-pdf.php" method="post" class="form-inline">
                                        <div class="">
                                            <button type="submit" name="download_student_result" class="btn btn-sm btn-outline-success">
                                                Download
                                            </button>
                                        </div>
                                    </form>
                                </div><br>

                                <div class="table-responsive">
                                    <table class="table table-bordered border-primary table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="2"><?php echo $val['exam_title']; ?></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th>Subject</th>
                                                <th>Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // fetchig exam data
                                            $total = 0;
                                            $obtained = 0;
                                            foreach ($val['exam_data'] as $fetch) {
                                                $total += $fetch['total_marks'];
                                                $obtained += $fetch['obtained_marks'];
                                                ?>
                                                <tr class="text-center">
                                                    <td><?php echo $fetch['subject_name']; ?></td>
                                                    <td><?php echo $fetch['obtained_marks'] . '/' . $fetch['total_marks']; ?></td>
                                                </tr>
                                                <?php
                                            } // end of inner foreach
                                            ?>
                                            <tr>
                                                <td><strong>Total</strong></td>
                                                <td><?php echo $obtained . '/' . $total; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    <?php
                    } // end outer foreach
                    ?>

            <?php
                } // end of if get request is set
            } // end to show exam results
            ?>

            <?php if (isset($message)) { ?>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="alert alert-danger" id="alert-message">
                            <?php echo $message;
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>

</main><!-- End #main -->

<script>
    // Function to show exam title options based on roll number
    function showExams() {
        const rollNo = document.getElementById('roll_no').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/get-exam-titles.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // console.log(xhr.responseText);
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.length > 0) {
                        // classes maping
                        var classes = {
                            show: []
                        };

                        // pushin data records in the map
                        response.forEach(function(item) {
                            classes.show.push({
                                id: item.id,
                                title_name: item.name
                            });
                        });

                        const select2 = document.getElementById('student_exam_titles');
                        // Clear current exam dropdown options
                        select2.innerHTML = '<option value="" disabled selected>Select Exam</option>';

                        // creating options for the exam titles
                        if (classes.show) {
                            // Populate class dropdown based on selected category
                            classes.show.forEach(subcategory => {
                                const option = document.createElement('option');
                                option.value = subcategory.id;
                                option.text = subcategory.title_name;
                                select2.appendChild(option);
                            });
                        }
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response text:', xhr.responseText);
                }
            }
        };

        xhr.send('roll_no=' + encodeURIComponent(rollNo));
    }
</script>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>