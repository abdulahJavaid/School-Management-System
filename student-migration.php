<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// redirect
redirect("./");
?>

<?php
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// This page is not being used
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Students</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">My School System</li>
            </ol>
        </nav>
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
                                    <th scope="col">Progress Date</th>
                                    <th scope="col">View Report</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // get student info
                                $query = "SELECT * FROM progress_report INNER JOIN ";
                                $query .= "student_profile ON progress_report.fk_student_id=student_profile.student_id ";
                                $query .= "INNER JOIN student_class ON student_profile.student_id=student_class.fk_student_id ";
                                $query .= "INNER JOIN class_sections ON student_class.fk_section_id=class_sections.section_id ";
                                $query .= "INNER JOIN all_classes ON class_sections.fk_class_id=all_classes.class_id ";
                                $result = query($query);
                                $rows = mysqli_fetch_assoc($result);


                                // Fetch data from the database

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['roll_no'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['class_name'] . "</td>";
                                        echo "<td>" . $row['section_name'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td><a href='view-progress-report.php?roll_no=" . $row['roll_no'] . "' class='btn btn-primary'>View Report</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No students found.</td></tr>";
                                }

                                $conn->close();
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