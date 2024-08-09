<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Exam Schedule</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Savvy School</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <form method="post" action="">
          <div class="input-group mb-3">
            <button class="btn btn-primary mt-3" type="button">Select Class</button>
            <select id="inputState" name="select" class="form-select mt-3">
              <option selected>Choose Class</option>
              <?php
              // Fetching all the classes 
              $result = sql_select_all("all_classes");
              while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <optgroup label="Class: <?php echo $row['class_name']; ?>">
                  <?php
                  // Fetching the related sections
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
        <button class="btn btn-md btn-primary mt-3 ml-3" name="class" type="submit">Add Exam Schedule</button>
      </div>
      </form>
    </div>
  </div>

  <section class="section profile">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Class: </h5>
            <p>Add the exam schedule</p>

            <!-- Form for adding exam schedule -->
            <form action="./backend/back-exam.php" method="post" enctype="multipart/form-data">
            
            <?php 
              for($i = 1; $i <= 9; $i++){
            ?>        
                 
            <div class="row mb-3">
              <label class="col-md-3 col-lg-3 col-form-label">Paper <?php echo $i; ?>:</label>
              <div class="col-md-9 col-lg-9">
                <input name="date<?php echo $i; ?>" type="date" class="form-control d-inline-block w-auto mb-2 mr-sm-2" placeholder="Enter Date">
                &nbsp;&nbsp;&nbsp;&nbsp;<input name="subject<?php echo $i; ?>" type="text" class="form-control d-inline-block w-auto mb-2 mr-sm-2" placeholder="Enter Subject">
                &nbsp;&nbsp;&nbsp;&nbsp;<input name="time<?php echo $i; ?>" type="text" class="form-control d-inline-block w-auto mb-2" placeholder="Enter Time">
              </div>
            </div>
            <?php
              }
            ?>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>

            </form><!-- End Exam Schedule Form -->
            
          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>
