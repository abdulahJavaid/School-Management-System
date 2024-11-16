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


<?php include_once("./refactoring/add-mcq-requests.php"); ?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add MCQ's</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="container">
            <!-- Row for Name and Reg# Inputs -->
            <form action="" method="post" enctype="multipart/form-data">
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
                            <button name="add_mcqs" class="btn btn-sm btn-success" type="submit" id="button-addon4">
                                Add MCQ's
                            </button>
                        </div>
                    </div>

                    <div class="row" id="file" style="display: none;">
                        <!-- Select the Subject -->
                        <div class="col-6">
                            <div class="input-group mb-2">
                                <input name="file" type="file" class="form-control" id="image"
                                    aria-label="Example Input" aria-describedby="button-addon5" accept=".txt">
                                <button name="auto_mcqs" class="btn btn-sm btn-outline-success" type="submit" id="button-addon5">
                                    Auto Upload
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

            <section class="section profile">
                <div class="row">
                    <?php
                    // if add MCQ request is submitted
                    if (isset($_GET['add_mcqs']) || isset($_POST['add_mcqs'])) {
                        if (isset($_GET['add_mcqs'])) {
                            $board = escape($_GET['board']);
                            $class = escape($_GET['class']);
                            $subject = escape($_GET['subject']);
                            $chapter = escape($_GET['chapter']);
                        } elseif (isset($_POST['add_mcqs'])) {
                            $board = escape($_POST['board']);
                            $class = escape($_POST['class']);
                            $subject = escape($_POST['subject']);
                            $chapter = escape($_POST['chapter']);
                        }
                    ?>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body pt-3">
                                    <ul class="nav nav-tabs nav-tabs-bordered">
                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#add-mcq">Add MCQ's</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-2">
                                        <div class="tab-pane fade show active profile-edit pt-3" id="add-mcq">
                                            <form method="post" action="" enctype="multipart/form-data">
                                                <div class="row mb-3">
                                                    <label for="q1" class="col-md-4 col-lg-3 col-form-label"><strong>Question</strong> <code>*</code></label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <textarea name="q1" class="form-control" rows="2" id="q1" required></textarea>
                                                    </div>
                                                    <label for="options" class="col-md-4 col-lg-3 col-form-label"><strong>---Options</strong> <code>*</code></label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <div class="row mt-1">
                                                            <div class="col-auto mt-1">
                                                                <textarea name="op1" class="form-control" rows="1" id="op1" required></textarea>
                                                                <input type="radio" name="option_status" value="op1" required> Correct option
                                                            </div>
                                                            <div class="col-auto mt-1">
                                                                <textarea name="op2" class="form-control" rows="1" id="op2" required></textarea>
                                                                <input type="radio" name="option_status" value="op2"> Correct option
                                                            </div>
                                                            <div class="col-auto mt-1">
                                                                <textarea name="op3" class="form-control" rows="1" id="op3"></textarea>
                                                                <input type="radio" name="option_status" value="op3"> Correct option
                                                            </div>
                                                            <div class="col-auto mt-1">
                                                                <textarea name="op4" class="form-control" rows="1" id="op4"></textarea>
                                                                <input type="radio" name="option_status" value="op4"> Correct option
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="board" value="<?php echo $board; ?>">
                                                <input type="hidden" name="class" value="<?php echo $class; ?>">
                                                <input type="hidden" name="subject" value="<?php echo $subject; ?>">
                                                <input type="hidden" name="chapter" value="<?php echo $chapter; ?>">

                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" name="submit_mcq" class="btn btn-success">Add MCQ</button>
                                                </div>
                                            </form>

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
                        document.getElementById('file').style.display = "block";

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

    // document.querySelectorAll('.reorder-checkbox').forEach(checkbox => {
    //     checkbox.addEventListener('change', function() {
    //         const currentDiv = this.closest('.form-section');
    //         const form = document.getElementById('myForm');

    //         if (this.checked) {
    //             form.appendChild(currentDiv); // Move this div to the bottom
    //         }
    //     });
    // });
</script>

<!-- <div class="card">
    <form id="myForm">
        <div class="form-section">
            <input type="checkbox" class="reorder-checkbox"> Checkbox 1
            <input type="text" placeholder="Input 1">
        </div>
        <div class="form-section">
            <input type="checkbox" class="reorder-checkbox"> Checkbox 2
            <input type="text" placeholder="Input 2">
        </div>
        <div class="form-section">
            <input type="checkbox" class="reorder-checkbox"> Checkbox 3
            <input type="text" placeholder="Input 3">
        </div>
    </form>
</div> -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>