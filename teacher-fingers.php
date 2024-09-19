<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<?php
// if the get request is not set
if (!isset($_GET['id'])) {
    redirect('./teachers.php');
}
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Fingerprints</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php
    // fetching the student data here
    $id = escape($_GET['id']);
    $query = "SELECT * FROM teacher_profile WHERE teacher_id='$id' AND teacher_status='1' AND fk_client_id='$client'";
    $pass = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($pass);

    $finger_1 = check_finger("right_thumb", $row['teacher_id']);
    $finger_2 = check_finger("right_index", $row['teacher_id']);
    $finger_3 = check_finger("left_thumb", $row['teacher_id']);
    $finger_4 = check_finger("left_index", $row['teacher_id']);
    ?>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-5" onload="setFormAction();">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Fingerprints</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                                <code>Fingerprint impressions for Teacher Attendance!</code>
                                <div class="row">
                                    <div class="col-sm-6 my-2">

                                        <div class="row text-center">
                                            <div class="col-12 my-2">
                                                <span class="d-block fw-bold pb-2">Right thumb</span>
                                                <?php
                                                // if fingerprint does not exists
                                                if ($finger_1 == "no") {
                                                ?>
                                                    <img id="FPImage1" alt="Fingerprint Image 1" height="150px" width="210" src="./images/default-thumb-finger.jpg" class="img-thumbnail">
                                                <?php
                                                } else { // if fingerprint exists
                                                ?>
                                                    <img id="FPImage1" alt="Fingerprint Image 1" height="150px" width="210" src="./images/default-thumb-finger.jpg" class="img-thumbnail">

                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-12">
                                                <?php
                                                // if fingerprint does not exists
                                                if ($finger_1 == "no") {
                                                ?>
                                                    <button type="button" class="btn btn-sm btn-secondary" onclick="CallSGIFPGetData(SuccessFunc1, ErrorFunc)"> Scan </button>
                                                    <button type="button" id="saveThumb1" class="btn btn-sm btn-primary" onclick="saveThumb(1)"> Save </button>
                                                <?php
                                                } else { // if fingerprint exists
                                                ?>
                                                    <code class="text-success fw-bold">Fingerprint saved</code>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-6 my-2">

                                        <div class="row text-center">
                                            <div class="col-12 my-2">
                                                <span class="d-block fw-bold pb-2">Right Index</span>
                                                <?php
                                                // if fingerprint does not exists
                                                if ($finger_2 == "no") {
                                                ?>
                                                    <img id="FPImage2" alt="Fingerprint Image 1" height="50px" width="210" src="./images/default-index-finger.jpg" class="img-thumbnail">
                                                <?php
                                                } else { // if fingerprint exists
                                                ?>

                                                    <img id="FPImage2" alt="Fingerprint Image 1" height="50px" width="210" src="./images/default-index-finger.jpg" class="img-thumbnail">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-12">
                                                <?php
                                                // if fingerprint does not exists
                                                if ($finger_2 == "no") {
                                                ?>
                                                    <button type="button" class="btn btn-sm btn-secondary" onclick="CallSGIFPGetData(SuccessFunc2, ErrorFunc)"> Scan </button>
                                                    <button type="button" id="saveThumb2" class="btn btn-sm btn-primary" onclick="saveThumb(2)"> Save </button>
                                                <?php
                                                } else { // if fingerprint exists
                                                ?>
                                                    <code class="text-success fw-bold">Fingerprint saved</code>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-sm-6 my-2">

                                        <div class="row text-center">
                                            <div class="col-12 my-2">
                                                <span class="d-block fw-bold pb-2">Left thumb</span>
                                                <?php
                                                // if fingerprint does not exists
                                                if ($finger_3 == "no") {
                                                ?>
                                                    <img id="FPImage3" alt="Fingerprint Image 1" height="150px" width="210" src="./images/default-thumb-finger.jpg" class="img-thumbnail">
                                                <?php
                                                } else { // if fingerprint exists
                                                ?>
                                                    <img id="FPImage3" alt="Fingerprint Image 1" height="150px" width="210" src="./images/default-thumb-finger.jpg" class="img-thumbnail">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-12">
                                                <?php
                                                // if fingerprint does not exists
                                                if ($finger_3 == "no") {

                                                ?>
                                                    <button type="button" class="btn btn-sm btn-secondary" onclick="CallSGIFPGetData(SuccessFunc3, ErrorFunc)"> Scan </button>
                                                    <button type="button" id="saveThumb3" class="btn btn-sm btn-primary" onclick="saveThumb(3)"> Save </button>
                                                <?php
                                                } else { // if fingerprint exists
                                                ?>
                                                    <code class="text-success fw-bold">Fingerprint saved</code>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-6 my-2">

                                        <div class="row text-center">
                                            <div class="col-12 my-2">
                                                <span class="d-block fw-bold pb-2">Left Index</span>
                                                <?php
                                                // if fingerprint does not exists
                                                if ($finger_4 == "no") {
                                                ?>
                                                    <img id="FPImage4" alt="Fingerprint Image 1" height="50px" width="210" src="./images/default-index-finger.jpg" class="img-thumbnail">
                                                <?php
                                                } else { // if fingerprint exists
                                                ?>
                                                    <img id="FPImage4" alt="Fingerprint Image 1" height="50px" width="210" src="./images/default-index-finger.jpg" class="img-thumbnail">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-12">
                                                <?php
                                                // if fingerprint does not exists
                                                if ($finger_4 == "no") {
                                                ?>
                                                    <button type="button" class="btn btn-sm btn-secondary" onclick="CallSGIFPGetData(SuccessFunc4, ErrorFunc)"> Scan </button>
                                                    <button type="button" id="saveThumb4" class="btn btn-sm btn-primary" onclick="saveThumb(4)"> Save </button>
                                                <?php
                                                } else { // if fingerprint exists
                                                ?>
                                                    <code class="text-success fw-bold">Fingerprint saved</code>
                                                <?php
                                                }
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

            <div class="col-sm-7">
                <div class="custom-profile">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Teacher Profile</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <!-- <h5 class="card-title">About</h5>
                                    <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->

                                    <h5 class="card-title">Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label "><strong>Name</strong></div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row['name']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label "><strong>Teacher Id</strong></div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row['school_id']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label "><strong>CNIC</strong></div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row['cnic']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label"><strong>Date of Birth</strong></div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row['dob']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label "><strong>Gender</strong></div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row['teacher_gender']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label "><strong>Qualification</strong></div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row['qualification']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label "><strong>Father Name</strong></div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row['f_name']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label"><strong>Phone#</strong></div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row['phone_no']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label"><strong>Email</strong></div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row['email']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label"><strong>Salary</strong></div>
                                        <div class="col-lg-9 col-md-8">Rs.<?php echo $row['teacher_salary']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label"><strong>Address</strong></div>
                                        <div class="col-lg-9 col-md-8"><?php echo $row['address']; ?></div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <!-- Profile Edit Form -->
                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<script>
    // code to scan and add fingerprints

    var template_1 = ""; // right hand thumb fingerprint
    var template_2 = ""; // right hand index fingerprint
    var template_3 = ""; // left hand thumb fingerprint
    var template_4 = ""; // left hand index fingerprint

    // success function right hand thumb
    function SuccessFunc1(result) {
        if (result.ErrorCode == 0) {
            /* 	Display BMP data in image tag
                BMP data is in base 64 format 
            */
            if (result != null && result.BMPBase64.length > 0) {
                document.getElementById('FPImage1').src = "data:image/bmp;base64," + result.BMPBase64;
            }
            template_1 = result.TemplateBase64;
        } else {
            alert("Fingerprint Capture Error Code:  " + result.ErrorCode + ".\nDescription:  " + ErrorCodeToString(result.ErrorCode) + ".");
        }
    }

    // success function for right hand index finger
    function SuccessFunc2(result) {
        if (result.ErrorCode == 0) {
            /* 	Display BMP data in image tag
                BMP data is in base 64 format 
            */
            if (result != null && result.BMPBase64.length > 0) {
                document.getElementById('FPImage2').src = "data:image/bmp;base64," + result.BMPBase64;
            }
            template_2 = result.TemplateBase64;
        } else {
            alert("Fingerprint Capture Error Code:  " + result.ErrorCode + ".\nDescription:  " + ErrorCodeToString(result.ErrorCode) + ".");
        }
    }

    // success function left hand thumb
    function SuccessFunc3(result) {
        if (result.ErrorCode == 0) {
            /* 	Display BMP data in image tag
                BMP data is in base 64 format 
            */
            if (result != null && result.BMPBase64.length > 0) {
                document.getElementById('FPImage3').src = "data:image/bmp;base64," + result.BMPBase64;
            }
            template_3 = result.TemplateBase64;
        } else {
            alert("Fingerprint Capture Error Code:  " + result.ErrorCode + ".\nDescription:  " + ErrorCodeToString(result.ErrorCode) + ".");
        }
    }

    // success function for left hand index finger
    function SuccessFunc4(result) {
        if (result.ErrorCode == 0) {
            /* 	Display BMP data in image tag
                BMP data is in base 64 format 
            */
            if (result != null && result.BMPBase64.length > 0) {
                document.getElementById('FPImage4').src = "data:image/bmp;base64," + result.BMPBase64;
            }
            template_4 = result.TemplateBase64;
        } else {
            alert("Fingerprint Capture Error Code:  " + result.ErrorCode + ".\nDescription:  " + ErrorCodeToString(result.ErrorCode) + ".");
        }
    }

    // if user has not installed the api into the computer
    function ErrorFunc(status) {
        /* 	
            If you reach here, user is probabaly not running the 
            service. Redirect the user to a page where he can download the
            executable and install it. 
        */
        alert("Check if SGIBIOSRV is running; status = " + status + ":");
    }

    // getting the fingerprint
    function CallSGIFPGetData(successCall, failCall) {
        var uri = "https://localhost:8443/SGIFPCapture";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                fpobject = JSON.parse(xmlhttp.responseText);
                successCall(fpobject);
            } else if (xmlhttp.status == 404) {
                failCall(xmlhttp.status)
            }
        }
        xmlhttp.onerror = function() {
            failCall(xmlhttp.status);
        }
        var params = "Timeout=" + "10000";
        params += "&Quality=" + "50";
        params += "&licstr=" + encodeURIComponent(secugen_lic);
        params += "&templateFormat=" + "ISO";
        xmlhttp.open("POST", uri, true);
        xmlhttp.send(params);
    }


    // saving the thumb
    function saveThumb(fingerNumber) {
        if (fingerNumber === 1) {
            templateBase64 = template_1;
        }
        if (fingerNumber === 2) {
            templateBase64 = template_2;
        }
        if (fingerNumber === 3) {
            templateBase64 = template_3;
        }
        if (fingerNumber === 4) {
            templateBase64 = template_4;
        }
        if (templateBase64 === "") {
            alert("No fingerprint data available for this thumb.");
            return;
        }
        sendToServer(templateBase64, fingerNumber);
    }

    // storing the thumb into database
    function sendToServer(templateBase64, fingerNumber) {
        var xhr = new XMLHttpRequest();
        var id = "<?php echo $row['teacher_id']; ?>";
        var url = "./backend/save-fingerprint.php";
        var params = "template=" + encodeURIComponent(templateBase64) + "&fingerNumber=" + fingerNumber + "&teacher_id=" + id;
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log("Thumb impression sent successfully");
                // Optionally handle response from server
            }
        };
        xhr.send(params);
    }

    // nice global area, so that only 1 location, contains this information
    // var secugen_lic = "hE/78I5oOUJnm5fa5zDDRrEJb5tdqU71AVe+/Jc2RK0=";   // webapi.secugen.com
    var secugen_lic = "";

    function ErrorCodeToString(ErrorCode) {
        var Description;
        switch (ErrorCode) {
            // 0 - 999 - Comes from SgFplib.h
            // 1,000 - 9,999 - SGIBioSrv errors 
            // 10,000 - 99,999 license errors
            case 51:
                Description = "System file load failure";
                break;
            case 52:
                Description = "Sensor chip initialization failed";
                break;
            case 53:
                Description = "Device not found";
                break;
            case 54:
                Description = "Fingerprint image capture timeout";
                break;
            case 55:
                Description = "No device available";
                break;
            case 56:
                Description = "Driver load failed";
                break;
            case 57:
                Description = "Wrong Image";
                break;
            case 58:
                Description = "Lack of bandwidth";
                break;
            case 59:
                Description = "Device Busy";
                break;
            case 60:
                Description = "Cannot get serial number of the device";
                break;
            case 61:
                Description = "Unsupported device";
                break;
            case 63:
                Description = "SgiBioSrv didn't start; Try image capture again";
                break;
            default:
                Description = "Unknown error code or Update code to reflect latest result";
                break;
        }
        return Description;
    }
</script>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>