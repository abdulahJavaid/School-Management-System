<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">

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
              <button class="btn btn-sm btn-success mt-3 ml-3" name="add" type="submit" id="button-addon2">
                Add Exam Schedule
              </button>
            </div>
          </div>

          <!-- View timetable select option -->
          <div class="col-auto">
            <div class="input-group">
              <select id="inputState" name="select" class="form-select mt-3" aria-label="Example input" aria-describedby="button-addon3">
                <option selected value="empty">Class</option>
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
  <!-- end of the form -->

  <!-- Exam Schedule Form, hidden by default -->
  <section class="section profile" id="examScheduleForm">
    <div class="row">
      <div class="col-md-8">
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

          $result = sql_where('all_classes', 'class_id', $class);
          $row = mysqli_fetch_assoc($result);
          $result1 = sql_where_and('class_sections', 'section_id', $section, 'fk_class_id', $class);
          $row1 = mysqli_fetch_assoc($result1);
        ?>
        <div class="card">
          <div class="card-body pt-3">

            <h5 class="card-title">Class: <?php echo $row['class_name'] . ' ' . $row1['section_name']; ?></h5>
            <p><code><u>Instructions:</u></code>
              <br><code>1. Don't leave time/subject/date empty or the relevant record will not be added</code>
            </p>
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Add Exam Schedule</button>
              </li>
            </ul>
            <div class="tab-content pt-2">
              <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                <form method="post" action="backend/back-add-exam.php" enctype="multipart/form-data">
                  <?php
                  // looping to get 9 form fields
                  for ($i = 1; $i < 10; $i++) {
                  ?>
                    <div class="row mb-3">
                      <div class="row align-items-center">
                        <div class="col-auto">
                          <div class="input-group">
                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Paper <?php echo $i; ?></label>
                            <!-- <div class="col-md-6"> -->
                            <input name="time" type="text" class="form-control" value="" placeholder="time">
                            &nbsp;&nbsp;
                            <input name="subject" type="text" class="form-control" value="" placeholder="subject">
                            &nbsp;&nbsp;
                            <input name="date" type="date" class="form-control" value="" placeholder="date">
                            <!-- </div> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                  }
                  ?>
                  <input type="hidden" name="section_id" value="<?php echo $row1['section_id']; ?>">
                  <div class="d-flex justify-content-end">
                    <button type="submit" name="submit" class="btn btn-md btn-success">Submit schedule</button>
                  </div>
                </form><!-- End Add timetable Form -->

              </div>

            </div>

          </div>
        </div>
        <?php
          } // end of if to add exam schedule
        ?>
      </div>
    </div>
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>