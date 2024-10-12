<?php

// function to add autoloaded mcqs
function saveQuestion($question, $option1, $option2, $option3, $option4, $correct_option)
{
    $chapter = $_POST['chapter'];

    // insert the question
    $query = "INSERT INTO questions(question, fk_chapter_id) ";
    $query .= "VALUES('$question', '$chapter')";
    $insert_question = query($query);

    // getting the last inserted id
    $last_id = last_id();

    // insert option 1
    if ($correct_option == 'option1') {
        $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
        $query .= "VALUES('$option1', 'correct', '$last_id')";
        $insert_option1 = query($query);
    } else {
        $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
        $query .= "VALUES('$option1', 'incorrect', '$last_id')";
        $insert_option1 = query($query);
    }

    // insert option 2
    if ($correct_option == 'option2') {
        $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
        $query .= "VALUES('$option2', 'correct', '$last_id')";
        $insert_option2 = query($query);
    } else {
        $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
        $query .= "VALUES('$option2', 'incorrect', '$last_id')";
        $insert_option2 = query($query);
    }

    // insert option 3
    if ($option3 != 'empty') {
        if ($correct_option == 'option3') {
            $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
            $query .= "VALUES('$option3', 'correct', '$last_id')";
            $insert_option3 = query($query);
        } else {
            $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
            $query .= "VALUES('$option3', 'incorrect', '$last_id')";
            $insert_option3 = query($query);
        }
    }

    // insert option 4
    if ($option4 != 'empty') {
        if ($correct_option == 'option4') {
            $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
            $query .= "VALUES('$option4', 'correct', '$last_id')";
            $insert_option4 = query($query);
        } else {
            $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
            $query .= "VALUES('$option4', 'incorrect', '$last_id')";
            $insert_option4 = query($query);
        }
    }
}

// auto add mcqs
if (isset($_POST['auto_mcqs'])) {
    // redirect("./");
    $board = $_POST['board'];
    $class = $_POST['class'];
    $subject = $_POST['subject'];
    $chapter = $_POST['chapter'];
    if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileContents = file_get_contents($fileTmpPath);

        // Split the content by lines
        $lines = explode(PHP_EOL, $fileContents);
        $question = '';
        $option1 = $option2 = $option3 = $option4 = 'empty';
        $correct_option = '';

        foreach ($lines as $line) {
            $line = trim($line);

            if (strpos($line, 'Q.') === 0) {
                // Save the previous question if it exists
                if (!empty($question)) {
                    saveQuestion($question, $option1, $option2, $option3, $option4, $correct_option);
                }

                // Extract the new question text
                $question = trim(substr($line, 2)); // Remove 'Q.' from the start
                // Reset options and correct option
                $option1 = $option2 = $option3 = $option4 = 'empty';
                $correct_option = '';
            }

            if (strpos($line, 'O.') === 0) {
                // Remove 'O.' and get the options
                $options = trim(substr($line, 2)); // Remove 'O.' from the start
                $optionList = explode(' ', $options);
                $optionCount = 1;

                foreach ($optionList as $option) {
                    $isCorrect = false;

                    // Check if this option is marked as correct
                    if (strpos($option, '(correct)') !== false) {
                        $option = str_replace('(correct)', '', $option);
                        $isCorrect = true;
                    }

                    $optionVar = 'option' . $optionCount;
                    $$optionVar = trim($option);

                    if ($isCorrect) {
                        $correct_option = 'option' . $optionCount;
                    }

                    $optionCount++;
                }

                // Fill remaining options as 'empty' if less than 4
                for ($i = $optionCount; $i <= 4; $i++) {
                    ${'option' . $i} = 'empty';
                }
            }
        }

        // Save the last question in the file
        if (!empty($question)) {
            saveQuestion($question, $option1, $option2, $option3, $option4, $correct_option);
        }
        redirect("./add-mcq.php?board=$board&class=$class&subject=$subject&chapter=$chapter&add_mcqs=''");
    } else {
        echo "Error uploading the file.";
    }
}

