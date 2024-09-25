<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<?php
// checking for appropriate session
if ($level != 'accountant' && $level != 'super') {
    redirect("./");
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Subscriptions</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div>

    <!-- End Page Title -->

    <section class="section profile">
        <div class="row">

            <div class="col-12">
                <div class="custom-profil-removed-(e)">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#payments">Payment</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#subscribed">Subscribed</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#unsubscribed">Un-Subscribed</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#requests">Requested</button>
                                </li>

                            </ul>

                            <!-- start payments tab -->
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active payments" id="payments">

                                    <h4 class="card-title text-capitalize">Subscription Payments</h4>
                                    <!-- Primary Color Bordered Table -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-primary table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Reg no#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Class</th>
                                                    <th scope="col">Sub. Amount</th>
                                                    <th scope="col">Received by</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>###</td>
                                                    <td>###</td>
                                                    <td>###</td>
                                                    <td>###</td>
                                                    <td>###</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- End Primary Color Bordered Table -->

                                </div>
                            </div>
                            <!-- end payments tab -->

                            <!-- start subscribed tab -->
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade subscribed" id="subscribed">

                                    <h4 class="card-title text-capitalize">Subscribed Students</h4>
                                    <!-- Primary Color Bordered Table -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-primary table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Reg no#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Class</th>
                                                    <th scope="col">Subscription</th>
                                                    <th scope="col">Expiry</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // getting the unsubscribed students
                                                $query = "SELECT * FROM student_profile INNER JOIN student_class ON ";
                                                $query .= "student_profile.student_id=student_class.fk_student_id ";
                                                $query .= "INNER JOIN class_sections ON student_class.fk_section_id=class_sections.section_id ";
                                                $query .= "INNER JOIN all_classes ON class_sections.fk_class_id=all_classes.class_id ";
                                                $query .= "INNER JOIN student_subscriptions ON student_profile.student_id=student_subscriptions.fk_student_id ";
                                                $query .= "WHERE student_profile.fk_client_id='$client' AND sub_status='on'";
                                                $get_sub_std = query($query);

                                                while ($sub_std = mysqli_fetch_assoc($get_sub_std)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sub_std['roll_no']; ?></td>
                                                        <td><?php echo $sub_std['name']; ?></td>
                                                        <td><?php echo $sub_std['class_name'] . ' ' . $unsub_std['section_name']; ?></td>
                                                        <td class="text-capitalize"><?php echo $sub_std['sub_status']; ?></td>
                                                        <td><?php echo $sub_std['sub_expiry']; ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- End Primary Color Bordered Table -->

                                </div>
                            </div>
                            <!-- end subscribed tab -->

                            <!-- start unsubscribed tab -->
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade unsubscribed" id="unsubscribed">

                                    <h4 class="card-title text-capitalize">Un-subscribed Students</h4>
                                    <!-- Primary Color Bordered Table -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-primary table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Reg no#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Class</th>
                                                    <th scope="col">Subscription</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // getting the unsubscribed students
                                                $query = "SELECT * FROM student_profile INNER JOIN student_class ON ";
                                                $query .= "student_profile.student_id=student_class.fk_student_id ";
                                                $query .= "INNER JOIN class_sections ON student_class.fk_section_id=class_sections.section_id ";
                                                $query .= "INNER JOIN all_classes ON class_sections.fk_class_id=all_classes.class_id ";
                                                $query .= "WHERE student_profile.fk_client_id='$client'";
                                                $get_unsub_std = query($query);

                                                while ($unsub_std = mysqli_fetch_assoc($get_unsub_std)) {
                                                    $unsub_student_id = $unsub_std['student_id'];
                                                    $query = "SELECT * FROM student_subscriptions WHERE fk_student_id='$unsub_student_id' ";
                                                    $query .= "AND sub_status='on' AND fk_client_id='$client'";
                                                    $get_unsub_data = query($query);
                                                    if (mysqli_num_rows($get_unsub_data) == 0) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $unsub_std['roll_no']; ?></td>
                                                            <td><?php echo $unsub_std['name']; ?></td>
                                                            <td><?php echo $unsub_std['class_name'] . ' ' . $unsub_std['section_name']; ?></td>
                                                            <td>Off</td>
                                                            <td>
                                                                <button onclick="requestSub(<?php echo $unsub_std['student_id']; ?>)" class="btn btn-sm btn-success">
                                                                    Request Subscription
                                                                </button>
                                                            </td>
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
                            <!-- end unsubscribed tab -->

                            <!-- start unsubscribed tab -->
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade requests" id="requests">

                                    <h4 class="card-title text-capitalize">Subscriptions Requested</h4>

                                </div>
                            </div>
                            <!-- end unsubscribed tab -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<script>
    // request the subscription of the student
    function requestSub(id) {
        // getting the student id
        var sendId = id;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/manage-subscriptions.php', true); // Adjust the path to your PHP file
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // console.log(xhr.responseText);
                try {
                    var response = JSON.parse(xhr.responseText);

                    if (response.length > 0) {
                        // Loop through each result and show as a span
                        response.forEach(function(item) {
                            
                        });
                    } else {

                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response text:', xhr.responseText);
                }
            }
        };

        xhr.send('request_sub=' + encodeURIComponent(sendId));
    }
</script>


<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>