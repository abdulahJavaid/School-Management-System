<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<?php
// checking session for appropriate access
if ($level == 'clerk' || $level == 'super') {
} else {
    redirect("./");
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Promote Class</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="container">

            <!-- <form action="" method="post"> -->
            <div class="row align-items-center my-3">

                <!-- Select the Board -->
                <div class="col-auto">
                    <div class="input-group mb-2" id="classSelectDiv">
                        <button type="submit" name="add_subject" id="button-addon1" class="btn btn-sm btn-secondary">
                            Promote Class
                        </button>
                        <select id="sectionId"
                            name="section"
                            class="form-select"
                            onchange="promoteStudents(this.value)"
                            aria-describedby="button-addon1"
                            required>
                            <option value="" disabled selected>Choose Class</option>
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
                                        <option value="<?php echo $row1['section_id']; ?>"><?php echo $row['class_name'] . " " . $row1['section_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </optgroup>
                            <?php } ?>
                        </select>

                    </div>
                </div>

                <!-- <div class="col-auto" id="subjectInput" style="display: none;">
                        <div class="input-group">
                            <input
                                name="subject"
                                type="text"
                                class="form-control"
                                placeholder="Subject Name"
                                aria-label="Example input"
                                aria-describedby="button-addon2"
                                required />
                            <button type="submit" name="add_subject" id="button-addon2" class="btn btn-sm btn-success">
                                Add Subject
                            </button>
                        </div>
                    </div> -->

            </div>
            <!-- </form> -->

            <section class="section profile">
                <!--  -->
                <!--  -->
                <!--  -->
                <div class="row">
                    <style>
                        .card {
                            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
                        }

                        .avatar.sm {
                            width: 2.25rem;
                            height: 2.25rem;
                            font-size: .818125rem;
                        }

                        .table-nowrap .table td,
                        .table-nowrap .table th {
                            white-space: nowrap;
                        }

                        .table>:not(caption)>*>* {
                            padding: 0.75rem 1.25rem;
                            border-bottom-width: 1px;
                        }

                        table th {
                            font-weight: 600;
                            background-color: #eeecfd !important;
                        }
                    </style>

                    <!-- main div -->
                    <div id="class-promotion" class="col-sm-12" style="display: none;">
                        <!-- <div id="class-promotion" class="col-sm-12"> -->
                        <div class="card">
                            <div class="card-header card-bg-header border-0 text-dark mb-0">
                                <h5 class="mb-0">
                                    <strong>Class Promotion</strong>
                                    <span class="d-inline-block"
                                        tabindex="0"
                                        data-bs-toggle="tooltip"
                                        title="If you do not want to promote a single/some student, first promote the whole class then demote a single/some student from the promoted class.">
                                        <button type="button" class="btn btn-sm btn-outline-light"><i class="fa-solid fa-question"></i></button>
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body px-0 pb-0">
                                <div class="row">
                                    <div class="col-sm-6 pe-0">
                                        <!-- <div class="card border border-info border-end rounded-start">One</div> -->
                                        <!-- <div id="one" class="card border border-info border-end rounded-start m-0 p-4" style='border-right: 1px solid #17a2b8 !important; border-radius: 0 0 0 0.375rem !important;'> -->
                                        <div id="one" class="">
                                            <div class="row">
                                                <div class="col-12 mb- mb-lg-">
                                                    <div class="overflow-hidden card table-nowrap table-card custom-profile">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h5 class="mb-0 text-dark">Class Students</h5>
                                                            <span class="d-inline-block"
                                                                tabindex="0"
                                                                data-bs-toggle="tooltip"
                                                                title="Students of the selected class.">
                                                                <button type="button" class="btn btn-sm btn-outline-dark"><i class="fa-solid fa-question"></i></button>
                                                            </span>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table mb-0">
                                                                <thead class="small text-uppercase bg-body text-muted">
                                                                    <tr>
                                                                        <th>Reg#</th>
                                                                        <th>Name</th>
                                                                        <th>Class</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="promotion_students_tbody">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="hid_section_id" name="hid_section_id">
                                    <input type="hidden" id="hid_class_section" name="hid_class_section">
                                    <div class="col-sm-6 ps-0">
                                        <!-- <div class="card border border-info border-start rounded-end">Two</div> -->
                                        <!-- <div class="card border border-info border-end rounded-start m-0 p-4" style="border-left: 1px solid #17a2b8 !important; border-radius: 0 0 0.375rem 0 !important;"> -->
                                        <div id="two" class="">
                                            <div class="row">
                                                <div class="col-12 mb- mb-lg-">
                                                    <div class="overflow-hidden card table-nowrap table-card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h5 class="mb-0 text-dark">Select Class(for promotion)</h5>
                                                            <span class="d-inline-block"
                                                                tabindex="0"
                                                                data-bs-toggle="tooltip"
                                                                title="Select the class where you want to promote students.">
                                                                <button type="button" class="btn btn-sm btn-outline-dark"><i class="fa-solid fa-question"></i></button>
                                                            </span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div onclick="passOut()" class="card-body pt-2 pointer custom-profile">
                                                                    Pass Out(senior most)
                                                                </div>
                                                            </div>
                                                            <?php
                                                            // getting the class and sections of the school
                                                            $query = "SELECT * FROM all_classes AS ac INNER JOIN ";
                                                            $query .= "class_sections cs ON ac.class_id=cs.fk_class_id ";
                                                            $query .= "WHERE ac.fk_client_id='$client'";
                                                            $get_class_sections = query($query);

                                                            while ($row = mysqli_fetch_assoc($get_class_sections)) {
                                                            ?>
                                                                <div class="col-6">
                                                                    <div class="card-body pt-2 pointer custom-profile">
                                                                        <?php echo $row['class_name'] . ' ' . $row['section_name']; ?>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                            } // end of loop to fetch results
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <!--  -->
                <!--  -->
            </section>

        </div>
    </div>

</main><!-- End #main -->

<!-- for passing out a class -->
<div class="modal fade" id="passOut" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header card-bg-header text-white">
                <h5 class="modal-title" id="staticBackdropLabel"><strong></strong></h5>
                <button type="button" class="ms-auto bg-transparent border-0 text-white" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <form action="" method="post">
                <div class="modal-body" id="">
                    <p class="lead" id="addFeeReg"><strong>This means that students of this class has completed their studies at <strong><?php echo $_SESSION['school_name']; ?></strong> and from now will be the previous students of <strong><?php echo $_SESSION['school_name']; ?></strong>!</strong></p>
                    <input type="hidden" name="section_id" id="passSectionId">
                    <!-- <div class="row mb-3">
                        <label for="" class="col-md-4 col-lg-3 col-form-label"><strong>Title</strong> <code>*</code></label>
                        <div class="col-md-8 col-lg-9">
                            <input name="fund_title" type="text" class="form-control" id="fullName" placeholder="Stationary etc." required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-md-4 col-lg-3 col-form-label"><strong>Amount</strong> <code>*</code></label>
                        <div class="col-md-8 col-lg-9">
                            <input name="fund_amount" type="text" class="form-control" id="fullName" placeholder="Rs." required>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="addmore" class="btn btn-success">Pass Out</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // pass-out a class
    function passOut() {
        const modal = new bootstrap.Modal(document.getElementById('passOut'));
        var classSection = document.getElementById('hid_class_section').value;
        var sectionId = document.getElementById('hid_class_section').value;
        document.getElementById('passSectionId').value = sectionId;
        document.getElementById('staticBackdropLabel').innerText = 'Pass Out - '+classSection;

        modal.show();
    }
    // function passOut() {
    //     const modalElement = document.getElementById('passOut');
    //     if (modalElement) {
    //         const modal = new bootstrap.Modal(modalElement);

    //         var classSection = document.getElementById('hid_class_section').value;
    //         const labelElement = document.getElementById('staticBackdropLabel');
    //         if (labelElement) {
    //             labelElement.innerText += classSection;
    //         } else {
    //             console.error('Element with id "staticBackdropLabel" not found');
    //         }

    //         modal.show();
    //     } else {
    //         console.error('Modal element with id "addFee" not found');
    //     }
    // }

    // Show class students to promote the class
    function promoteStudents(sectId) {
        const sectionId = sectId;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/promote-section.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                try {
                    var response = JSON.parse(xhr.responseText);

                    if (response.length > 0) {
                        // display to block of class select
                        document.getElementById('class-promotion').style.display = "block";
                        // classes maping
                        var subjects = {
                            show: []
                        };
                        // pushin data records in the map
                        response.forEach(function(item) {
                            subjects.show.push({
                                id: item.id,
                                name: item.name,
                                roll_no: item.roll_no,
                                class_sect: item.class_sect,
                                section_id: item.section_id
                            });
                        });
                        var section = subjects.show[0].section_id;
                        document.getElementById('hid_section_id').value = section;
                        var classSection = subjects.show[0].class_sect;
                        document.getElementById('hid_class_section').value = classSection;

                        const tbody = document.getElementById('promotion_students_tbody');
                        tbody.innerHTML = "";
                        subjects.show.forEach(item => {
                            const tr = document.createElement('tr');
                            ['roll_no', 'name', 'class_sect'].forEach(key => {
                                const td = document.createElement('td');
                                td.innerText = item[key];
                                tr.appendChild(td);
                            });
                            tbody.appendChild(tr);
                        });

                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response text:', xhr.responseText);
                }
            }
        };

        xhr.send('section_id=' + encodeURIComponent(sectionId));
    }
</script>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>