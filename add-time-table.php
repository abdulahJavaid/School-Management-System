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
// checking the last page
// if ($_SESSION['pdf'] == 'set') {
//   echo "<script>alert('this is alert')</script>";
//   unset($_SESSION['pdf']);
//   redirect("./");
//   exit;
// }
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Timetable</h1>
    <nav>
      <ol class="breadcrumb">
        <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Users</li> -->
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
              <button class="btn btn-sm btn-success mt-3 ml-3" name="add" type="submit" id="button-addon2">Add Timetable</button>
            </div>
          </div>

          <!-- View timetable select option -->
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
              <button class="btn btn-sm btn-success mt-3 ml-3" name="view" type="submit" id="button-addon3">View Timetable</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- end of the form -->
  <br>


  <!-- to add the timetable -->
  <section class="section profile">
    <div class="row">
      <div class="col-md-12">
        <?php
        // if add timetable request is submitted
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
          $class = escape($class);
          $section = escape($section);

          $query = "SELECT * FROM all_classes WHERE class_id='$class' AND fk_client_id='$client'";
          $result = query($query);
          $row = mysqli_fetch_assoc($result);
          $query = "SELECT * FROM class_sections WHERE section_id='$section' AND fk_class_id='$class' AND fk_client_id='$client'";
          $result1 = query($query);
          $row1 = mysqli_fetch_assoc($result1);
          $log_class = $row['class_name']; // class name for log creation
          $log_section = $row1['section_name']; // section name for log creation

        ?>
          <div class="card">
            <div class="card-header card-bg-header text-white mb-3">
              <h5 class="mb-0 text-dark"><i class="fas fa-clipboard-list pro-header-icon"></i><strong>Class: <?php echo $row['class_name'] . ' ' . $row1['section_name']; ?></strong></h5>
            </div>
            <div class="card-body">
              <!-- <h5 class="card-title">Class: <?php //echo $row['class_name'] . ' ' . $row1['section_name']; 
                                                  ?></h5> -->
              <p><code><u>Instructions:</u></code>
                <br><code>1. Don't leave time empty or the relevant records will not be added</code>
                <br><code>2. If you want to add a break, tick the break box</code>
                <br><code>3. If Saturday is a holiday, don't add periods on Saturday</code>
              </p>

              <!-- Primary Color Bordered Table -->
              <form action="./backend/back-add-timetable.php" method="post">
                <div class="table-responsive">
                  <table class="table table-bordered border-primary">
                    <thead>
                      <tr>
                        <th scope="col"><input type="hidden" name="section_id" value="<?php echo $row1['section_id']; ?>">#&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th scope="col"><input type="hidden" name="monday" value="Monday">Monday</th>
                        <th scope="col"><input type="hidden" name="tuesday" value="Tuesday">Tuesday</th>
                        <th scope="col"><input type="hidden" name="wednesday" value="Wednesday">Wednesday</th>
                        <th scope="col"><input type="hidden" name="thursday" value="Thursday">Thursday</th>
                        <th scope="col"><input type="hidden" name="friday" value="Friday">Friday</th>
                        <th scope="col"><input type="hidden" name="saturday" value="Saturday">Saturday</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // loooping the fields 9 times
                      for ($i = 1; $i < 10; $i++) {
                      ?>
                        <!-- start tr -->
                        <tr>
                          <td><input type="text" name="time<?php echo $i; ?>" class="form-control inpt" placeholder="time" size="5"></td>
                          <td>
                            <input type="text" name="dm<?php echo $i; ?>" class="form-control inpt-1" size="3" placeholder="Subject">
                            <select id="inputState" name="tm<?php echo $i; ?>" class="form-select mt-1 inpt-1">
                              <option value="">Teacher</option>
                              <?php
                              // select the teacher
                              $result2 = sql_where('teacher_profile', 'fk_client_id', $client);
                              while ($row = mysqli_fetch_assoc($result2)) {
                              ?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                            <input type="checkbox" name="bm<?php echo $i; ?>"> Break
                          </td>
                          <td>
                            <input type="text" name="dt<?php echo $i; ?>" class="form-control inpt-1" size="3" placeholder="Subject">
                            <select id="inputState" name="tt<?php echo $i; ?>" class="form-select mt-1 inpt-1">
                              <option value="">Teacher</option>
                              <?php
                              // select the teacher
                              $result2 = sql_where('teacher_profile', 'fk_client_id', $client);
                              while ($row = mysqli_fetch_assoc($result2)) {
                              ?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                            <input type="checkbox" name="bt<?php echo $i; ?>"> Break
                          </td>
                          <td>
                            <input type="text" name="dw<?php echo $i; ?>" class="form-control inpt-1" size="3" placeholder="Subject">
                            <select id="inputState" name="tw<?php echo $i; ?>" class="form-select mt-1 inpt-1">
                              <option value="">Teacher</option>
                              <?php
                              // select the teacher
                              $result2 = sql_where('teacher_profile', 'fk_client_id', $client);
                              while ($row = mysqli_fetch_assoc($result2)) {
                              ?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                            <input type="checkbox" name="bw<?php echo $i; ?>"> Break
                          </td>
                          <td>
                            <input type="text" name="dth<?php echo $i; ?>" class="form-control inpt-1" size="3" placeholder="Subject">
                            <select id="inputState" name="tth<?php echo $i; ?>" class="form-select mt-1 inpt-1">
                              <option value="">Teacher</option>
                              <?php
                              // select the teacher
                              $result2 = sql_where('teacher_profile', 'fk_client_id', $client);
                              while ($row = mysqli_fetch_assoc($result2)) {
                              ?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                            <input type="checkbox" name="bth<?php echo $i; ?>"> Break
                          </td>
                          <td>
                            <input type="text" name="df<?php echo $i; ?>" class="form-control inpt-1" size="3" placeholder="Subject">
                            <select id="inputState" name="tf<?php echo $i; ?>" class="form-select mt-1 inpt-1">
                              <option value="">Teacher</option>
                              <?php
                              // select the teacher
                              $result2 = sql_where('teacher_profile', 'fk_client_id', $client);
                              while ($row = mysqli_fetch_assoc($result2)) {
                              ?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                            <input type="checkbox" name="bf<?php echo $i; ?>"> Break
                          </td>
                          <td>
                            <input type="text" name="ds<?php echo $i; ?>" class="form-control inpt-1" size="3" placeholder="Subject">
                            <select id="inputState" name="ts<?php echo $i; ?>" class="form-select mt-1 inpt-1">
                              <option value="">Teacher</option>
                              <?php
                              // select the teacher
                              $result2 = sql_where('teacher_profile', 'fk_client_id', $client);
                              while ($row = mysqli_fetch_assoc($result2)) {
                              ?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                            <input type="checkbox" name="bs<?php echo $i; ?>"> Break
                          </td>
                        </tr>
                        <!-- end tr -->
                      <?php
                      }
                      ?>

                    </tbody>
                  </table>
                </div>
                <div class="d-flex justify-content-end">
                  <input type="hidden" name="class" value="<?php echo $log_class; ?>">
                  <input type="hidden" name="section" value="<?php echo $log_section; ?>">
                  <button type="submit" name="submit" class="btn btn-success">Submit timetable</button>
                </div>
              </form>
            </div>
          </div>
        <?php
          // end of if statement to add timetable
        }
        ?>
        <!-- End Primary Color Bordered Table -->
        <!-- End add the timetable -->

        <?php
        // to view the timetable
        if (isset($_POST['view']) && $_POST['select'] != 'empty') {
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
          $class = escape($class);
          $section = escape($section);

          $query = "SELECT * FROM all_classes WHERE class_id='$class' AND fk_client_id='$client'";
          $result = query($query);
          $row = mysqli_fetch_assoc($result);
          $query = "SELECT * FROM class_sections WHERE section_id='$section' AND fk_class_id='$class' AND fk_client_id='$client'";
          $result1 = query($query);
          $row1 = mysqli_fetch_assoc($result1);
          $sid = $row1['section_id'];
          $sid = escape($sid);

        ?>
          <!-- start of card -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Class: <?php echo $row['class_name'] . " " . $row1['section_name']; ?></h5>
              <!-- <p><code><u>Timetable:</u></code></p> -->

              <div class="d-flex justify-content-end">
                <form action="generate-pdf.php" method="post" class="form-inline">
                  <div class="me-2">
                    <input type="hidden" name="class_section" value="<?php echo $row['class_name'] . " " . $row1['section_name']; ?>">
                    <input type="hidden" name="section_id" value="<?php echo $section; ?>">
                    <button type="submit" name="download_timetable" class="btn btn-sm btn-outline-success">
                      Download
                    </button>
                  </div>
                </form>
                <form action="" method="post" class="">
                  <input type="hidden" name="section_id" value="<?php echo $section; ?>">
                  <input type="hidden" name="class_id" value="<?php echo $class; ?>">
                  <button type="submit" name="update" class="btn btn-sm btn-success">Update timetable</button>
                </form>
              </div><br>
              <!-- Primary Color Bordered Table -->
              <div class="table-responsive">
                <table class="table table-bordered border-primary table-hover">
                  <thead>
                    <tr>
                      <th scope="col"><input type="hidden" name="section_id" value="<?php echo $row1['section_id']; ?>">#</th>
                      <?php
                      // Select day names from the database
                      $query = "SELECT * FROM timetable WHERE fk_section_id='$sid' AND fk_client_id='$client'";
                      $result = query($query);
                      while ($row3 = mysqli_fetch_assoc($result)) {
                        $day = $row3['day'];
                      ?>
                        <th scope="col"><?php echo $day; ?></th>
                      <?php
                      }
                      ?>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    // to fetch all the periods
                    $query = "SELECT * FROM periods WHERE fk_section_id='$sid' AND fk_client_id='$client'";
                    $ge = query($query);
                    $arr = array(0, 6, 12, 18, 24, 30, 36, 42, 48, 54, 60);
                    $arr1 = array(5, 11, 17, 23, 29, 35, 41, 47, 53, 59, 65);
                    $va = 0;
                    while ($ro = mysqli_fetch_assoc($ge)) {
                      if (in_array($va, $arr)) {

                    ?>
                        <tr>
                          <td><?php echo $ro['time']; ?></td>
                          <?php if ($ro['period_name'] == 'break') { ?>
                            <td><?php echo $ro['period_name']; ?></td>
                          <?php } else { ?>
                            <td><?php echo $ro['period_name'] . ' - ' . $ro['teacher_name']; ?></td>
                          <?php } ?>
                        <?php
                      } else {
                        ?>
                          <?php if ($ro['period_name'] == 'break') { ?>
                            <td><?php echo $ro['period_name']; ?></td>
                          <?php } else { ?>
                            <td><?php echo $ro['period_name'] . ' - ' . $ro['teacher_name']; ?></td>
                          <?php } ?>

                      <?php
                        if (in_array($va, $arr1)) {
                          echo "</tr>";
                        }
                      }
                      $va++;
                    }
                      ?>
                      <!-- end tr -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <?php
          // end of if statement to view timetable
        }
        ?>
        <!-- End Primary Color Bordered Table -->
        <!-- end view timetable -->
        <!-- end of card -->

        <?php
        // if POST request is submitted to update the timetable
        if (isset($_POST['update'])) {
          $section = $_POST['section_id'];
          $class = $_POST['class_id'];
          $class = escape($class);
          $section = escape($section);

          $query = "SELECT * FROM all_classes WHERE class_id='$class' AND fk_client_id='$client'";
          $result = query($query);
          $row = mysqli_fetch_assoc($result);
          $query = "SELECT * FROM class_sections WHERE section_id='$section' AND fk_class_id='$class' AND fk_client_id='$client'";
          $result1 = query($query);
          $row1 = mysqli_fetch_assoc($result1);
          $sid = $row1['section_id'];
          $sid = escape($sid);
          $log_class = $row['class_name']; // class name for log creation
          $log_section = $row1['section_name']; // section name for log creation

        ?>
          <div class="card">
            <div class="card-header card-bg-header text-white mb-3">
              <h5 class="mb-0 text-dark"><i class="fas fa-clipboard-list pro-header-icon"></i><strong>Class: <?php echo $row['class_name'] . ' ' . $row1['section_name']; ?></strong></h5>
            </div>
            <div class="card-body">
              <!-- <h5 class="card-title">Class: <?php //echo $row['class_name'] . ' ' . $row1['section_name']; 
                                                  ?></h5> -->
              <p><code><u>Instructions:</u></code>
                <br><code>1. Don't leave time empty or the relevant records will not be added</code>
                <br><code>2. If you want to add a break, tick the break box</code>
                <br><code>3. If Saturday is a holiday, don't add periods on Saturday</code>
              </p>

              <!-- Primary Color Bordered Table -->
              <form action="./backend/back-add-timetable.php" method="post">
                <div class="table-responsive">
                  <table class="table table-bordered border-primary">
                    <thead>
                      <tr>
                        <th scope="col"><input type="hidden" name="section_id" value="<?php echo $row1['section_id']; ?>">#&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th scope="col"><input type="hidden" name="monday" value="Monday">Monday</th>
                        <th scope="col"><input type="hidden" name="tuesday" value="Tuesday">Tuesday</th>
                        <th scope="col"><input type="hidden" name="wednesday" value="Wednesday">Wednesday</th>
                        <th scope="col"><input type="hidden" name="thursday" value="Thursday">Thursday</th>
                        <th scope="col"><input type="hidden" name="friday" value="Friday">Friday</th>
                        <th scope="col"><input type="hidden" name="saturday" value="Saturday">Saturday</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      // to fetch all the periods of the selected section to update
                      $query = "SELECT * FROM periods WHERE fk_section_id='$sid' AND fk_client_id='$client'";
                      $ge = query($query);
                      // array to check the start of a row <tr>
                      $arr = array(0, 6, 12, 18, 24, 30, 36, 42, 48, 54, 60);
                      // array to check the end of a row </tr>
                      $arr1 = array(5, 11, 17, 23, 29, 35, 41, 47, 53, 59, 65);
                      // array for unique input<->name generation for subject
                      $d = ['dm', 'dt', 'dw', 'dth', 'df', 'ds'];
                      // array for unique input<->name generation for teacher
                      $t = ['tm', 'tt', 'tw', 'tth', 'tf', 'ts'];
                      // array for unique input<->name generation for break
                      $b = ['bm', 'bt', 'bw', 'bth', 'bf', 'bs'];
                      // variable to check and control inclusion of <tr>&</tr> where necessary
                      $va = 0;
                      // variable to increment after a complete <tr></tr>
                      $i = 1;
                      // variable to go through above defined arrays and reset after complete <tr></tr>
                      $j = 0;
                      while ($ro = mysqli_fetch_assoc($ge)) {
                        // $slct = 0;
                        if (in_array($va, $arr)) {
                          // if the loop rotation is first for each table row
                      ?>
                          <tr>
                            <td><input type="text" name="time<?php echo $i; ?>" class="form-control inpt" value="<?php echo $ro['time']; ?>" placeholder="time" size="5"></td>
                            <?php if ($ro['period_name'] == 'break') { ?>
                              <td>
                                <input type="text" name="<?php echo $d[$j] . $i; ?>" class="form-control inpt-1" size="3" placeholder="Subject">
                                <select id="inputState" name="<?php echo $t[$j] . $i; ?>" class="form-select mt-1 inpt-1">
                                  <option value="">Teacher</option>
                                  <?php
                                  // select the teacher
                                  $result2 = sql_where('teacher_profile', 'fk_client_id', $client);
                                  while ($r = mysqli_fetch_assoc($result2)) {
                                  ?>
                                    <option value="<?php echo $r['name']; ?>"><?php echo $r['name']; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                                <input type="checkbox" name="<?php echo $b[$j] . $i; ?>" checked> Break
                              </td>
                            <?php } else {
                              // {elese} if the period_name != break
                            ?>
                              <td>
                                <input type="text" name="<?php echo $d[$j] . $i; ?>" value="<?php echo $ro['period_name']; ?>" class="form-control inpt-1" size="3" placeholder="Subject">
                                <select id="inputState" name="<?php echo $t[$j] . $i; ?>" class="<?php echo $t[$j] . $i; ?> form-select mt-1 inpt-1">
                                  <?php
                                  // getting teacher_name value for the period
                                  $tch = escape($ro['period_id']);
                                  $query = "SELECT * FROM periods WHERE period_id='$tch' AND fk_client_id='$client'";
                                  $res = query($query);
                                  $rws = mysqli_fetch_assoc($res);
                                  if ($rws['teacher_name'] == '!') {
                                    // if there was no teacher previously assigned
                                  ?>
                                    <option value="">Teacher</option>
                                  <?php
                                  } else {
                                    // the teacher which was previously assigned
                                  ?>
                                    <option selected value="<?php echo $rws['teacher_name']; ?>"><?php echo $rws['teacher_name']; ?></option>
                                  <?php
                                  }
                                  // selecting and showing other teachers which were not previously assigned
                                  $tch_name = escape($rws['teacher_name']);
                                  $tch = escape($ro['period_id']);
                                  $query = "SELECT * FROM teacher_profile WHERE fk_client_id='$client' AND NOT name='$tch_name'";
                                  $result2 = query($query);
                                  while ($r = mysqli_fetch_assoc($result2)) {
                                    // if($r['name'] == $ro['teacher_name']){
                                    //   $cls = $t[$j].$i;
                                    //   echo "<script type='text/javascript'>select_opt({$cls}, {$slct});</script>";
                                    // }
                                  ?>
                                    <option value="<?php echo $r['name']; ?>"><?php echo $r['name']; ?></option>
                                  <?php
                                    // }
                                    // $slct++;
                                  }
                                  ?>
                                </select>
                                <input type="checkbox" name="<?php echo $b[$j] . $i; ?>"> Break
                              </td>
                            <?php } ?>
                          <?php
                        } else {
                          // {else} if the loop rotation is not 1st for each table row
                          ?>
                            <?php if ($ro['period_name'] == 'break') {
                              // if the period_name == break
                            ?>
                              <td>
                                <input type="text" name="<?php echo $d[$j] . $i; ?>" class="form-control inpt-1" size="3" placeholder="Subject">
                                <select id="inputState" name="<?php echo $t[$j] . $i; ?>" class="form-select mt-1 inpt-1">
                                  <option value="">Teacher</option>
                                  <?php

                                  // select all the teachers
                                  $result2 = sql_where('teacher_profile', 'fk_client_id', $client);
                                  while ($r = mysqli_fetch_assoc($result2)) {
                                  ?>
                                    <option value="<?php echo $r['name']; ?>"><?php echo $r['name']; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                                <!-- The period_name was equal to break -->
                                <input type="checkbox" name="<?php echo $b[$j] . $i; ?>" checked> Break
                              </td>
                            <?php } else {
                              // {else} if the period_name was not break
                            ?>
                              <td>
                                <input type="text" name="<?php echo $d[$j] . $i; ?>" value="<?php echo $ro['period_name']; ?>" class="form-control inpt-1" size="3" placeholder="Subject">
                                <select id="inputState" name="<?php echo $t[$j] . $i; ?>" class="form-select mt-1 inpt-1">
                                  <?php
                                  // getting the teacher_name value from period
                                  $tch = escape($ro['period_id']);
                                  $query = "SELECT * FROM periods WHERE period_id='$tch' AND fk_client_id='$client'";
                                  $res = query($query);
                                  $rws = mysqli_fetch_assoc($res);
                                  if ($rws['teacher_name'] == '!') {
                                    // if there was no teacher assigned previously
                                  ?>
                                    <option value="">Teacher</option>
                                  <?php
                                  } else {
                                    // if there was a teacher assigned previously
                                  ?>
                                    <option selected value="<?php echo $rws['teacher_name']; ?>"><?php echo $rws['teacher_name']; ?></option>
                                  <?php
                                  }
                                  // selecting and showing other teachers which were not previously assigned to class
                                  $tch_name = escape($rws['teacher_name']);
                                  $tch = escape($ro['period_id']);
                                  $query = "SELECT * FROM teacher_profile WHERE fk_client_id='$client' AND NOT name='$tch_name'";
                                  $result2 = query($query);
                                  while ($r = mysqli_fetch_assoc($result2)) {
                                    // if($r['name'] == $ro['teacher_name']){
                                    //   $cls = $t[$j].$i;
                                    //   echo "<script src=assets/js/main.js' type='text/javascript'>select_opt({$cls}, {$slct});</script>";
                                    // }
                                  ?>
                                    <option value="<?php echo $r['name']; ?>"><?php echo $r['name']; ?></option>
                                  <?php
                                    // }
                                    // $slct++;
                                  }
                                  ?>
                                </select>
                                <input type="checkbox" name="<?php echo $b[$j] . $i; ?>"> Break
                              </td>
                            <?php } ?>

                        <?php
                          if (in_array($va, $arr1)) {
                            // after 6 rotations, including closing </tr>
                            echo "</tr>";
                          }
                        }
                        if (in_array($va, $arr1)) {
                          // after every 6 rotations, incrementing and resetting the variable
                          $i++;
                          $j = 0;
                        } else {
                          // variab to add days names to input forms
                          $j++;
                        }
                        // variable to check when to display time field
                        $va++;
                      }
                        ?>
                        <!-- end of code to update timetable -->
                    </tbody>
                  </table>
                </div>
                <div class="d-flex justify-content-end">
                  <input type="hidden" name="class" value="<?php echo $log_class; ?>">
                  <input type="hidden" name="section" value="<?php echo $log_section; ?>">
                  <button type="submit" name="submit" class="btn btn-success">Submit timetable</button>
                </div>
              </form>
            </div>
          </div>
        <?php
          // end of if statement to update timetable
        }
        ?>
        <!-- End Primary Color Bordered Table -->
        <!-- end update timetable -->
        <!-- end of card -->

      </div>
    </div>
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>