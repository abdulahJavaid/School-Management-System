<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Announcements</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <?php
    if (isset($_POST['submit'])) {
        $notice_description = escape($_POST['notice_description']);
        $t_date = date('Y-m-d', time());
        $t_date = escape($t_date);
        $query = "INSERT INTO notices(notice_description, notice_date) VALUES('$notice_description', '$t_date')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "data has been successfully inserted";
            // redirect('../');
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }


    ?>

    <section class="section profile">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Announcements</h5>

                        <!-- Multi Columns Form -->
                        <form method="post" action="">


                            <div class="row mb-3">
                                <label for="about" class="col-md-4 col-lg-3 col-form-label">Description</label>
                                <div class="col-md-8 col-lg-9">
                                    <textarea name="notice_description" class="form-control" id="about" style="height: 30vh" required></textarea>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-sm btn-success">Add</button>
                                <button type="reset" class="btn btn-sm btn-secondary">Reset</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>