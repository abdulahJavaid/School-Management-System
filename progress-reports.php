<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Progress Reports</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">School name here</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="container">
            <!-- Row for Name and Reg# Inputs -->
            <div class="row align-items-center">
                <!-- Name Input and View Button -->
                <div class="col-auto">
                    <form action="" method="post">
                        <div class="input-group mb-2">
                            <input
                                name="name"
                                type="text"
                                size="20"
                                class="form-control"
                                value="<?php echo isset($_POST['view_name']) ? $_POST['name'] : ''; ?>"
                                placeholder="By name"
                                aria-label="By name"
                                aria-describedby="button-addon2"
                                required />
                            <button name="view_name" class="btn btn-sm btn-primary button" type="submit" id="button-addon2">
                                View
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Reg# Input and View Button -->
                <div class="col-auto">
                    <form action="" method="post">
                        <div class="input-group mb-2">
                            <input
                                name="reg"
                                type="text"
                                size="20"
                                class="form-control"
                                value="<?php echo isset($_POST['view_reg']) ? $_POST['reg'] : ''; ?>"
                                placeholder="By reg#"
                                aria-label="By reg#"
                                aria-describedby="button-addon3"
                                required />
                            <button name="view_reg" class="btn btn-sm btn-primary button" type="submit" id="button-addon3">
                                View
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Row for Date Input -->
             <br>
            <div class="row align-items-center">
                <div class="col-auto">
                    <form action="" method="post">
                        <div class="input-group mb-2">
                            <input
                                name="date"
                                type="text"
                                size="20"
                                class="form-control"
                                value="<?php echo isset($_POST['view_date']) ? $_POST['date'] : ''; ?>"
                                placeholder="By date"
                                aria-label="By date"
                                aria-describedby="button-addon4"
                                required />
                            <!-- <button name="view_date" class="btn btn-sm btn-primary button" type="submit" id="button-addon4">
                                View
                            </button> -->
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>