// add single mcq
if (isset($_POST['submit_mcq'])) {
    $board = $_POST['board'];
    $class = $_POST['class'];
    $subject = $_POST['subject'];
    $chapter = $_POST['chapter'];

    if (empty($_POST['op3']) && isset($_POST['option_status']) && $_POST['option_status'] == 'op3') {
        echo "<script type='text/javascript'>
                var board = '$board';
                var className = '$class';
                var subject = '$subject';
                var chapter = '$chapter';
                alert('Option 3 cannot be correct option if it is empty.');
                setTimeout(function() {
                    window.location.href = './add-mcq.php?board=' + board + '&class=' + className + '&subject=' + subject + '&chapter=' + chapter + '&add_mcqs=';
                }, 100); // Redirect after 3 seconds
              </script>";
        exit(); // Stop further processing
    }
    if (empty($_POST['op4']) && isset($_POST['option_status']) && $_POST['option_status'] == 'op4') {
        echo "<script type='text/javascript'>
                var board = '$board';
                var className = '$class'; // Use className to avoid conflict with class keyword
                var subject = '$subject';
                alert('Option 4 cannot be correct option if it is empty.');
                setTimeout(function() {
                    window.location.href = './add-mcq.php?board=' + board + '&class=' + className + '&subject=' + subject + '&chapter=' + chapter + '&add_mcqs=';
                }, 100); // Redirect after 3 seconds
              </script>";
        exit(); // Stop further processing
    }

    // insert the question
    $question = $_POST['q1'];
    $query = "INSERT INTO questions(question, fk_chapter_id) ";
    $query .= "VALUES('$question', '$chapter')";
    $insert_question = query($query);

    // getting the last inserted id
    $last_id = last_id();


    $option2 = $_POST['op2'];

    // insert option 1
    if (isset($_POST['option_status']) && $_POST['option_status'] == 'op1') {
        $option1 = $_POST['op1'];
        $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
        $query .= "VALUES('$option1', 'correct', '$last_id')";
        $insert_option1 = query($query);
    } else {
        $option1 = $_POST['op1'];
        $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
        $query .= "VALUES('$option1', 'incorrect', '$last_id')";
        $insert_option1 = query($query);
    }

    // insert option 2
    if (isset($_POST['option_status']) && $_POST['option_status'] == 'op2') {
        $option2 = $_POST['op2'];
        $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
        $query .= "VALUES('$option2', 'correct', '$last_id')";
        $insert_option2 = query($query);
    } else {
        $option2 = $_POST['op2'];
        $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
        $query .= "VALUES('$option2', 'incorrect', '$last_id')";
        $insert_option2 = query($query);
    }

    // insert option 3
    if (!empty($_POST['op3'])) {
        if (isset($_POST['option_status']) && $_POST['option_status'] == 'op3') {
            $option3 = $_POST['op3'];
            $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
            $query .= "VALUES('$option3', 'correct', '$last_id')";
            $insert_option3 = query($query);
        } else {
            $option3 = $_POST['op3'];
            $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
            $query .= "VALUES('$option3', 'incorrect', '$last_id')";
            $insert_option3 = query($query);
        }
    }

    // insert option 4
    if (!empty($_POST['op4'])) {
        if (isset($_POST['option_status']) && $_POST['option_status'] == 'op4') {
            $option4 = $_POST['op4'];
            $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
            $query .= "VALUES('$option4', 'correct', '$last_id')";
            $insert_option4 = query($query);
        } else {
            $option4 = $_POST['op4'];
            $query = "INSERT INTO options(option_description, option_status, fk_question_id) ";
            $query .= "VALUES('$option4', 'incorrect', '$last_id')";
            $insert_option4 = query($query);
        }
    }

    redirect("./add-mcq.php?board=$board&class=$class&subject=$subject&chapter=$chapter&add_mcqs=''");
}
