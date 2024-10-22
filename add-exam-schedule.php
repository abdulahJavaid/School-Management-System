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

<main id="main" class="main" onclick="clearResults()">

  <div class="pagetitle">
    <h1>Exam Schedule</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- start of the form -->
  <form method="post" action="">
    <div class="row">
      <div class="container-fluid">
        <div class="row align-items-center">
          <!-- Add timetable select option -->
          <div class="col-auto">
            <div class="input-group">
              <select id="inputState" name="select1" class="form-select mt-3" aria-label="Example input" aria-describedby="button-addon2">
                <option selected value="empty">Class</option>
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
              <button class="btn btn-sm btn-success mt-3 ml-3" name="add" type="submit" id="button-addon2">
                Add Exam Schedule
              </button>
            </div>
          </div>

          <!-- View timetable select option -->
          <div class="col-auto">
            <div class="input-group">
              <input type="month" class="form-control mt-3" value="" name="schedule_month">
            </div>
          </div>

          <div class="col-auto">
            <div class="input-group">
              <select id="inputState" name="select" class="form-select mt-3" aria-label="Example input" aria-describedby="button-addon3">
                <option selected value="empty">Class</option>
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
              <button class="btn btn-sm btn-success mt-3 ml-3" name="view" type="submit" id="button-addon3">
                View Exam Schedule
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <br>
  <!-- end of the form, view/add schedule -->

  <!-- Exam Schedule Form, hidden by default -->
  <section class="section profile" id="examScheduleForm">
    <div class="row">
      <div class="col-md-12">
        <?php
        // if add exam schedule request is submitted
        if (isset($_POST['add']) && $_POST['select1'] != 'empty') {
          $fetch = $_POST['select1'];
          $length = strlen($fetch);
          $find = strpos($fetch, ' ');
          $number = $find + 1;
          $useable = $length - $number;
          $useable1 = $find;

          $section = substr($fetch, -$useable);
          $class = substr($fetch, 0, $find);
          $section = (int) $section;
          $class = (int) $class;
          $section = escape($section);
          $class = escape($class);

          $query = "SELECT * FROM section_subjects WHERE fk_section_id='$section' AND fk_client_id='$client'";
          $get_subjects = query($query);
          $subjects = [];
          while ($row = mysqli_fetch_assoc($get_subjects)) {
            $subjects[$row['subject_id']] = $row['subject_name'];
          }

          $query = "SELECT * FROM all_classes WHERE class_id='$class' AND fk_client_id='$client'";
          $result = query($query);
          $row = mysqli_fetch_assoc($result);
          $query = "SELECT * FROM class_sections WHERE section_id='$section' AND fk_class_id='$class' AND fk_client_id='$client'";
          $result1 = query($query);
          $row1 = mysqli_fetch_assoc($result1);
          $log_class = $row['class_name'];
          $log_section = $row1['section_name'];
        ?>
          <div class="card">
            <div class="card-body pt-3">

              <h5 class="card-title pb-0 mb-1">Class: <?php echo $row['class_name'] . ' ' . $row1['section_name']; ?></h5>
              <p><code><u>Instructions:</u></code>
                <br><code>1. If you leave a field empty, only that record will not be added.</code>
              </p>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                  <form method="post" action="backend/back-add-exam.php">
                    <div class="row mb-3">
                      <div class="row align-items-center">
                        <div class="col-12">
                          <div class="input-group">
                            <label for="exam_title" class="col-md-4 col-lg-2 col-form-label"><strong>Exam Title <code>*</code></strong></label>
                            <input name="exam_title" type="text" class="form-control" value="" placeholder="eg: Montly Test">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="row align-items-center">
                        <div class="col-12">
                          <div class="row">
                            <label for="space" class="col-md-4 col-lg-2 col-form-label"></label>
                            <div class="col-lg-2 pe-3">
                              <span class="text-secondary"><strong>Paper Time</strong></span>
                            </div>

                            <div class="col-lg-2 pe-3">
                              <sapn class="text-secondary"><strong>Subject</strong></span>
                            </div>

                            <div class="col-lg-2 pe-3">
                              <sapn class="text-secondary"><strong>Paper Date</strong></span>
                            </div>

                            <div class="col-lg-2 pe-3">
                              <sapn class="text-secondary"><strong>Submission</strong></span>
                            </div>

                            <div class="col-lg-2 pe-3">
                              <sapn class="text-secondary"><strong>Teacher</strong></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                    // looping to get 9 form fields
                    for ($i = 1; $i < 10; $i++) {
                    ?>
                      <div class="row mb-3">
                        <div class="row align-items-center">
                          <div class="col-12">
                            <div class="input-group">
                              <label for="name<?php echo $i; ?>" class="col-md-4 col-lg-2 col-form-label">Paper <?php echo $i; ?></label>
                              <div class="col-lg-2 px-1">
                                <input name="exam_time<?php echo $i; ?>" type="text" class="form-control" value="" placeholder="paper time">
                              </div>
                              <div class="col-lg-2 px-1">
                                <select name="subject_id<?php echo $i; ?>" id="" class="form-select">
                                  <option value="" disabled selected>Select</option>
                                  <!-- <option value="" disabled selected><input type="text" name="" id=""></option> -->
                                  <?php
                                  foreach ($subjects as $id => $name) {
                                  ?>
                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                              <div class="col-lg-2 px-1">
                                <input name="exam_date<?php echo $i; ?>" type="date" class="form-control" value="" placeholder="date">
                              </div>
                              <div class="col-lg-2 px-1">
                                <input name="submission_date<?php echo $i; ?>" type="date" class="form-control" value="" placeholder="date">
                              </div>
                              <div class="col-lg-2 px-1" style="position: relative;">
                                <input name="teacher_name<?php echo $i; ?>"
                                  type="text"
                                  id="teacher_name<?php echo $i; ?>"
                                  class="form-control" value=""
                                  onclick="getTeachers('<?php echo $i; ?>')"
                                  onkeyup="searchDatabase('<?php echo $i; ?>')"
                                  autocomplete="off"
                                  placeholder="search">
                                <div class="dropdown-menu show" id="results<?php echo $i; ?>" aria-labelledby="search-input" style="position: absolute; z-index: 1000; display: none;"></div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                      <input type="hidden" name="teacher_id<?php echo $i; ?>" id="teacher_id<?php echo $i; ?>">
                    <?php
                    }
                    ?>
                    <input type="hidden" name="section_id" value="<?php echo $row1['section_id']; ?>">
                    <input type="hidden" name="class" value="<?php echo $log_class; ?>">
                    <input type="hidden" name="section" value="<?php echo $log_section; ?>">
                    <div class="d-flex justify-content-end">
                      <button type="submit" name="submit" class="btn btn-sm btn-success">Submit schedule</button>
                    </div>
                  </form><!-- End Add timetable Form -->

                </div>

              </div>

            </div>
          </div>
        <?php
        } // end of code to add exam schedule
        ?>


        <?php
        // code to view exam schedule
        if (isset($_POST['view']) && $_POST['select'] != 'empty' && !empty($_POST['schedule_month'])) {
          // fetching exam month and year
          $get = escape($_POST['schedule_month']);
          $time_stamp = strtotime($get);
          $exam_year = date('Y', $time_stamp);
          $exam_month = date('F', $time_stamp);
          // fetching the class and section id
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
          $section = escape($section);
          $class = escape($class);

          // getting the exam schedule
          $query = "SELECT * FROM exam_schedule INNER JOIN exam_title ON ";
          $query .= "exam_schedule.fk_exam_title_id=exam_title.exam_title_id ";
          $query .= "INNER JOIN class_sections ON exam_schedule.fk_section_id=class_sections.section_id ";
          $query .= "INNER JOIN all_classes ON class_sections.fk_class_id=all_classes.class_id ";
          $query .= "INNER JOIN section_subjects ON ";
          $query .= "exam_schedule.fk_subject_id=section_subjects.subject_id ";
          $query .= "WHERE exam_month='$exam_month' AND exam_year='$exam_year' ";
          $query .= "AND exam_schedule.fk_section_id='$section' AND exam_schedule.fk_client_id='$client'";
          $result = query($query);

          $data = [];
          while ($row = mysqli_fetch_assoc($result)) {
            if (!isset($data[$row['exam_title_id']])) {
              // $data[$row['exam_title_id']] = [];
              $data[$row['exam_title_id']] = [
                'class_name' => $row['class_name'],
                'section_name' => $row['section_name'],
                'exam_title' => $row['exam_title']
              ];
            }
            if (!isset($data[$row['exam_title_id']]['schedule'])) {
              $data[$row['exam_title_id']]['schedule'] = [];
            }
            $data[$row['exam_title_id']]['schedule'][] = $row;
          }
        ?>
          <div class="card">
            <div class="card-body pt-3">
              <?php
              // getting all the exam schedules
              foreach ($data as $get) {

              ?>
                <h5 class="card-title pb-0 mb-0">Class: <?php echo $get['class_name'] . ' ' . $get['section_name']; ?></h5>
                <div class="tab-content pt-0">
                  <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                    <div class="d-flex justify-content-end">
                      <form action="" method="post">
                        <input type="hidden" name="section_id" value="<?php echo $section; ?>">
                        <input type="hidden" name="class_id" value="<?php echo $class; ?>">
                        <button type="submit" name="update" class="btn btn-sm btn-success">Update Schedule</button>
                      </form>
                    </div><br>
                    <!-- Primary Color Bordered Table -->
                    <div class="table-responsive">
                      <table class="table table-bordered border-primary table-hover">
                        <thead>
                          <tr>
                            <th colspan="4"><?php echo $get['exam_title']; ?></th>
                          </tr>
                          <tr>
                            <th scope="col"><input type="hidden" name="section_id" value="<?php echo $row1['section_id']; ?>">#</th>
                            <th scope="col">Time</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 1;
                          foreach ($get['schedule'] as $ro) {
                          ?>
                            <tr>
                              <td>Paper <?php echo $i; ?></td>
                              <td><?php echo $ro['exam_time']; ?></td>
                              <td><?php echo $ro['subject_name']; ?></td>
                              <td><?php echo $ro['exam_date']; ?></td>
                            </tr>
                          <?php
                            $i++;
                          }
                          ?>

                        </tbody>
                      </table>
                    </div>

                  </div>

                </div>
              <?php } ?>
            </div>
          </div>
        <?php
        } // end of if to view exam schedule
        ?>
        <?php
        // if add exam schedule request is submitted
        if (isset($_POST['update'])) {
          $section = (int) $_POST['section_id'];
          $class = (int) $_POST['class_id'];
          $section = escape($section);
          $class = escape($class);

          $query = "SELECT * FROM all_classes WHERE class_id='$class' AND fk_client_id='$client'";
          $result = query($query);
          $row = mysqli_fetch_assoc($result);
          $query = "SELECT * FROM class_sections WHERE section_id='$section' AND fk_class_id='$class' AND fk_client_id='$client'";
          $result1 = query($query);
          $row1 = mysqli_fetch_assoc($result1);
          $log_class = $row['class_name'];
          $log_section = $row1['section_name'];
        ?>
          <div class="card">
            <div class="card-body pt-3">

              <h5 class="card-title mb-0 pb-1">Class: <?php echo $row['class_name'] . ' ' . $row1['section_name']; ?></h5>
              <p><code><u>Instructions:</u></code>
                <br><code>1. Don't leave time/subject/date empty or the relevant record will not be added</code>
              </p>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                  <form method="post" action="backend/back-add-exam.php">
                    <?php
                    // looping to get all exam schedule fields
                    $query = "SELECT * FROM exam_schedule WHERE fk_section_id='$section' AND fk_client_id='$client'";
                    $result = query($query);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                      <div class="row mb-3">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <div class="input-group">
                              <label for="name<?php echo $i; ?>" class="col-md-4 col-lg-3 col-form-label">Paper <?php echo $i; ?></label>
                              <!-- <div class="col-md-6"> -->
                              <input name="time<?php echo $i; ?>" type="text" class="form-control" value="<?php echo $row['exam_time']; ?>" placeholder="time">
                              &nbsp;&nbsp;
                              <input name="subject<?php echo $i; ?>" type="text" class="form-control" value="<?php echo $row['fk_subject_id']; ?>" placeholder="subject">
                              &nbsp;&nbsp;
                              <input name="date<?php echo $i; ?>" type="date" class="form-control" value="<?php echo $row['exam_date']; ?>" placeholder="date">
                              <!-- </div> -->
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php
                      $i++;
                    }
                    ?>
                    <input type="hidden" name="section_id" value="<?php echo $row1['section_id']; ?>">
                    <input type="hidden" name="class" value="<?php echo $log_class; ?>">
                    <input type="hidden" name="section" value="<?php echo $log_section; ?>">
                    <div class="d-flex justify-content-end">
                      <button type="submit" name="submit" class="btn btn-sm btn-success">Submit schedule</button>
                    </div>
                  </form><!-- End Add timetable Form -->

                </div>

              </div>

            </div>
          </div>
        <?php
        } // end of if to update exam schedule
        ?>
      </div>
    </div>
  </section>

