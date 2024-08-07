<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>View Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">School name here</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <div class="container">
  <div class="row">
    <div class="col-md-3">
      <form method="post" action="">
        <div class="input-group mb-3">
          <button class="btn btn-primary mt-3" type="button">From</button>
          <input type="date" class="form-control mt-3">
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group mb-3">
          <button class="btn btn-primary mt-3" type="button">To</button>
          <input type="date" class="form-control mt-3">
        </div>
    </div>
    <div class="col-md-4">
        <button class="btn btn-md btn-primary mt-3 ml-3" type="button">Generate PDF</button>
    </div>
    </form>
  </div>
</div>


  <section class="section profile">
      <!-- First Card -->
      <!-- <div class="col-md-6"> -->
     
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

              // select the records from database of today
              $query = "SELECT * FROM expense_receiving WHERE date='$date' ORDER BY er_id DESC";
              $result = query($query);
              $exp = 0;
              $rec = 0;
              while ($row = mysqli_fetch_assoc($result)) {
                $exp += (int) $row['expense'];
                $rec += (int) $row['receiving'];
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
                  <td><img src="uploads/expense-receiving/<?php echo $row['image']; ?>" width="30px" height="30px" alt="img"></td>
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
                <td colspan="2"><strong>Total: </strong>Rs. <?php echo $rec-$exp; ?></td>
                <!-- <td><strong>Total: </strong></td> -->
                <td>---</td>
              </tr>
            </tbody>
          </table>
          

        </div>
      </div>


    </div><!-- End Row -->
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>