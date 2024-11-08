<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
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
                                                        <!-- Select the Subject -->
                                                        <!-- <div class="col-6">
                                                            <div class="input-group mb-2"> -->
                                                        <label for="name" class="col-md-4 col-lg-3 col-form-label"><strong>Pdf</strong> <code>*</code></label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="file" type="file" class="form-control" id="image"
                                                                aria-label="Example Input" aria-describedby="button-addon5" accept=".pdf">
                                                        </div>
                                                        <!-- <button name="auto_mcqs" class="btn btn-sm btn-outline-success" type="submit" id="button-addon5">
                                                                Auto Upload
                                                            </button> -->
                                                        <!-- </div>
                                                    </div> -->
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
                                                </form><!-- End Profile Edit Form -->

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
            // getting the mcqs
            if (isset($_POST['generate'])) {
                // API endpoint URL
                $apiUrl = 'http://127.0.0.1:8000/generate_mcqs';

                // file path and query for the request
                $filePath = './5-pages-computer.pdf'; // Update this path to the actual file location
                $query = 'Generate 10 MCQs from this document about any topic with answers at the end';

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
                        'num_mcqs' => 10
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

                // Check the structure of the response
                // print_r($responseData);

                if (isset($responseData['simplified_mcqs']['simplified_mcqs']['mcqs']) && is_array($responseData['simplified_mcqs']['simplified_mcqs']['mcqs'])) {
                    $mcqs = $responseData['simplified_mcqs']['simplified_mcqs']['mcqs'];
                    $_SESSION['mcqs'] = $mcqs;
                    // redirect to the same page

                    // // Loop through the MCQs and display the data
                    // foreach ($mcqs as $mcq) {
                    //     echo "<p><strong>Question:</strong> " . htmlspecialchars($mcq['question']) . "</p>";
                    //     echo "<ul>";
                    //     foreach ($mcq['options'] as $option) {
                    //         echo "<li>" . htmlspecialchars($option) . "</li>";
                    //     }
                    //     echo "</ul>";
                    //     echo "<p><strong>Answer:</strong> " . htmlspecialchars($mcq['answer']) . "</p>";
                    //     echo "<hr>"; // Separate each MCQ
                    // }
                } else {
                    echo "MCQs data is not available or is empty.";
                }
            }

            ?>

            

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