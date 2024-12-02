<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<?php
// checking session for appropriate access
if ($level == 'not=here') {
} else {
    redirect("./");
}
?>

<?php
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// This page is no longer in use
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>View MCQ's</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="container">
            <!-- Row for Name and Reg# Inputs -->
            <form action="" method="get">
                <div class="row align-items-center">

                    <!-- Select the Board -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <select id="boardSelect"
                                name="board"
                                class="form-select"
                                aria-describedby="button-addon1"
                                onchange="showClasses()"
                                required>
                                <option value="" disabled selected>Select Board</option>
                                <?php
                                // showing all the board names
                                $query = "SELECT * FROM board";
                                $get_all_boards = query($query);
                                while ($row = mysqli_fetch_assoc($get_all_boards)) {
                                ?>
                                    <option value="<?php echo $row['board_id']; ?>"><?php echo $row['board_name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Select the Class -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <select id="classSelect"
                                name="class"
                                aria-label="Example select"
                                class="form-select"
                                aria-describedby="button-addon2"
                                onchange="showSubjects()"
                                style="display: none;"
                                required>
                                <option value="" disabled selected>Select Class</option>
                            </select>
                        </div>
                    </div>

                    <!-- Select the Subject -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <select id="subjectSelect"
                                name="subject"
                                aria-label="Example select"
                                class="form-select"
                                aria-describedby="button-addon3"
                                onchange="showChapters()"
                                style="display: none;"
                                required>
                                <option value="" disabled selected>Select Subjext</option>
                            </select>
                        </div>
                    </div>

                    <!-- Select the Chapter -->
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <select id="chapterSelect"
                                name="chapter"
                                aria-label="Example select"
                                class="form-select"
                                aria-describedby="button-addon4"
                                style="display: none;"
                                required>
                                <option value="" disabled selected>Select Chapter</option>
                            </select>
                        </div>
                    </div>

                    <!-- Button for checking the report -->
                    <div class="col-auto" id='submitBtn' style="display: none;">
                        <div class="input-group mb-2">
                            <button name="view_mcqs" class="btn btn-sm btn-success" type="submit" id="button-addon4">
                                View MCQ's
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <section class="section profile">
                <div class="row">
                    <?php
                    // if add MCQ request is submitted
                    if (isset($_GET['view_mcqs'])) {
                        $board = $_GET['board'];
                        $class = $_GET['class'];
                        $subject = $_GET['subject'];
                        $chapter = $_GET['chapter'];
                    ?>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body pt-3">
                                    <ul class="nav nav-tabs nav-tabs-bordered">
                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#add-mcq">View MCQ's</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content pt-2">
                                        <div class="tab-pane fade show active profile-edit pt-3" id="add-mcq">
                                            <?php
                                            // get all mcqs
                                            $query = "SELECT * FROM questions INNER JOIN options ON ";
                                            $query .= "questions.question_id=options.fk_question_id ";
                                            $query .= "WHERE fk_chapter_id='$chapter'";
                                            $all_mcqs = query($query);

                                            $options = [];
                                            $questions = [];
                                            while ($row = mysqli_fetch_assoc($all_mcqs)) {
                                                if (!isset($options[$row['fk_question_id']])) {
                                                    $options[$row['fk_question_id']] = [];
                                                }
                                                if (!isset($questions[$row['question_id']])) {
                                                    $questions[$row['question_id']] = [];
                                                    $questions[$row['question_id']] = $row;
                                                }
                                                $options[$row['fk_question_id']][] = $row['option_description'];
                                            }
                                            ?>
                                            <!-- Custom CSS (optional) -->
                                            <style>
                                                /* .card {
                                                    transition: transform 0.3s;
                                                }
        
                                                .card:hover {
                                                    transform: scale(1.02);
                                                } */
                                            </style>
                                            <div class="container my-4">
                                                <!-- <h2 class="text-center">Multiple Choice Questions</h2> -->
                                                <div class="row">
                                                    <?php foreach ($questions as $question_id => $question): ?>
                                                        <div class="col-md-6 mb-4">
                                                            <div class="card shadow-sm" style="position: relative; overflow: hidden;">
                                                                <div class="card-body" style="position: relative; z-index: 1; background-color: rgba(255, 255, 255, 0.8);">
                                                                    <h5 class="card-title"><?= htmlspecialchars($question['question']) ?></h5>
                                                                    <div class="d-flex flex-wrap">
                                                                        <?php foreach ($options[$question_id] as $option): ?>
                                                                            <div class="me-3">
                                                                                <!-- <input type="radio" name="question_<?= $question_id ?>" value="<?= htmlspecialchars($option) ?>" id="option_<?= $question_id . '_' . $option ?>" class="form-check-input"> -->
                                                                                <label for="option_<?= $question_id . '_' . $option ?>" class="form-check-label"><?= htmlspecialchars($option) ?></label>
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="card-shade" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(33, 147, 176, 0.5); z-index: 0;"></div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <!-- <div class="text-center mt-4">
                                                    <button class="btn btn-outline-success">Submit Answers</button>
                                                </div> -->
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } // end of if to hide the form 
                    ?>
                </div>
            </section>

        </div>
    </div>

</main><!-- End #main -->

<script>
    // Function to update class options based on the selected Board
    function showClasses() {
        const boardId = document.getElementById('boardSelect').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/handle-mcq-select.php', true); // Adjust the path to your PHP file
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // console.log(xhr.responseText);
                try {
                    var response = JSON.parse(xhr.responseText);

                    if (response.length > 0) {
                        // display to block of class select
                        document.getElementById('classSelect').style.display = "block";
                        document.getElementById('subjectSelect').style.display = "none";
                        document.getElementById('submitBtn').style.display = "none";

                        // classes maping
                        var classes = {
                            show: []
                        };

                        // pushin data records in the map
                        response.forEach(function(item) {
                            classes.show.push({
                                id: item.id, // Get 'id' from the response
                                class_name: item.name // Get 'name' from the response and map it to 'class_name'
                            });
                        });

                        const select2 = document.getElementById('classSelect');
                        // Clear current class dropdown options options
                        select2.innerHTML = '<option value="" disabled selected>Select Class</option>';

                        // creating options for the classes
                        if (classes.show) {
                            // Populate class dropdown based on selected category
                            classes.show.forEach(subcategory => {
                                const option = document.createElement('option');
                                option.value = subcategory.id;
                                option.text = subcategory.class_name;
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

        xhr.send('board_id=' + encodeURIComponent(boardId));
    }

    // Function to update class options based on the selected Board
    function showSubjects() {
        const classId = document.getElementById('classSelect').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/handle-mcq-select.php', true); // Adjust the path to your PHP file
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // console.log(xhr.responseText);
                try {
                    var response = JSON.parse(xhr.responseText);

                    if (response.length > 0) {
                        // display to block of class select
                        document.getElementById('subjectSelect').style.display = "block";

                        // classes maping
                        var subjects = {
                            show: []
                        };

                        // pushin data records in the map
                        response.forEach(function(item) {
                            subjects.show.push({
                                id: item.id, // Get 'id' from the response
                                subject_name: item.name // Get 'name' from the response and map it to 'class_name'
                            });
                        });

                        const select2 = document.getElementById('subjectSelect');
                        // Clear current class dropdown options options
                        select2.innerHTML = '<option value="" disabled selected>Select Subject</option>';

                        // creating options for the classes
                        if (subjects.show) {
                            // Populate class dropdown based on selected category
                            subjects.show.forEach(subcategory => {
                                const option = document.createElement('option');
                                option.value = subcategory.id;
                                option.text = subcategory.subject_name;
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

        xhr.send('class_id=' + encodeURIComponent(classId));
    }

    // Function to update class options based on the selected Board
    function showChapters() {
        const subjectId = document.getElementById('subjectSelect').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/handle-mcq-select.php', true); // Adjust the path to your PHP file
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // console.log(xhr.responseText);
                try {
                    var response = JSON.parse(xhr.responseText);

                    if (response.length > 0) {
                        // display to block of class select
                        document.getElementById('chapterSelect').style.display = "block";
                        document.getElementById('submitBtn').style.display = "block";

                        // classes maping
                        var subjects = {
                            show: []
                        };

                        // pushin data records in the map
                        response.forEach(function(item) {
                            subjects.show.push({
                                id: item.id, // Get 'id' from the response
                                subject_name: item.name, // Get 'name' from the response and map it to 'class_name'
                                subject_number: item.number
                            });
                        });

                        const select2 = document.getElementById('chapterSelect');
                        // Clear current class dropdown options options
                        select2.innerHTML = '<option value="" disabled selected>Select Chapter</option>';

                        // creating options for the classes
                        if (subjects.show) {
                            // Populate class dropdown based on selected category
                            subjects.show.forEach(subcategory => {
                                const option = document.createElement('option');
                                option.value = subcategory.id;
                                option.text = subcategory.subject_number + ' - ' + subcategory.subject_name;
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

        xhr.send('subject_id=' + encodeURIComponent(subjectId));
    }
</script>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>