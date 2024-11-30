<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>


<?php
// $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=10';
// if(isset($_GET['message']) && $pageWasRefreshed ) {
//     // unset($_GET['message']);
//     redirect("./add-expense.php");
// }
?>

<?php
// checking session for appropriate access
if ($level == 'accountant' || $level == 'super') {
} else {
    redirect("./");
}
?>




<main id="main" class="main">
    <div class="pagetitle">
        <h1>Daily Expense</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header card-bg-header text-white mb-3">
                        <h5 class="mb-0 text-dark"><i class="fas fa-dollar-sign pro-header-icon"></i><strong>Add Expense</strong></h5>
                    </div>
                    <div class="card-body">
                        <!-- <h3 class="card-title text-center">Add Expense</h3> -->
                        <?php
                        if (isset($_GET['m'])) {
                            $message = $_GET['m'];
                        ?>
                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    <div class="col-xl-8">
                                        <div class="alert alert-success text-center">
                                            <?php echo $message; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <!-- Multi Columns Form -->
                        <form method="post" action="./backend/back-add-expencess.php" enctype="multipart/form-data" class="row g-3">
                            <div class="col-md-12">
                                <label for="cost" class="form-label text-secondary"><strong>Expense <code>*</code></strong></label>
                                <input name="expense" type="text" class="form-control" id="cost" placeholder="Rs." required>
                            </div>
                            <div class="col-md-12">
                                <label for="comment" class="form-label text-secondary"><strong>Remarks <code>*</code></strong></label>
                                <input name="comment" type="text" class="form-control" id="comment" placeholder="comments" required>
                            </div>
                            <div class="col-md-12">
                                <label for="image" class="form-label text-secondary"><strong>Upload image</strong></label>
                                <input name="image" type="file" class="form-control" id="image">
                            </div>

                            <?php

                            $date = date('Y-m-d', time());
                            ?>
                            <div class="col-md-12">
                                <label for="date" class="form-label text-secondary"><strong>Date <code>*</code></strong></label>
                                <input type="date" class="form-control" id="date" name="date" value="<?php echo $date; ?>" readonly required>
                            </div>
                            <!-- <div class="col-md-12">
                                <label for="inputCity" class="form-label">Other Expencess</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            -->

                            <div class="text-end mt-4">
                                <button type="reset" class="btn btn-sm btn-outline-danger">Reset</button>
                                <button type="submit" name="submit" class="btn btn-sm btn-success">Add Expense</button>
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