</main><!-- End #main -->

<script>
  // clear all results
  function clearResults() {
    var i = 1;
    while (i < 10) {
      document.getElementById('results' + i).style.display = 'none';
      i++;
    }
  }

  // code to get all the teachers of the school
  function getTeachers(id) {
    var teacherName = 'teacher_name' + id;
    var resultList = 'results' + id;
    var teacherId = 'teacher_id' + id;

    var searchQuery = document.getElementById(teacherName).value.trim();
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './backend/search-teacher.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        try {
          var response = JSON.parse(xhr.responseText);
          var resultsDiv = document.getElementById(resultList);
          resultsDiv.innerHTML = ''; // Clear previous results
          if (response.length > 0) {
            // Show and style the results div
            resultsDiv.style.display = 'block';
            resultsDiv.style.maxHeight = '200px';
            resultsDiv.style.overflowY = 'scroll';
            resultsDiv.style.cursor = 'pointer';

            // Loop through each result
            response.forEach(function(item) {
              var resultItem = document.createElement('div');
              // Bootstrap styling for each item
              resultItem.classList.add('dropdown-item');

              // Create element
              var name = document.createElement('span');
              name.textContent = item.name;
              name.style.display = 'block';
              resultItem.appendChild(name);

              // //   add the dropdown divider class
              //   var divider = document.createElement('div');
              //   divider.classList.add('dropdown-divider');
              //   resultItem.appendChild(divider);

              // Add the result item to the results div
              resultsDiv.appendChild(resultItem);

              // Add onclick event for each result item
              resultItem.onclick = function() {
                document.getElementById(teacherName).value = item.name;
                document.getElementById(teacherId).value = item.id;
              };
            });
          } else {
            resultsDiv.style.display = 'none';
          }
        } catch (e) {
          console.error('Error parsing JSON:', e);
          console.error('Response text:', xhr.responseText);
        }
      }
    };
    xhr.send('allquery=' + encodeURIComponent('1'));
  }


  // code to get the search results of the matching teachernames
  function searchDatabase(id) {
    var teacherName = 'teacher_name' + id;
    var resultList = 'results' + id;
    var teacherId = 'teacher_id' + id;

    var searchQuery = document.getElementById(teacherName).value.trim();

    // If the search query is empty, hide the results
    if (searchQuery.length === 0) {
      document.getElementById('results').style.display = 'none';
      return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', './backend/search-teacher.php', true); // Adjust the path to your PHP file
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        try {
          var response = JSON.parse(xhr.responseText);

          var resultsDiv = document.getElementById(resultList);
          resultsDiv.innerHTML = ''; // Clear previous results

          if (response.length > 0) {
            // Show and style the results div
            resultsDiv.style.display = 'block';
            resultsDiv.style.maxHeight = '200px';
            resultsDiv.style.overflowY = 'scroll';
            resultsDiv.style.cursor = 'pointer';

            // Loop through each result and add as a nav link
            response.forEach(function(item) {
              var resultItem = document.createElement('div');
              resultItem.classList.add('dropdown-item'); // Bootstrap styling for each item

              // Create a link element
              var name = document.createElement('span');
              name.textContent = item.name; // Display the result name
              name.style.display = 'block'; // Make the link a block element
              resultItem.appendChild(name);

              // //   add the dropdown divider class
              //   var divider = document.createElement('div');
              //   divider.classList.add('dropdown-divider');
              //   resultItem.appendChild(divider);

              resultsDiv.appendChild(resultItem);

              // Add onclick event for each result item
              resultItem.onclick = function() {
                document.getElementById(teacherName).value = item.name;
                document.getElementById(teacherId).value = item.id;
              };
            });
          } else {
            resultsDiv.style.display = 'none';
          }
        } catch (e) {
          console.error('Error parsing JSON:', e);
          console.error('Response text:', xhr.responseText);
        }
      }
    };

    xhr.send('query=' + encodeURIComponent(searchQuery));
  }
</script>


<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>