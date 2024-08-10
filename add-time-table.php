<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Add/View/Update Timetable</h1>
    <nav>
      <ol class="breadcrumb">
        <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
        <li class="breadcrumb-item active">School name here</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- add timetable -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <form method="post" action="">
          <div class="input-group mb-3">
            <button class="btn btn-primary mt-3" type="button">Select</button>
            <select id="inputState" name="select" class="form-select mt-3">
              <option selected>Class</option>
              <?php
              // fetching all the classes 
              $result = sql_select_all("all_classes");
              while ($row = mysqli_fetch_assoc($result)) {

              ?>
                <optgroup label="Class: <?php echo $row['class_name']; ?>">
                  <?php
                  // fetching the related sections
                  $result1 = sql_where("class_sections", "fk_class_id", $row['class_id']);
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
      <div class="col-md-4">
        <button class="btn btn-md btn-primary mt-3 ml-3" name="add" type="submit">Add Timetable</button>
      </div>
      </form>
    </div>
  </div>
  <!-- end add timetable -->

  <!-- view timetable -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <form method="post" action="">
          <div class="input-group mb-3">
            <button class="btn btn-primary mt-3" type="button">Select</button>
            <select id="inputState" name="select" class="form-select mt-3">
              <option selected>Class</option>
              <?php
              // fetching all the classes 
              $result = sql_select_all("all_classes");
              while ($row = mysqli_fetch_assoc($result)) {

              ?>
                <optgroup label="Class: <?php echo $row['class_name']; ?>">
                  <?php
                  // fetching the related sections
                  $result1 = sql_where("class_sections", "fk_class_id", $row['class_id']);
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
      <div class="col-md-4">
        <button class="btn btn-md btn-primary mt-3 ml-3" name="view" type="submit">View Timetable</button>
      </div>
      </form>
    </div>
  </div>
  <!-- end view timetable -->

  <!-- update timetable -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <form method="post" action="">
          <div class="input-group mb-3">
            <button class="btn btn-primary mt-3" type="button">Select</button>
            <select id="inputState" name="select" class="form-select mt-3">
              <option selected>Class</option>
              <?php
              // fetching all the classes 
              $result = sql_select_all("all_classes");
              while ($row = mysqli_fetch_assoc($result)) {

              ?>
                <optgroup label="Class: <?php echo $row['class_name']; ?>">
                  <?php
                  // fetching the related sections
                  $result1 = sql_where("class_sections", "fk_class_id", $row['class_id']);
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
      <div class="col-md-4">
        <button class="btn btn-md btn-primary mt-3 ml-3" name="update" type="submit">Update Timetable</button>
      </div>
      </form>
    </div>
  </div>
  <!-- end update timetable -->


  <!-- to add the timetable -->
  <section class="section profile">
    <div class="row">
      <div class="col-md-12">
        <?php
        // if add timetable request is submitted
        if (isset($_POST['add'])) {
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

          $result = sql_where('all_classes', 'class_id', $class);
          $row = mysqli_fetch_assoc($result);
          $result1 = sql_where_and('class_sections', 'section_id', $section, 'fk_class_id', $class);
          $row1 = mysqli_fetch_assoc($result1);

        ?>
          <!-- start of card -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Class: <?php echo $row['class_name'] . " " . $row1['section_name']; ?></h5>
              <p><code><u>Instructions:</u></code>
                <br><code>1. Don't leave time empty or the relevand records will not be added</code>
                <br><code>2. If you want to add break, tick the break box</code>
                <br><code>3. If Saturday is a holiday, don't add periods on Saturday</code>
              </p>

              <!-- Primary Color Bordered Table -->
              <form action="./backend/back-add-timetable.php" method="post">
                <table class="table table-bordered border-primary">
                  <thead>
                    <tr>
                      <th scope="col"><input type="hidden" name="section_id" value="<?php echo $row1['section_id']; ?>">#</th>
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
                            $result2 = sql_select_all('teacher_profile');
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
                            $result2 = sql_select_all('teacher_profile');
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
                            $result2 = sql_select_all('teacher_profile');
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
                            $result2 = sql_select_all('teacher_profile');
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
                            $result2 = sql_select_all('teacher_profile');
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
                            $result2 = sql_select_all('teacher_profile');
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
                <div class="d-flex justify-content-end">
                  <button type="submit" name="submit" class="btn btn-primary button">Submit timetable</button>
                </div>
              </form>
            <?php
            // end of if statement
          }
            ?>
            <!-- End Primary Color Bordered Table -->

            </div>
          </div>
          <!-- end of card -->

      </div>
    </div>
  </section>
  <!-- end add timetable -->

  <!-- to view the timetable -->
  <section class="section profile">
    <div class="row">
      <div class="col-md-12">
        <?php
        // if add timetable request is submitted
        if (isset($_POST['view'])) {
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

          $result = sql_where('all_classes', 'class_id', $class);
          $row = mysqli_fetch_assoc($result);
          $result1 = sql_where_and('class_sections', 'section_id', $section, 'fk_class_id', $class);
          $row1 = mysqli_fetch_assoc($result1);
          $sid = $row1['section_id'];

        ?>
          <!-- start of card -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Class: <?php echo $row['class_name'] . " " . $row1['section_name']; ?></h5>
              <p><code><u>Timetable:</u></code></p>

              <!-- Primary Color Bordered Table -->
              <table class="table table-bordered border-primary">
                <thead>
                  <tr>
                    <th scope="col"><input type="hidden" name="section_id" value="<?php echo $row1['section_id']; ?>">#</th>
                    <?php
                    // Select day names from the database
                    $query = "SELECT * FROM timetable WHERE fk_section_id='$sid'";
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
                      $query = "SELECT * FROM periods WHERE fk_section_id='$sid'";
                      // $query = "ON periods.fk_section_id=timetable.fk_section_id";
                      $ge = query($query);
                      $arr = array(0, 6, 12, 18, 24, 30, 36, 42, 48, 54, 60);
                      $arr1 = array(5, 11, 17, 23, 29, 35, 41, 47, 53, 59, 65);
                      $va = 0;
                      while($ro = mysqli_fetch_assoc($ge)){
                        if(in_array($va, $arr)){

                          ?>
                          <tr>
                          <td><?php echo $ro['time']; ?></td>
                          <td><?php echo $ro['period_name']; ?></td>
                          <?php
                        }else{
                          ?>
                          <td><?php echo $ro['period_name']; ?></td>

                          <?php
                          if(in_array($va, $arr1)){
                            echo "</tr>";
                          }
                        }
                        $va++;
                      }
                    ?>
                    <!-- start tr -->
                    
                      
                 

                </tbody>
              </table>
              <div class="d-flex justify-content-end">
                <button type="submit" name="submit" class="btn btn-primary button">Submit timetable</button>
              </div>
            <?php
            // end of if statement
          }
            ?>
            <!-- End Primary Color Bordered Table -->

            </div>
          </div>
          <!-- end of card -->

      </div>
    </div>
  </section>
  <!-- end view timetable -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>