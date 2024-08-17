<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Notices</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active">My School system</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
<?php
if(isset($_POST['submit'])){
    $notice_description= $_POST['notice_description'];
    $t_date = date('Y-m-d', time());
    $query="INSERT INTO notices(notice_description, notice_date) VALUES('$notice_description', '$t_date')";
    $result = mysqli_query($conn,$query);
    if ($result){
        echo "data has been successfully inserted";
        // redirect('../');
    }
    else{
        echo"Error: " . mysqli_error($conn);
    }
    }
    

?>


    <section class="section profile">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Notice</h5>

                        <!-- Multi Columns Form -->
                        <form method="post" action="">


                        <div class="row mb-3">
                  <label for="about" class="col-md-4 col-lg-3 col-form-label">Notice Description</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="notice_description" class="form-control" id="about" style="height: 100px"></textarea>
                  </div>
                </div>

<!-- <input type="text" name="notice_description"> -->
                            <!--  <div class="col-md-6">
                                <label for="inputEmail5" class="form-label">Electricity</label>
                                <input type="email" class="form-control" id="inputEmail5">
                            </div> -->



                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary button">Add Notice</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>End #main

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>