<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<?php include_once("./refactoring/add-mcq-requests.php"); ?>



<?php
// getting the mcqs
if (isset($_POST['generate'])) {
    $board = escape($_POST['board']);
    $class = escape($_POST['class']);
    $subject = escape($_POST['subject']);
    $chapter = escape($_POST['chapter']);

    // API endpoint URL
    $apiUrl = 'http://127.0.0.1:8000/generate_mcqs';

    $file = $_FILES['file']['tmp_name'];
    $number = escape($_POST['number']);
    $command = escape($_POST['query']);

    // file path and query for the request
    $filePath = './5-pages-computer.pdf';
    $filePath = $file;
    $query = $command;
    $num = $number;

    // if the file exists
    if (!file_exists($filePath)) {
        die("File not found at specified path.");
    }

    // Initialize cURL session
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $apiUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: multipart/form-data'
        ],
        CURLOPT_POSTFIELDS => [
            'file' => new CURLFile($filePath),
            'query' => $query,
            'num_mcqs' => $number
        ],
    ]);

    // Execute request
    $response = curl_exec($curl);

    // Check for errors in cURL request
    if (curl_errno($curl)) {
        echo "cURL error: " . curl_error($curl);
        curl_close($curl);
        exit;
    }

    // Close cURL session
    curl_close($curl);
    // Decode and print response from FastAPI
    $responseData = json_decode($response, true);

    // // Check the structure of the response
    // print_r($responseData);

    if (isset($responseData['simplified_mcqs']['simplified_mcqs']['mcqs']) && is_array($responseData['simplified_mcqs']['simplified_mcqs']['mcqs'])) {
        $mcqs = $responseData['simplified_mcqs']['simplified_mcqs']['mcqs'];
        $_SESSION['mcqs'] = $mcqs;
        $data = [
            'board' => $board,
            'class' => $class,
            'subject' => $subject,
            'chapter' => $chapter,
        ];
        $_SESSION['data'] = $data;
        // redirect to the same page
        redirect('./generate-mcq.php');
    } else {
        echo "MCQs data is not available or is empty.";
    }
}

?>


<?php
// saving the mcq's
if (isset($_POST['save_mcqs'])) {
    $board = escape($_POST['board']);
    $class = escape($_POST['class']);
    $subject = escape($_POST['subject']);
    $chapter = escape($_POST['chapter']);

    $total_mcq = escape($_POST['total_mcqs']);
    $counter = 1;
    for (;$counter <= $total_mcq; $counter++) {
        // preparing the keys
        $check = "cbox".$counter."";
        $q_key = "question".$counter."";
        $opt_ans_key = "optanswer".$counter."";
        $answer = escape($_POST[$opt_ans_key]);
        if (isset($_POST[$check])) {
            $question = escape($_POST[$q_key]);
            $query = "INSERT INTO questions(question, fk_chapter_id) ";
            $query .= "VALUES('$question', '$chapter')";
            $add_question = query($query);
            $last_id = last_id();
            for ($i = 1; $i <= 4; $i++) {
                $opt_key = "opt".$counter.$i."";
                $option = escape($_POST[$opt_key]);
                if ($answer == $i) {
                    $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
                    $query .= "VALUES('$option', 'correct', '$last_id')";
                    $add_option = query($query);
                } else {
                    $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
                    $query .= "VALUES('$option', 'incorrect', '$last_id')";
                    $add_option = query($query);
                }

            }

        }
    }


    unset($_SESSION['mcqs']);
    unset($_SESSION['data']);
    redirect('./generate-mcq.php');






}

?>







