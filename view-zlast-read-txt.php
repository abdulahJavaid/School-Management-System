<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
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
    } else {
        echo "Error uploading the file.";
    }
}

function saveQuestion($question, $option1, $option2, $option3, $option4, $correct_option) {
    // Output the question and options here (you can replace this with DB insertion logic)
    echo "<strong>Question:</strong> $question<br>";
    echo "<strong>Option 1:</strong> $option1<br>";
    echo "<strong>Option 2:</strong> $option2<br>";
    echo "<strong>Option 3:</strong> $option3<br>";
    echo "<strong>Option 4:</strong> $option4<br>";
    echo "<strong>Correct Option:</strong> $correct_option<br><hr>";
}
?>

<!-- HTML form for file upload -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload and Process File</title>
</head>
<body>
    <h2>Upload a .txt file</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept=".txt">
        <button type="submit">Upload and Process</button>
    </form>
</body>
</html>





Warning: Trying to access array offset on value of type null in C:\xampp\htdocs\myschool\add-mcq.php on line 107

Warning: Undefined array key "file" in C:\xampp\htdocs\myschool\add-mcq.php on line 108

Warning: Trying to access array offset on value of type null in C:\xampp\htdocs\myschool\add-mcq.php on line 108

Fatal error: Uncaught ValueError: Path cannot be empty in C:\xampp\htdocs\myschool\add-mcq.php:109 Stack trace: #0 C:\xampp\htdocs\myschool\add-mcq.php(109): file_get_contents('') #1 {main} thrown in C:\xampp\htdocs\myschool\add-mcq.php on line 109