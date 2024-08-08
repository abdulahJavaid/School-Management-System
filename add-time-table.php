<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Add Timetable</h1>
    <nav>
      <ol class="breadcrumb">
        <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
        <li class="breadcrumb-item active">School name here</li>
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
        <button class="btn btn-md btn-primary mt-3 ml-3" name="class" type="submit">Add Timetable</button>
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
            <p>Add the timetable for the <code>week</code></p>

            <!-- Primary Color Bordered Table -->
            <table class="table table-bordered border-primary">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Position</th>
                  <th scope="col">Age</th>
                  <th scope="col">Start Date</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td><input type="text" placeholder="subject name"><br>
                    <input type="text" placeholder="teacher name">
                  </td>
                  <td>Designer</td>
                  <td>28</td>
                  <td>2016-05-25</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Bridie Kessler</td>
                  <td>Developer</td>
                  <td>35</td>
                  <td>2014-12-05</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>Ashleigh Langosh</td>
                  <td>Finance</td>
                  <td>45</td>
                  <td>2011-08-12</td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td>Angus Grady</td>
                  <td>HR</td>
                  <td>34</td>
                  <td>2012-06-11</td>
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td>Raheem Lehner</td>
                  <td>Dynamic Division Officer</td>
                  <td>47</td>
                  <td>2011-04-19</td>
                </tr>
              </tbody>
            </table>
            <!-- End Primary Color Bordered Table -->

          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>