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
                                    <button class="nav-link active" id="one-li" onclick="reloadPag('one-li')" data-bs-toggle="tab" data-bs-target="#payments">Payment</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="two-li" onclick="reloadPag('two-li')" data-bs-toggle="tab" data-bs-target="#subscribed">Subscribed</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="three-li" onclick="reloadPag('three-li')" data-bs-toggle="tab" data-bs-target="#unsubscribed">Un-Subscribed</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="four-li" onclick="reloadPag('four-li')" data-bs-toggle="tab" data-bs-target="#requests">Requested</button>
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
                                                    <th scope="col">Reg#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Class</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Received by</th>
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
                                                $query .= "INNER JOIN school_profile_ ON student_profile.fk_client_id=school_profile_.client_id ";
                                                $query .= "WHERE student_profile.fk_client_id='$client' AND sub_status='on' ";
                                                $query .= "ORDER BY fk_sub_log_id, sub_id";
                                                $get_pay_std = query($query);

                                                $coupled_records = [];
                                                while ($sub_pay = mysqli_fetch_assoc($get_pay_std)) {
                                                    $coupled_records[$sub_pay['fk_sub_log_id']][] = $sub_pay;
                                                }

                                                $codsmine_stake = 0;
                                                foreach ($coupled_records as $sub_log_id => $subs_pay) {
                                                    if ($sub_log_id == 0) {
                                                        $codsmine_received = 0;
                                                        $codsmine_share = 0;
                                                        $school_received = 0;
                                                        $school_share = 0;
                                                        $total = 0;
                                                    }
                                                    foreach ($subs_pay as $sub_pay) {
                                                        // getting the share percentage
                                                        if ($sub_pay['procedure'] == 'unprocessed') {
                                                            if ($codsmine_stake == 0 && $sub_log_id == 0) {
                                                                $codsmine_stake = (int) $sub_pay['codsmine_stake'];
                                                            }
                                                            // doing the maths
                                                            if ($sub_pay['sub_type'] == 'codsmine') {
                                                                $codsmine_received += (int) $sub_pay['sub_amount'];
                                                                $total += (int) $sub_pay['sub_amount'];
                                                            } elseif ($sub_pay['sub_type'] == 'school') {
                                                                $school_received += (int) $sub_pay['sub_amount'];
                                                                $total += (int) $sub_pay['sub_amount'];
                                                            }
                                                        }
                                                ?>
                                                        <tr>
                                                            <td><?php echo $sub_pay['roll_no']; ?></td>
                                                            <td><?php echo $sub_pay['name']; ?></td>
                                                            <td><?php echo $sub_pay['class_name'] . ' ' . $sub_pay['section_name']; ?></td>
                                                            <td>Rs.<?php echo $sub_pay['sub_amount']; ?></td>
                                                            <td class="text-capitalize"><?php echo $sub_pay['sub_type']; ?></td>
                                                        </tr>
                                                        <?php
                                                    } // end of inner loop
                                                    // if the sub_log_id is 0
                                                    if ($sub_log_id == 0) {
                                                        $school_stake = 100 - $codsmine_stake; // school share
                                                        $codsmine_share = ($codsmine_stake / 100) * $total;
                                                        $school_share = ($school_stake / 100) * $total;

                                                        if ($codsmine_received > $codsmine_share) {
                                                            $to_pay = $codsmine_received - $codsmine_share;
                                                        ?>
                                                            <tr>
                                                                <td colspan="5">
                                                                    <div class="row">
                                                                        <div class="col-xl-12">
                                                                            <div class="alert alert-info text-dark">
                                                                                CodsMine should pay <strong>Rs.<?php echo $to_pay; ?></strong> to <?php echo $_SESSION['school_name']; ?>.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        } elseif ($school_received > $school_share) {
                                                            $to_pay = $school_received - $school_share;
                                                        ?>
                                                            <tr>
                                                                <td colspan="5">
                                                                    <div class="row">
                                                                        <div class="col-xl-12">
                                                                            <div class="alert alert-info text-dark d-flex justify-content-between">
                                                                                <span><?php echo $_SESSION['school_name']; ?> should pay <strong>Rs.<?php echo $to_pay; ?></strong> to CodsMine.</span>
                                                                                <form action="./backend/manage-subscriptions.php" method="post">
                                                                                    <input type="hidden" name="paid" value="<?php echo $to_pay; ?>">
                                                                                    <button name="school_paid" type="submit" class="btn btn-sm btn-success ms-auto">Mark Paid</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                        <?php
                                                        } elseif ($codsmine_received == $codsmine_share && $school_received == $school_share) {
                                                        ?>
                                                            <tr>
                                                                <td colspan="5">
                                                                    <div class="row">
                                                                        <div class="col-xl-12">
                                                                            <div class="alert alert-info text-dark">
                                                                                Nothing to pay from each side! &#x1F44D;
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        } // end of elseif
                                                    } else { // if the log id is not 0 - means the records are processed
                                                        $query = "SELECT * FROM subscription_logs WHERE sub_log_id='$sub_log_id' ";
                                                        $query .= "AND fk_client_id='$client'";
                                                        $get_sub_log = query($query);
                                                        $sub_log = mysqli_fetch_assoc($get_sub_log);
                                                        ?>
                                                        <tr>
                                                            <td colspan="5">
                                                                <div class="row">
                                                                    <div class="col-xl-12">
                                                                        <div class="alert alert-success text-dark">
                                                                            <?php echo $sub_log['sub_log']; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    } // end of else
                                                    ?>

                                                <?php
                                                } // end of outer loop
                                                ?>
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
                                                    <th scope="col">Reg#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Class</th>
                                                    <th scope="col">Price</th>
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
                                                $query .= "INNER JOIN school_profile_ ON student_profile.fk_client_id=school_profile_.client_id ";
                                                $query .= "WHERE student_profile.fk_client_id='$client' AND sub_status='on'";
                                                $get_sub_std = query($query);

                                                while ($sub_std = mysqli_fetch_assoc($get_sub_std)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $sub_std['roll_no']; ?></td>
                                                        <td><?php echo $sub_std['name']; ?></td>
                                                        <td><?php echo $sub_std['class_name'] . ' ' . $sub_std['section_name']; ?></td>
                                                        <td>Rs.<?php echo $sub_std['sub_amount']; ?></td>
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
                                                    <th scope="col">Reg#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Class</th>
                                                    <th scope="col">Price</th>
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
                                                $query .= "INNER JOIN school_profile_ ON student_profile.fk_client_id=school_profile_.client_id ";
                                                $query .= "WHERE student_profile.fk_client_id='$client'";
                                                $get_unsub_std = query($query);

                                                while ($unsub_std = mysqli_fetch_assoc($get_unsub_std)) {
                                                    $unsub_student_id = $unsub_std['student_id'];
                                                    $query = "SELECT * FROM student_subscriptions WHERE fk_student_id='$unsub_student_id' ";
                                                    $query .= "AND fk_client_id='$client' AND (sub_status='requested' OR sub_status='on')";
                                                    $get_unsub_data = query($query);
                                                    if (mysqli_num_rows($get_unsub_data) == 0) {
                                                ?>
                                                        <tr id="req<?php echo $unsub_std['student_id']; ?>">
                                                            <td><?php echo $unsub_std['roll_no']; ?></td>
                                                            <td><?php echo $unsub_std['name']; ?></td>
                                                            <td><?php echo $unsub_std['class_name'] . ' ' . $unsub_std['section_name']; ?></td>
                                                            <td>Rs.<?php echo $unsub_std['sub_amount']; ?></td>
                                                            <td>Off</td>
                                                            <td>
                                                                <button onclick="requestSub(<?php echo $unsub_std['student_id']; ?>, '<?php echo 'req' . $unsub_std['student_id']; ?>')" class="btn btn-sm btn-outline-success">
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

                            <!-- start subscribed tab -->
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade requests" id="requests">

                                    <h4 class="card-title text-capitalize">Subscriptions Requested</h4>
                                    <!-- Primary Color Bordered Table -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-primary table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Reg#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Class</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Subscription</th>
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
                                                $query .= "INNER JOIN school_profile_ ON student_profile.fk_client_id=school_profile_.client_id ";
                                                $query .= "WHERE student_profile.fk_client_id='$client' AND sub_status='requested'";
                                                $get_requested_std = query($query);

                                                while ($req_std = mysqli_fetch_assoc($get_requested_std)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $req_std['roll_no']; ?></td>
                                                        <td><?php echo $req_std['name']; ?></td>
                                                        <td><?php echo $req_std['class_name'] . ' ' . $req_std['section_name']; ?></td>
                                                        <td>Rs.<?php echo $req_std['sub_amount']; ?></td>
                                                        <td class="text-capitalize"><?php echo $req_std['sub_status']; ?></td>
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
                            <!-- end unsubscribed tab -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<script>
    // // Function to reload the page and set the active tab
    // function reloadPage(elementId) {
    //     // Save the active tab's ID before reload
    //     localStorage.setItem('activeTab', elementId);
    //     location.reload(); // Reload the page
    // }

    // // Restore the active tab and show the corresponding tab content after page reload
    // window.addEventListener('load', function() {
    //     const activeTab = localStorage.getItem('activeTab') || 'one-li'; // Default to first tab if not found

    //     // Set the active class for the stored active tab
    //     const activeButton = document.getElementById(activeTab);
    //     activeButton.classList.add('active');

    //     // Activate the corresponding tab content
    //     const tabElement = new bootstrap.Tab(activeButton);
    //     tabElement.show(); // Show the corresponding tab content

    //     // Show the correct tab content by adding `active` and `show` classes
    //     const activeTabContentId = activeButton.getAttribute('data-bs-target');
    //     const activeTabContent = document.querySelector(activeTabContentId);

    //     // Make the correct tab content active
    //     activeTabContent.classList.add('active', 'show');

    //     // Remove active and show classes from all other tab contents
    //     const tabContents = document.querySelectorAll('.tab-pane');
    //     tabContents.forEach(content => {
    //         if (content.id !== activeTabContentId.substring(1)) { // Substring to remove '#' from the id
    //             content.classList.remove('active', 'show');
    //         }
    //     });
    // });

    // // Clear localStorage on logout or specific actions
    // function clearTabStateOnLogout() {
    //     localStorage.removeItem('activeTab'); // Clear stored active tab
    // }


    // request the subscription of the student
    function requestSub(id, del) {
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

                            if (item.msg == 'success') {
                                rowToRemove = document.getElementById(del);
                                rowToRemove.remove();
                            }

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