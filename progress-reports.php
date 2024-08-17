<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>School Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active">School name here</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
                            <div class="container">
                                <div class="row align-items-center">
                                    <!-- Name Button on the Left -->

                                    <div class="col-auto">
                                        <form action="" method="post">
                                            <div class="input-group">
                                                <input
                                                    name="name"
                                                    type="text"
                                                    size="6"
                                                    class="form-control"
                                                    value="<?php
                                                            if (isset($_POST['view_name'])) {
                                                                echo $_POST['name'];
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>"
                                                    placeholder="By name"
                                                    aria-label="Example input"
                                                    aria-describedby="button-addon2" required />
                                                <button name="view_name" class="btn btn-sm btn-primary button" type="submit" id="button-addon2">
                                                    View
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    


                                    <!-- button position second -->

                                    <div class="col-auto">
                                        <form action="" method="post">
                                            <div class="input-group">
                                                <input
                                                    name="reg"
                                                    type="text"
                                                    size="6"
                                                    class="form-control"
                                                    value="<?php
                                                            if (isset($_POST['view_reg'])) {
                                                                echo $_POST['reg'];
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>"
                                                    placeholder="By reg#"
                                                    aria-label="Example input"
                                                    aria-describedby="button-addon3" required />
                                                <button name="view_reg" class="btn btn-sm btn-primary button" type="submit" id="button-addon3">
                                                    View
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Month Input and View Button on the Right -->

  <div class="col-auto">
                                        <form action="" method="post">
                                            <div class="input-group">
                                                <input
                                                    name="name"
                                                    type="text"
                                                    size="6"
                                                    class="form-control"
                                                    value="<?php
                                                            if (isset($_POST['view_name'])) {
                                                                echo $_POST['name'];
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>"
                                                    placeholder="By name"
                                                    aria-label="Example input"
                                                    aria-describedby="button-addon2" required />
                                                <button name="view_name" class="btn btn-sm btn-primary button" type="submit" id="button-addon2">
                                                    View
                                                </button>
                                            </div>
                                        </form>
                                    </div>






                                </div>
                            </div>

                        </div>

   

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>