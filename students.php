<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Students</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active">My School System</li>
                <!-- <li class="breadcrumb-item d-flex justify-content-end"></li> -->
            </ol>
        </nav>

    </div><!-- End Page Title -->

    <!-- class and sections -->
    <div class="pagetitle">
        <div class="row">
            <?php
            // $color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);

            ?>
            <form action="" method="post">
                <div class="col-md-4">
                    <select id="inputState" name="class" class="form-select">
                        <option selected>Choose Class</option>
                        <?php
                        // getting classes
                        for ($i = $first_class; $i <= $last_class; $i++) {
                        ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select id="inputState" name="section" class="form-select">
                        <option selected>Choose Section</option>
                        <option value="<?php echo "A"; ?>">A</option>
                        <option value="<?php echo "B"; ?>">B</option>
                        <option value="<?php echo "C"; ?>">C</option>
                        <option value="<?php echo "D"; ?>">D</option>
                        <option value="<?php echo "E"; ?>">E</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <input type="submit" name="submit" class="btn btn-md btn-primary button mx-auto" value="Check">
                    </div>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary button" href="./student-profile.php">Add Student</a>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Student Details</h5>
                        <p>Student Details of All the registered students of <code>School Name</code>.</p>

                        <!-- Primary Color Bordered Table -->
                        <table class="table table-bordered border-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Issued Code</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">CNIC</th>
                                    <th scope="col">Father Name</th>
                                    <th scope="col">Phone#</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Section</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if (isset($_POST['submit'])) {
                                    // Selecting students from the specified class
                                    $table = 'student_profile';
                                    $val1 = $_POST['class'];
                                    $val2 = (string) $_POST['section'];
                                    $op1 = 'class';
                                    $op2 = 'section';
                                    $result = sql_where_and($table, $op1, $val1, $op2, $val2);
                                    // if(!$result){
                                    //     break 2;
                                    // }
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['issue_code']; ?></td><!--scope="row" -->
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['cnic']; ?></td>
                                            <td><?php echo $row['f_name']; ?></td>
                                            <td><?php echo $row['phone_no']; ?></td>
                                            <td><?php echo $row['class']; ?></td>
                                            <td><?php echo $row['section']; ?></td>
                                            <!-- <td></td> -->
                                            <!-- <td></td> -->
                                        </tr>

                                    <?php }
                                } else {
                                    // Selecting all student records from database
                                    $result = sql_select_all('student_profile');
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['issue_code']; ?></td><!--scope="row" -->
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['cnic']; ?></td>
                                            <td><?php echo $row['f_name']; ?></td>
                                            <td><?php echo $row['phone_no']; ?></td>
                                            <td><?php echo $row['class']; ?></td>
                                            <td><?php echo $row['section']; ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Primary Color Bordered Table -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>