<main id="main" class="main">

    <div class="pagetitle">
        <h1>Generate MCQ's</h1>
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
                                Generate MCQ's
                            </button>
                        </div>
                    </div>


                    <section class="section profile" id="file" style="display: none;">
                        <div class="row">

                            <div class="col-lg-9">
                                <div class="card">
                                    <div class="card-body pt-3">
                                        <ul class="nav nav-tabs nav-tabs-bordered">
                                            <li class="nav-item">
                                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Generate MCQ's</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content pt-2">
                                            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                                                <form method="post" action="" enctype="multipart/form-data">

                                                    <div class="row mb-3">
                                                        <label for="name" class="col-md-4 col-lg-3 col-form-label"><strong>Pdf</strong> <code>*</code></label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="file" type="file" class="form-control" id="image"
                                                                aria-label="Example Input" aria-describedby="button-addon5" accept=".pdf" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="query" class="col-md-4 col-lg-3 col-form-label"><strong>Command</strong> <code>*</code></label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="query" type="text" class="form-control" id="fullName" placeholder="eg, generate mcqs from 1st chapter" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="name" class="col-md-4 col-lg-3 col-form-label"><strong>No. of mcqs</strong> <code>*</code></label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="number" type="text" class="form-control" id="fullName" placeholder="no. of mcqs" required>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" name="generate" class="btn btn-sm btn-success">Generate MCQ's</button>
                                                    </div>

                                                </form><!-- End Form -->

                                            </div>

                                        </div><!-- End Bordered Tabs -->

                                    </div>
                                </div>

                            </div>


                        </div>
                    </section>

                </div>
            </form>

            <?php
            // showing the mcqs
            if (isset($_SESSION['mcqs'])) {
                // print_r($_SESSION['mcqs']);
            ?>
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">Generated MCQ's</h5>
                        <form action="" method="post">
                            <?php
                            // looping to get the mcqs
                            $total_mcq = 0;
                            $var = 1;
                            foreach ($_SESSION['mcqs'] as $mcq) {
                            ?>
                                <div class="outer-card-mcq row p-3 mb-3 align-items-center">
                                    <div class="col-auto">
                                        <input type="checkbox" name="cbox<?php echo $var; ?>" class="form-check-input card-checkbox-mcq">
                                    </div>

                                    <!-- Question Section (6 columns) -->
                                    <div class="question-section-mcq col-md-6">
                                        <u class="text-success">Question <?php echo $var; ?></u> &nbsp;
                                        <span onclick="edit('<?php echo $var; ?>')" id="edit<?php echo $var; ?>" class="edit-pencil">
                                            <!-- <i class="bi bi-pencil"></i> -->
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span onclick="save('<?php echo $var; ?>')" class="edit-pencil" id="save<?php echo $var; ?>" style="display: none;">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <textarea
                                            name="question<?php echo $var; ?>"
                                            id="question<?php echo $var; ?>"
                                            class="w-100 border-0 p-0 bg-transparent"
                                            rows="4"
                                            readonly
                                            style="font-weight: bold; resize: none;"
                                            onfocus="this.blur();"><?php echo trim($mcq['question']); ?>
                                    </textarea>
                                    </div>

                                    <!-- Options Section (6 columns) -->
                                    <div class="options-section-mcq col-md-5">
                                        <ul class="list-unstyled mb-0">
                                            <?php
                                            // looping to get the options
                                            $alphabs = ['a', 'b', 'c', 'd'];
                                            $index = 0;
                                            $var1 = 1;
                                            $target = 0;
                                            foreach ($mcq['options'] as $option) {
                                            ?>
                                                <li>
                                                    <strong class="text-success"><?php echo $alphabs[$index]; ?>) </strong>&nbsp;
                                                    <span onclick="edit('<?php echo $var . $var1; ?>')" id="edit<?php echo $var . $var1; ?>" class="edit-pencil">
                                                        <!-- <i class="bi bi-pencil"></i> -->
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                    <span onclick="save('<?php echo $var . $var1; ?>')" class="edit-pencil" id="save<?php echo $var . $var1; ?>" style="display: none;">
                                                        <i class="fas fa-save"></i>
                                                    </span>

                                                    <textarea name="opt<?php echo $var . $var1; ?>"
                                                        class="w-100 border-0 p-0 bg-transparent auto-height-textarea"
                                                        id="question<?php echo $var . $var1; ?>"
                                                        cols="1"
                                                        readonly
                                                        style="font-weight: normal; resize: none; overflow: hidden;"
                                                        onfocus="this.blur();"><?php echo trim($option); ?>
                                                </textarea>
                                                </li>

                                                <?php
                                                // checking the answer option
                                                if (str_contains($mcq['answer'], $option)) {
                                                ?>
                                                    <input type="hidden" name="optanswer<?php echo $var; ?>" id="optanswer<?php echo $var; ?>" value="<?php echo $var1; ?>">
                                                <?php
                                                    $target = $var1;
                                                }
                                                ?>

                                            <?php
                                            echo $target;
                                                $index++;
                                                $var1++;
                                            } // end of loop to get options
                                            ?>

                                            <li class="mt-3">
                                                <strong class="text-success">Answer: </strong> &nbsp;
                                                <span onclick="ansEdit('<?php echo $var; ?>')" id="ansedit<?php echo $var; ?>" class="edit-pencil">
                                                    <!-- <i class="bi bi-pencil"></i> -->
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                <span onclick="ansSave('<?php echo $var; ?>')" class="edit-pencil" id="anssave<?php echo $var; ?>" style="display: none;">
                                                    <i class="fas fa-save"></i>
                                                </span>
                                                <textarea name="answer<?php echo $var; ?>"
                                                    id="answer<?php echo $var; ?>"
                                                    class="w-100 border-0 p-0 bg-transparent"
                                                    readonly
                                                    style="font-weight: normal; resize: none;"
                                                    onfocus="this.blur();"><?php echo trim($mcq['answer']); ?>
                                            </textarea>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                            <?php
                                $var++;
                                $total_mcq++;
                            } // end loop to get mcqs
                            ?>

                            <input type="hidden" name="board" value="<?php echo $_SESSION['data']['board']; ?>">
                            <input type="hidden" name="class" value="<?php echo $_SESSION['data']['class']; ?>">
                            <input type="hidden" name="subject" value="<?php echo $_SESSION['data']['subject']; ?>">
                            <input type="hidden" name="chapter" value="<?php echo $_SESSION['data']['chapter']; ?>">
                            <input type="hidden" name="total_mcqs" value="<?php echo $total_mcq; ?>">

                            <div class="d-flex justify-content-end">
                                <button type="submit" name="save_mcqs" class="btn btn-sm btn-success">Save MCQ's</button>
                            </div>
                        </form>
                    </div>
                </div>

            <?php
            } // end of if (the session is set)
            ?>

        </div>
    </div>

