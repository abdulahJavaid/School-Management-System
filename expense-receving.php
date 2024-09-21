<?php require_once("includes/header.php"); ?>

<style>
  /* css to show the enlarged image */
  .fullscreen-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    z-index: 1000;
    text-align: center;
    justify-content: center;
    align-items: center;
  }

  .fullscreen-overlay img {
    max-width: 90%;
    max-height: 90%;
    margin-top: 2%;
  }

  .img {
    cursor: pointer;
  }
</style>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>


<?php
// checking session for appropriate access
if ($level == 'accountant' || $level == 'super') {}
else {
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
          <div class="table-responsive">
            <table class="table table-bordered border-primary table-hover">
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
                $query = "SELECT * FROM expense_receiving WHERE date='$date' AND fk_client_id='$client'";
                $result = query($query);
                $exp = 0;
                $rec = 0;
                $index = 1;
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
                    <td>
                      <?php
                      // if the image is empty
                      if (empty($image)) {
                        echo "---";
                      } else {
                      ?>
                        <img class="img" onclick="showImage('<?php echo $index; ?>')" id="thumbnail<?php echo $index; ?>" src="uploads/expense-receiving/<?php echo $row['image']; ?>" width="35px" height="35px" alt="img">
                      <?php
                      }
                      ?>
                    </td>
                  </tr>
                <?php
                  $index++;
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
      </div>
    <?php
    } elseif (isset($_POST['view']) && empty($_POST['two']) || $_POST['one'] == $_POST['two']) {
    ?>
      <div class="card">
        <div class="card-body">

          <h5 class="card-title">Expense and Receiving</h5>
          <p>Total expense and receiving records for <code><?php echo $_POST['one']; ?></code>.</p>
          <div class="table-responsive">
            <table class="table table-bordered border-primary table-hover">
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
                $query = "SELECT * FROM expense_receiving WHERE date='$date' AND fk_client_id='$client'";
                $result = query($query);
                $exp = 0;
                $rec = 0;
                $index = 1;
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
                    <td>
                      <?php
                      // if the image is empty
                      if (empty($image)) {
                        echo "---";
                      } else {
                      ?>
                        <img class="img" onclick="showImage('<?php echo $index; ?>')" id="thumbnail<?php echo $index; ?>" src="uploads/expense-receiving/<?php echo $row['image']; ?>" width="35px" height="35px" alt="img">
                      <?php
                      }
                      ?>
                    </td>
                  </tr>
                <?php
                  $index++;
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
      </div>

    <?php
    } else {
    ?>

      <div class="card">
        <div class="card-body">

          <h5 class="card-title">Expense and Receiving</h5>
          <p>Total expense and receiving records for <code><?php echo $_POST['one'] . '</code> to <code>' . $_POST['two']; ?></code>.</p>
          <div class="table-responsive">
            <table class="table table-bordered border-primary table-hover">
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
                $query = "SELECT * FROM expense_receiving WHERE date BETWEEN '$date' AND '$date1' AND fk_client_id='$client'";
                $result = query($query);
                $exp = 0;
                $rec = 0;
                $index = 1;
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
                    <td>
                      <?php
                      // if the image is empty
                      if (empty($image)) {
                        echo "---";
                      } else {
                      ?>
                        <img class="img" onclick="showImage('<?php echo $index; ?>')" id="thumbnail<?php echo $index; ?>" src="uploads/expense-receiving/<?php echo htmlspecialchars($row['image']); ?>" width="35px" height="35px" alt="img">
                      <?php
                      }
                      ?>
                    </td>
                  </tr>
                <?php
                  $index++;
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
                  <td colspan="2"><strong>In Hand Balance: </strong>Rs. <?php echo $rec - $exp; ?></td>
                  <!-- <td><strong>Total: </strong></td> -->
                  <td>---</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    <?php
    }
    ?>

    </div><!-- End Row -->
  </section>
  <!-- Fullscreen Image Container -->
  <div id="fullscreenOverlay" class="fullscreen-overlay">
    <img id="fullscreenImage" src="" alt="Full Image">
    <button id="closeButton" class="btn btn-outline-danger m-2" onclick="closeImage()"><i class="fa fa-times" aria-hidden="true"></i></button>
  </div>

  <script>
    // code to see the image in full screen
    function showImage(name) {
      var gets = "thumbnail" + String(name);
      var imageSrc = document.getElementById(gets).src;
      document.getElementById("fullscreenImage").src = imageSrc;
      document.getElementById("fullscreenOverlay").style.display = "block";
    }

    function closeImage() {
      document.getElementById("fullscreenOverlay").style.display = "none";
    }

    function showImage1() {
      var imageSrc = document.getElementById("thumbnail1").src;
      document.getElementById("fullscreenImage").src = imageSrc;
      document.getElementById("fullscreenOverlay").style.display = "block";
    }
  </script>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>