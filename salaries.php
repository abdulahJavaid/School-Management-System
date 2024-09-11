<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>


<?php
// checking session for appropriate access
if ($_SESSION['login_access'] == 'developer' || $_SESSION['login_access'] == 'accountant' || $_SESSION['login_access'] == 'super') {
} else {
  redirect("./");
}
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Expense/Receiving</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <form method="post" action="generate-pdf.php">
          <div class="input-group mb-3">
            <button class="btn btn-sm btn-success mt-3" type="button">From</button>
            <input type="date" name="one" class="form-control mt-3" required>
          </div>
      </div>
      <div class="col-md-3">
        <div class="input-group mb-3">
          <button class="btn btn-sm btn-success mt-3" type="button">To</button>
          <input type="date" name="two" class="form-control mt-3">
        </div>
      </div>
      <div class="col-md-4">
        <button class="btn btn-sm btn-success mt-3 ml-3" name="generate" type="submit">Generate PDF</button>
      </div>
      </form>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <form method="post" action="">
          <div class="input-group mb-3">
            <button class="btn btn-sm btn-success mt-3" type="button">From</button>
            <input type="date" name="one" class="form-control mt-3" required>
          </div>
      </div>
      <div class="col-md-3">
        <div class="input-group mb-3">
          <button class="btn btn-sm btn-success mt-3" type="button">To</button>
          <input type="date" name="two" class="form-control mt-3">
        </div>
      </div>
      <div class="col-md-4">
        <button class="btn btn-sm btn-success mt-3 ml-3" name="view" type="submit">View Data</button>
      </div>
      </form>
    </div>
  </div>



  <section class="section profile">
    <!-- First Card -->
    <!-- <div class="col-md-6"> -->

    <div class="card">
      <div class="card-body">

        <h5 class="card-title">Staff Salaries</h5>
        <p>Pending salary payments.</p>

        <table class="table table-bordered border-primary tbl">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Designation</th>
              <th scope="col">Salary</th>
              <th scope="col">Month</th>
              <th scope="col">Payment</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // the current date
            $date = date('Y-m-d', time());
            $date = escape($date);

            // select the records from database of today
            $query = "SELECT * FROM teacher_profile INNER JOIN employee_salary ON ";
            $query .= "teacher_profile.teacher_id=employee_salary.fk_teacher_id WHERE ";
            $query .= "salary_status='unpaid'";
            $result = query($query);
            while ($row = mysqli_fetch_assoc($result)) {
              $sal_id = $row['salary_id'];
            ?>
              <tr>
                <td><?php echo $row['name']; ?></td>
                <td>Teacher</td>
                <td>Rs.<?php echo $row['salary_amount']; ?></td>
                <td><?php echo $row['month'] . ', ' . $row['year']; ?></td>
                <td><a href="./process-salaries.php?id=<?php echo $sal_id; ?>" class="btn btn-sm btn-success">Process</a></td>
                <!-- <td><a href="./image.php?image=<?php //echo $image; ?>"><img src="uploads/expense-receiving/<?php //echo $row['image']; ?>" width="30px" height="30px" alt="img"></a></td> -->
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>

      </div>
    </div>



    </div><!-- End Row -->
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>