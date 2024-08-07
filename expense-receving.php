<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">

  <div class="pagetitle"><h1>View Profile</h1>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">School name here</li>
  </ol>
</nav>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
    
    <!-- First Card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Expense</h5>

          <?php  
            $query = "SELECT * FROM add_exp";
            $result = mysqli_query($conn, $query);

            // Check if there are any rows returned
            if (mysqli_num_rows($result) > 0) {
              echo "<table border='1' class='table table-bordered border-primary'>
                      <thead>
                        <tr>
                          <th scope='col'>Date</th>
                          <th scope='col'>Image</th>
                          <th scope='col'>Comment</th>
                          <th scope='col'>Cost</th>
                        </tr>
                      </thead>
                      <tbody>";

              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . $row['date'] . "</td>
                        <td><img src='uploads/expense-uploads/" . $row['image'] . "' width='100px' height='100px'></td>
                        <td>" . $row['comment'] . "</td>
                        <td>" . $row['cost'] . "</td>
                      </tr>";
              }

              echo "</tbody>
                    </table>";
            } else {
              echo "0 results";
            }

            mysqli_close($conn);
          ?>

        </div>
      </div>
    </div><!-- End First Card Column -->


      <!-- Second Card -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Receving</h5>
            <!-- <p>Student Details of All the registered students of <code>School Name</code>.</p> -->

            <table class="table table-bordered border-primary">
              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Image</th>
                  <th scope="col">Comment</th>
                  <th scope="col">Cost</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div><!-- End Second Card Column -->

    </div><!-- End Row -->
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>
