<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Mark Attendance</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active">School name here</li>
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
                        <input type="submit" name="class" class="btn btn-md btn-primary button mx-auto" value="Select Class">
                    </div>
                    <!-- <div class="d-flex justify-content-end">
                        <a class="btn btn-primary button" href="./student-profile.php">Add Student</a>
                    </div> --> <br><br><br>
                </div>
            </form>
        </div>
    </div><!-- End Page Title -->

    <?php

    ?>

    <section class="section profile">
        <div class="row">
            <div class="col-md-8 offset-md-1">
                <?php
                // if the class is selected
                if (isset($_POST['class'])) {
                    // determining the class and section that is selected
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

                    $query = "SELECT * FROM all_classes INNER JOIN class_sections ON ";
                    $query .= "all_classes.class_id = class_sections.fk_class_id INNER JOIN ";
                    $query .= "student_class ON class_sections.section_id = student_class.fk_section_id ";
                    $query .= "INNER JOIN student_profile ON student_class.fk_student_id = student_profile.student_id ";
                    $query .= "WHERE class_id = '$class' AND section_id = '$section'";

                    $result = query($query);
                    // $row = mysqli_fetch_assoc($result);
                ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Students of class: <?php //echo $row['class_name'] . ' ' . $row['section_name']; 
                                                                        ?></h5>
                            <!-- <p>Add <code>.table-bordered</code> for borders on all sides of the table and cells.</p> -->

                            <!-- Primary Color Bordered Table -->
                            <form action="backend/add-class_attendance.php" method="post">
                                <table class="table table-bordered border-primary">
                                    <thead>
                                        <tr>
                                            <th scope="col">Registration#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Present</th>
                                            <th scope="col">Absent</th>
                                            <th scope="col">Leave</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // looop to fetch the class data
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>

                                            <tr>
                                                <td><?php echo $row['roll_no']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><input class="raadio_c" type="radio" value="present" name="attendance<?php echo $row['student_id']; ?>" required></td>
                                                <td><input class="raadio_c" type="radio" value="absent" name="attendance<?php echo $row['student_id']; ?>" required></td>
                                                <td><input class="raadio_c" type="radio" value="leave" name="attendance<?php echo $row['student_id']; ?>" required></td>
                                            </tr>
                                        <?php
                                        } // end of looop to fetch class data
                                        ?>
                                    </tbody>
                                </table>
                                <input type="hidden" name="class" value="<?php echo $class; ?>">
                                <input type="hidden" name="section" value="<?php echo $section; ?>">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="submit" class="btn btn-primary button">Submit Attendance</button>
                                </div>
                            </form>
                            <!-- End Primary Color Bordered Table -->

                        </div>
                    </div>
                <?php
                } // end of if(class)
                ?>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>