</main><!-- End #main -->

<script>
    // function autoResize(textarea) {
    //     textarea.style.height = 'auto'; // Reset height first
    //     textarea.style.height = textarea.scrollHeight + 'px'; // Adjust height based on content
    // }

    // // Run autoResize on page load for each textarea
    // document.querySelectorAll('.auto-height-textarea').forEach(textarea => autoResize(textarea));

    // // Optional: Resize on window resize to adapt for line breaks
    // window.addEventListener('resize', () => {
    //     document.querySelectorAll('.auto-height-textarea').forEach(textarea => autoResize(textarea));
    // });

    // to edit the question and option
    function edit(theId) {
        var id = document.getElementById('question' + theId);
        id.removeAttribute("readonly");
        id.onfocus = null;
        id.classList.remove("border-0");
        id.classList.add("textarea-mcq");
        id.classList.remove("border-0");
        id.focus();

        var edit = document.getElementById('edit' + theId);
        edit.style.display = "none";
        var save = document.getElementById('save' + theId);
        save.style.display = "inline-block";
    }

    // to edit the answer
    function ansEdit(theId) {
        var id = document.getElementById('answer' + theId);
        id.removeAttribute("readonly");
        id.onfocus = null;
        id.classList.remove("border-0");
        id.classList.add("textarea-mcq");
        id.classList.remove("border-0");
        id.focus();

        var edit = document.getElementById('ansedit' + theId);
        edit.style.display = "none";
        var save = document.getElementById('anssave' + theId);
        save.style.display = "inline-block";
    }

    // to save the question and option
    function save(theId) {
        var id = document.getElementById('question' + theId);
        id.setAttribute('readonly', true);
        id.onfocus = null;
        id.blur();
        id.setAttribute('onfocus', 'this.blur();');
        id.classList.add("border-0");
        id.classList.remove("textarea-mcq");

        var edit = document.getElementById('edit' + theId);
        edit.style.display = "inline-block";
        var save = document.getElementById('save' + theId);
        save.style.display = "none";

        if (theId.length === 2) {
            // console.log(theId);
            var first = theId.charAt(0);
            var second = theId.charAt(1);
            // console.log(first);
            // console.log(second);
            var optAnswer = document.getElementById('optanswer' + first).value;
            // console.log(optAnswer);
            if (optAnswer == second) {
                // console.log(optAnswer);
                var place = document.getElementById('question' + theId).value;
                // console.log(place);
                document.getElementById('answer' + first).value = place;
            }
        }
        if (theId.length > 2) {
            // console.log(theId);
            var first = theId.charAt(0) + theId.charAt(1);
            var second = theId.charAt(2);
            // console.log(first);
            // console.log(second);
            var optAnswer = document.getElementById('optanswer' + first).value;
            // console.log(optAnswer);
            if (optAnswer == second) {
                // console.log(optAnswer);
                var place = document.getElementById('question' + theId).value;
                // console.log(place);
                document.getElementById('answer' + first).value = place;
            }
        }
    }

    // to save the answer
    function ansSave(theId) {
        var id = document.getElementById('answer' + theId);
        id.setAttribute('readonly', true);
        id.onfocus = null;
        id.blur();
        id.setAttribute('onfocus', 'this.blur();');
        id.classList.add("border-0");
        id.classList.remove("textarea-mcq");

        var edit = document.getElementById('ansedit' + theId);
        edit.style.display = "inline-block";
        var save = document.getElementById('anssave' + theId);
        save.style.display = "none";

        var optAnswer = document.getElementById('optanswer' + theId).value;
        var place = document.getElementById('answer' + theId).value;
        if (place.startsWith('a) ') || place.startsWith('b) ') || place.startsWith('c) ') || place.startsWith('d) ')) {
            place = place.slice(3);
        }
        document.getElementById('question' + theId + optAnswer).value = place;
    }

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
                        // document.getElementById('submitBtn').style.display = "block";
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
</script>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>