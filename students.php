<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Students</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">My School System</li>
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
                    <select id="inputState" name="select" class="form-select">
                        <option selected>Choose Class</option>
                        <?php
                        // fetching all the classes 
                        $result = sql_select_all("all_classes");
                        while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                            <optgroup label="Class: <?php echo $row['class_name']; ?>">
                                <?php
                                // fetching the related sections
                                $result1 = sql_where("class_sections", "fk_class_id", $row['class_id']);
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
                        <input type="submit" name="submit" class="btn btn-md btn-primary button mx-auto" value="See Class Data">
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
                                    <th scope="col">Reg no#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Section</th>
                                    <th scope="col">Monthly Fee</th>
                                    <th scope="col">Dues</th>
                                    <th scope="col">See Profile</th>
                                    <th scope="col">Edit</th>
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

                                    // to fetch all related students
                                    // $que = "SELECT * FROM student_class WHERE fk_section_id = $section AND fk_class_id = $class";
                                    // $pass_que = mysqli_query($conn, $que);
                                    // $res = mysqli_fetch_assoc($pass_que);
                                    // $sec = $res['fk_section_id'];
                                    // $clas = $res['fk_class_id'];

                                    // $que2 = "SELECT section_name FROM class_sections WHERE section_id = $section";
                                    // $pass_que2 = mysqli_query($conn, $que2);
                                    // $res2 = mysqli_fetch_assoc($pass_que2);
                                    // $_section = $res2['section_name'];
                                    // $que3 = "SELECT class_name FROM all_classes WHERE class_id = $class";
                                    // $pass_que3 = mysqli_query($conn, $que3);
                                    // $res3 = mysqli_fetch_assoc($pass_que3);
                                    // $_class = $res3['class_name'];

                                    $que = "SELECT * FROM all_classes ";
                                    $que .= "INNER JOIN class_sections ON all_classes.class_id = class_sections.fk_class_id ";
                                    $que .= "INNER JOIN student_class ON class_sections.section_id = student_class.fk_section_id ";
                                    $que .= "INNER JOIN student_profile ON student_class.fk_student_id = student_profile.student_id ";
                                    $que .= "WHERE class_id = '$class' AND section_id = '$section' AND status='1' AND student_status='1'";
                                    // $que .= "student_class.fk_section_id = class_sections.section_id INNER JOIN all_classes ";
                                    // $que .= "ON class_sections.fk_class_id = all_classes.class_id INNER JOIN student_profile ON ";
                                    // $que .= "student_class.fk_student_id = student_profile.student_id";



                                    // $table = 'student_profile';
                                    // $val1 = $_POST['class'];
                                    // $val2 = (string) $_POST['section'];
                                    // $op1 = 'class';
                                    // $op2 = 'section';
                                    $result = mysqli_query($conn, $que);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        //     // to fetch student data
                                        // $std = $row['fk_student_id'];
                                        // $que1 = "SELECT * FROM student_profile WHERE student_id = $std";
                                        // $pass_que1 = mysqli_query($conn, $que1);
                                        // $res1 = mysqli_fetch_assoc($pass_que1);
                                        // // getting the class
                                        // $que2 = "SELECT * FROM all_classes WHERE class_id = $class";
                                        // $pass_que2 = mysqli_query($conn, $que2);
                                        // $res2 = mysqli_fetch_assoc($pass_que2);
                                        // $class = $res2['class_name'];
                                        // // getting the section
                                        // $que3 = "SELECT * FROM class_sections WHERE section_id = $section";
                                        // $pass_que3 = mysqli_query($conn, $que3);
                                        // $res3 = mysqli_fetch_assoc($pass_que3);
                                        // $section = $res3['section_name'];

                                ?>
                                        <tr>
                                            <td><?php echo $row['roll_no']; ?></td><!--scope="row" -->
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['class_name']; ?></td>
                                            <td><?php echo $row['section_name']; ?></td>
                                            <td>Rs. <?php echo $row['fee_amount']; ?></td>
                                            <td>null</td>
                                            <td><a href="view-student.php?id=<?php echo $row['student_id']; ?>">View profile</a></td>
                                            <td><a href="edit-student.php?id=<?php echo $row['student_id']; ?>">Edit profile</a></td>
                                        </tr>

                                    <?php }
                                } else {
                                    // Selecting all student records from database
                                    $queri = "SELECT * FROM student_profile INNER JOIN student_class ";
                                    $queri .= "ON student_profile.student_id = student_class.fk_student_id INNER JOIN ";
                                    $queri .= "class_sections ON student_class.fk_section_id = class_sections.section_id INNER JOIN ";
                                    $queri .= "all_classes ON class_sections.fk_class_id = all_classes.class_id WHERE student_status='1' AND status='1'";

                                    $result = mysqli_query($conn, $queri);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['roll_no']; ?></td><!--scope="row" -->
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['class_name']; ?></td>
                                            <td><?php echo $row['section_name']; ?></td>
                                            <td>Rs. <?php echo $row['fee_amount']; ?></td>
                                            <td>null</td>
                                            <td><a href="view-student.php?id=<?php echo $row['student_id']; ?>">View profile</a></td>
                                            <td><a href="edit-student.php?id=<?php echo $row['student_id']; ?>">Edit profile</a></td>
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