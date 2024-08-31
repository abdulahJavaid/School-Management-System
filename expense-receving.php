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


    <?php
    // if no request is set
    if (!isset($_POST['view'])) {
    ?>

      <div class="card">
        <div class="card-body">

          <h5 class="card-title">Expense and Receiving</h5>
          <p>Total expense and receiving records for <code>today</code>.</p>

          <table class="table table-bordered border-primary tbl">
            <thead>
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Comment</th>
                <th scope="col">Expense</th>
                <th scope="col">Receiving</th>
                <th scope="col">Image</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // the current date
              $date = date('Y-m-d', time());
              $date = escape($date);

              // select the records from database of today
              $query = "SELECT * FROM expense_receiving WHERE date='$date'";
              $result = query($query);
              $exp = 0;
              $rec = 0;
              while ($row = mysqli_fetch_assoc($result)) {
                $exp += (int) $row['expense'];
                $rec += (int) $row['receiving'];
                $image = $row['image'];
              ?>
                <tr>
                  <td><?php echo $row['date']; ?></td>
                  <td><?php echo $row['comment']; ?></td>
                  <td><?php
                      if ($row['expense'] == 0)
                        echo '---';
                      else
                        echo 'Rs. ' . $row['expense'];
                      ?></td>
                  <td><?php
                      if ($row['receiving'] == 0)
                        echo '---';
                      else
                        echo 'Rs. ' . $row['receiving'];
                      ?></td>
                  <td><a href="./image.php?image=<?php echo $image; ?>"><img src="uploads/expense-receiving/<?php echo $row['image']; ?>" width="30px" height="30px" alt="img"></a></td>
                </tr>
              <?php
              }
              ?>
              <tr>
                <td>---</td>
                <td>---</td>
                <td><strong></strong>Rs. <?php echo $exp; ?></td>
                <td><strong></strong>Rs. <?php echo $rec; ?></td>
                <td>---</td>
              </tr>
              <tr>
                <td>---</td>
                <td>---</td>
                <td colspan="2"><strong>Total: </strong>Rs. <?php echo $rec - $exp; ?></td>
                <!-- <td><strong>Total: </strong></td> -->
                <td>---</td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
    <?php
    } elseif (isset($_POST['view']) && empty($_POST['two']) || $_POST['one'] == $_POST['two']) {
    ?>
      <div class="card">
        <div class="card-body">

          <h5 class="card-title">Expense and Receiving</h5>
          <p>Total expense and receiving records for <code><?php echo $_POST['one']; ?></code>.</p>

          <table class="table table-bordered border-primary tbl">
            <thead>
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Comment</th>
                <th scope="col">Expense</th>
                <th scope="col">Receiving</th>
                <th scope="col">Image</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // select the records from database of today
              $date = escape($_POST['one']);
              $date1 = escape($_POST['two']);
              $query = "SELECT * FROM expense_receiving WHERE date='$date'";
              $result = query($query);
              $exp = 0;
              $rec = 0;
              while ($row = mysqli_fetch_assoc($result)) {
                $exp += (int) $row['expense'];
                $rec += (int) $row['receiving'];
                $image = $row['image'];
              ?>
                <tr>
                  <td><?php echo $row['date']; ?></td>
                  <td><?php echo $row['comment']; ?></td>
                  <td><?php
                      if ($row['expense'] == 0)
                        echo '---';
                      else
                        echo 'Rs. ' . $row['expense'];
                      ?></td>
                  <td><?php
                      if ($row['receiving'] == 0)
                        echo '---';
                      else
                        echo 'Rs. ' . $row['receiving'];
                      ?></td>
                  <td><a href="./image.php?image=<?php echo $image; ?>"><img src="uploads/expense-receiving/<?php echo $row['image']; ?>" width="30px" height="30px" alt="img"></a></td>
                </tr>
              <?php
              }
              ?>
              <tr>
                <td>---</td>
                <td>---</td>
                <td><strong></strong>Rs. <?php echo $exp; ?></td>
                <td><strong></strong>Rs. <?php echo $rec; ?></td>
                <td>---</td>
              </tr>
              <tr>
                <td>---</td>
                <td>---</td>
                <td colspan="2"><strong>Total: </strong>Rs. <?php echo $rec - $exp; ?></td>
                <!-- <td><strong>Total: </strong></td> -->
                <td>---</td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>

    <?php
    } else {
    ?>

      <div class="card">
        <div class="card-body">

          <h5 class="card-title">Expense and Receiving</h5>
          <p>Total expense and receiving records for <code><?php echo $_POST['one'] . '</code> to <code>' . $_POST['two']; ?></code>.</p>

          <table class="table table-bordered border-primary tbl">
            <thead>
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Comment</th>
                <th scope="col">Expense</th>
                <th scope="col">Receiving</th>
                <th scope="col">Image</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // select the records from database of today
              $date = escape($_POST['one']);
              $date1 = escape($_POST['two']);
              $query = "SELECT * FROM expense_receiving WHERE date BETWEEN '$date' AND '$date1'";
              $result = query($query);
              $exp = 0;
              $rec = 0;
              while ($row = mysqli_fetch_assoc($result)) {
                $exp += (int) $row['expense'];
                $rec += (int) $row['receiving'];
                $image = $row['image'];
              ?>
                <tr>
                  <td><?php echo $row['date']; ?></td>
                  <td><?php echo $row['comment']; ?></td>
                  <td><?php
                      if ($row['expense'] == 0)
                        echo '---';
                      else
                        echo 'Rs. ' . $row['expense'];
                      ?></td>
                  <td><?php
                      if ($row['receiving'] == 0)
                        echo '---';
                      else
                        echo 'Rs. ' . $row['receiving'];
                      ?></td>
                  <td><a href="./image.php?image=<?php echo $image; ?>"><img src="uploads/expense-receiving/<?php echo $row['image']; ?>" width="30px" height="30px" alt="img"></a></td>
                </tr>
              <?php
              }
              ?>
              <tr>
                <td>---</td>
                <td>---</td>
                <td><strong></strong>Rs. <?php echo $exp; ?></td>
                <td><strong></strong>Rs. <?php echo $rec; ?></td>
                <td>---</td>
              </tr>
              <tr>
                <td>---</td>
                <td>---</td>
                <td colspan="2"><strong>Total: </strong>Rs. <?php echo $rec - $exp; ?></td>
                <!-- <td><strong>Total: </strong></td> -->
                <td>---</td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
    <?php
    }
    ?>


    </div><!-- End Row -->
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>