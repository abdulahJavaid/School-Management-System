<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>







<main id="main" class="main">
    <div class="pagetitle">
        <h1>Daily expences</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active">My School system</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center ">Add Expenscss</h3>
                        <?php
                            if(isset($_GET['m'])){
                                $message = $_GET['m'];
                          ?>
                        <center><span class="bg-secondary msg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $message; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></center>
                          <?php      
                            }
                        ?>

                        <!-- Multi Columns Form -->
                        <form method="post" action="./backend/back-add-expencess.php" enctype="multipart/form-data"  class="row g-3">
                       
                            <div class="col-md-12">
                                <label for="image" class="form-label">Upload image</label>
                                <input name="image" type="file" class="form-control" id="image">
                            </div>
                            <div class="col-md-12">
                                <label for="comment" class="form-label">Comment</label>
                                <input name="comment" type="text" class="form-control" id="comment">
                            </div>
                            <div class="col-md-12">
                                <label for="cost" class="form-label">Cost</label>
                                <input name="cost" type="text" class="form-control" id="cost">
                            </div>
                           
                            <!-- <div class="col-md-12">
                                <label for="inputCity" class="form-label">Other Expencess</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            -->
                          
                            <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>