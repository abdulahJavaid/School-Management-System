<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// checking session for appropriate access
if ($_SESSION['login_access'] == 'developer' || $_SESSION['login_access'] == 'accountant' || $_SESSION['login_access'] == 'super') {
  
}else{
  redirect("./");
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Daily Receving</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active">My school system</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Payment Receving Form</h5>
                        <?php
                        if (isset($_GET['m'])) {
                            $message = $_GET['m'];
                        ?>
                            <center><span class="bg-secondary msg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $message; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></center>
                        <?php
                        }
                        ?>

                        <!-- Multi Columns Form -->
                        <form method="post" action="./backend/back-add-receving.php" enctype="multipart/form-data" class="row g-3">
                            <div class="col-md-12">
                                <label for="image" class="form-label">Upload image</label>
                                <input name="image" type="file" class="form-control" id="image">
                            </div>

                            <div class="col-md-12">
                                <label for="comment" class="form-label">Comment</label>
                                <input name="comment" type="text" class="form-control" id="comment">
                            </div>

                            <div class="col-md-12">
                                <label for="receiving" class="form-label">Receving</label>
                                <input name="receiving" type="text" class="form-control" id="receving">
                            </div>
                            <?php

                            $date = date('Y-m-d', time());
                            ?>
                            <div class="col-md-12">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date" value="<?php echo $date; ?>" readonly>
                            </div>

                            <!-- <div class="col-md-4">
                                <label for="inputState" class="form-label">State</label>
                                <select id="inputState" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div> -->


                            <div class="text-center">
                                <button type="submit" class="btn btn-primary button">Submit</button>
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