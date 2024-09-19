<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = $_SESSION['client_id'];
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Students</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>

    </div><!-- End Page Title -->

    <!-- class and sections -->
    <div class="pagetitle">
        <div class="row">
            <form action="" method="post">
                <div class="col-md-4">
                    <select id="inputState" name="select" class="form-select">
                        <option selected>Choose Class</option>
                        <?php
                        // fetching all the classes
                        $query = "SELECT * FROM all_classes WHERE fk_client_id='$client'";
                        $result = query($query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $clas_id = $row['class_id'];
                        ?>
                            <optgroup label="Class: <?php echo $row['class_name']; ?>">
                                <?php
                                // fetching the related sections
                                $query = "SELECT * FROM class_sections WHERE fk_class_id='$clas_id' AND fk_client_id='$client'";
                                $result1 = query($query);
                                while ($row1 = mysqli_fetch_assoc($result1)) {
                                ?>
                                    <option value="<?php echo $row['class_id'] . " " . $row1['section_id']; ?>"><?php echo $row['class_name'] . " " . $row1['section_name']; ?></option>
                                <?php
                                }
                                ?>
                            </optgroup>
                        <?php } ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <input type="submit" name="submit" class="btn btn-success mx-auto" value="See Class Data">
                    </div>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-success" href="./student-profile.php">Add Student</a>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- End Select Student and add Student -->

    <section class="section profile">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Student Details</h5>
                        <p>Student Details of All the registered students of <code><?php echo $_SESSION['school_name']; ?></code>.</p>

                        <!-- Primary Color Bordered Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered border-primary table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Reg no#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Section</th>
                                        <th scope="col">Monthly Fee</th>
                                        <th scope="col">Dues</th>
                                        <th scope="col">Profile</th>
                                        <th scope="col">Profile</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if (isset($_POST['submit'])) {
                                        // Selecting students from the specified class
                                        $fetch = $_POST['select'];
                                        $length = strlen($fetch);
                                        $find = strpos($fetch, ' ');
                                        $number = $find + 1;
                                        $useable = $length - $number;
                                        $useable1 = $find;

                                        $section = substr($fetch, -$useable);
                                        $class = substr($fetch, 0, $find);
                                        $section = (int) $section;
                                        $class = (int) $class;
                                        $section = escape($section);
                                        $class = escape($class);

                                        $que = "SELECT * FROM all_classes ";
                                        $que .= "INNER JOIN class_sections ON all_classes.class_id = class_sections.fk_class_id ";
                                        $que .= "INNER JOIN student_class ON class_sections.section_id = student_class.fk_section_id ";
                                        $que .= "INNER JOIN student_profile ON student_class.fk_student_id = student_profile.student_id ";
                                        $que .= "WHERE class_id = '$class' AND section_id = '$section' AND status='1' AND student_status='1' ";
                                        $que .= "AND student_profile.fk_client_id='$client'";
                                        $result = mysqli_query($conn, $que);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row['roll_no']; ?></td><!--scope="row" -->
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['class_name']; ?></td>
                                                <td><?php echo $row['section_name']; ?></td>
                                                <td>Rs. <?php echo $row['fee_amount']; ?></td>
                                                <td>null</td>
                                                <td><a href="view-student.php?id=<?php echo $row['student_id']; ?>"><u>View</u></a></td>
                                                <td><a href="edit-student.php?id=<?php echo $row['student_id']; ?>"><u>Edit</u></a></td>
                                            </tr>

                                        <?php
                                        }
                                    } else {
                                        // Selecting all student records from database
                                        $queri = "SELECT * FROM student_profile INNER JOIN student_class ";
                                        $queri .= "ON student_profile.student_id = student_class.fk_student_id INNER JOIN ";
                                        $queri .= "class_sections ON student_class.fk_section_id = class_sections.section_id INNER JOIN ";
                                        $queri .= "all_classes ON class_sections.fk_class_id = all_classes.class_id WHERE student_status='1' AND status='1' ";
                                        $queri .= "AND student_profile.fk_client_id='$client'";

                                        $result = mysqli_query($conn, $queri);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $std_id = $row['student_id'];
                                        ?>
                                            <tr>
                                                <td><?php echo $row['roll_no']; ?></td><!--scope="row" -->
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['class_name']; ?></td>
                                                <td><?php echo $row['section_name']; ?></td>
                                                <td>Rs.<?php echo $row['fee_amount']; ?></td>
                                                <?php
                                                // fetching all the dues amount
                                                $query = "SELECT * FROM student_fee WHERE fk_student_id='$std_id' AND fee_status LIKE '%due%' AND fk_client_id='$client'";
                                                $get_record = query($query);
                                                $dues = 0;
                                                while ($get_dues = mysqli_fetch_assoc($get_record)) {
                                                    $dues += (int) $get_dues['pending_dues'];
                                                }
                                                ?>
                                                <td>Rs.<?php echo $dues; ?></td>
                                                <td><a href="view-student.php?id=<?php echo $row['student_id']; ?>">View profile</a></td>
                                                <td><a href="edit-student.php?id=<?php echo $row['student_id']; ?>">Edit profile</a></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Primary Color Bordered Table -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>