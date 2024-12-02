<?php require_once("includes/header.php"); ?>

<?php
// checking session for appropriate access
if ($level == 'developer') {
} else {
    redirect("./");
}
?>

<style>
    .mai {
        margin-top: 70px;
    }

    .cards-titles {
        background: #6dd5ed !important;
    }

    /* search bar result */
    /* Style the results container to look like a dropdown */
    #results {
        width: 100%;
        /* Ensure it fits the width of the input */
        max-height: 200px;
        /* Set a max height to prevent overflow */
        overflow-y: auto;
        /* Add a scrollbar if too many results */
        background-color: #FEFBF3;
        /* Ensure results have a white background */
        border: 1px solid #ddd;
        /* Give a subtle border */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        /* Dropdown-like shadow */
        position: absolute;
        top: 100%;
        /* Position it right below the search input */
        left: 0;
        right: 0;
        z-index: 1000;
        display: none;
        /* Hidden by default */
    }

    /* #results {
        background: #6dd5ed;
    } */

    /* Search results for small screens */
    @media (max-width: 768px) {
        #results {
            position: absolute;
            /* Allow results to flow under the input on small screens */
            top: 100%;
        }
    }

    /* Style individual search results */
    .dropdown-item {
        padding: 10px;
        color: #333;
        text-decoration: none;
        display: block;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }
</style>

<main id="mai" class="mai">

    <!-- Hidden iframe -->
    <iframe id="hiddenFrame" name="hiddenFrame" style="display:none;"></iframe>

    <!-- Form targeting the hidden iframe -->
    <form method="POST" action="select-school.php" target="hiddenFrame" id="hiddenForm">
        <input type="hidden" name="jsValue" id="jsValue">
    </form>

    <div class="container">

        <div class="pagetitle px-5 py-2">
            <h1>All Schools</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Select/Add School</li>
                    <!-- <li class="breadcrumb-item d-flex justify-content-end"></li> -->
                </ol>
            </nav>

        </div><!-- End Page Title -->

        <!-- class and sections -->
        <div class="pagetitle">
            <div class="container mx-5">
                <div class="row">
                    <div class="col-4">
                        <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#formModal">Add New School</a>
                    </div>
                </div>
            </div>
        </div><!-- End Page Title -->

        <?php
        // select all the schools
        $query = "SELECT * FROM school_profile_";
        $get_schools = query($query);
        ?>


        <div class="container mx-5">
            <section class="sectio profile">
                <div class="row">
                    <?php
                    // gettign all the schools
                    while ($school = mysqli_fetch_assoc($get_schools)):
                    ?>

                        <div class="col-md-4 col-sm-4">
                            <a href="#" onclick="sendRequest(<?php echo $school['id']; ?>)">
                                <div class="card text-dark bg-light border border-info mb-3">
                                    <div class="card-header cards-titles text-dark fw-bold text-capitalize"><?php echo $school['name']; ?></div>
                                    <div class="card-body">
                                        <!-- <h5 class="card-title fw-normal">Details</h5> -->
                                        <p class="card-text my-2">Address: <?php echo $school['address']; ?> </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>

                </div>
            </section>
        </div>
    </div>


    <!-- Add School Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header cards-titles">
                    <h4 class="modal-title" id="formModalLabel">Add New School</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                </div>
                <div class="modal-body">
                    <form action="./backend/add-new-school.php" method="post" id="demo-form" class="mb-4">
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-lg-3 col-form-label"><strong>Upload Photo</strong> </label>
                            <div class="col-md-8 col-lg-9">
                                <div class="text-center">
                                    <img id="imagePreview" src="https://via.placeholder.com/70" alt="Image Preview" class="rounded mb-2" width="70px" height="70px">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input type="file" name="image" class="form-control d-none" id="fileInput" onchange="previewImage(event)">
                                    <button class="btn btn-sm btn-secondary" type="button" id="uploadButton">
                                        <i class="bi bi-upload"></i>
                                    </button>&nbsp;
                                    <button class="btn btn-sm btn-danger" type="button" id="deleteButton">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <!-- <input name="name" type="text" class="form-control" id="fullName" value="" placeholder="Full Name" required> -->
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="about" class="col-md-4 col-lg-3 col-form-label"><strong>About School</strong></label>
                            <div class="col-md-8 col-lg-9">
                                <textarea name="about" class="form-control" id="about" style="height: 100px"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="client_id" class="col-md-4 col-lg-3 col-form-label"><strong>Client Id</strong></label>
                            <div class="col-md-8 col-lg-9">
                                <input name="client_id" type="text" onkeyup="searchClient()" autocomplete="off" class="form-control" id="client_id" placeholder="Client id" required>
                            </div>
                            <div class="row d-none" id="client-result-main">
                                <div class="w-58 col-md-8 col-lg-8 offset-md-4 offset-lg-4">
                                    <div class="" id="client-result">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="sub_amount" class="col-md-4 col-lg-3 col-form-label"><strong>Subscription</strong></label>
                            <div class="col-md-8 col-lg-9">
                                <input name="sub_amount" type="text" class="form-control" id="sub_amount" placeholder="Rs.">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="codsmine_stake" class="col-md-4 col-lg-3 col-form-label"><strong>Codsmine%</strong></label>
                            <div class="col-md-8 col-lg-9">
                                <input name="codsmine_stake" type="number" class="form-control" id="codsmine_stake" placeholder="eg, 50">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-lg-3 col-form-label"><strong>School Name</strong></label>
                            <div class="col-md-8 col-lg-9">
                                <input name="name" type="text" class="form-control" id="name" placeholder="School name" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="o_name" class="col-md-4 col-lg-3 col-form-label"><strong>Owner Name</strong></label>
                            <div class="col-md-8 col-lg-9">
                                <input name="o_name" type="text" class="form-control" id="o_name" placeholder="Owner name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="slogan" class="col-md-4 col-lg-3 col-form-label"><strong>School Slogan</strong></label>
                            <div class="col-md-8 col-lg-9">
                                <input name="slogan" type="text" class="form-control" id="slogan" placeholder="School slogan">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="private" class="col-md-4 col-lg-3 col-form-label"><strong>School Type</strong></label>
                            <div class="col-md-8 col-lg-9">
                                <input name="private" type="text" class="form-control" id="private" placeholder="private/public(govt.)">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-lg-3 col-form-label"><strong>Address</strong></label>
                            <div class="col-md-8 col-lg-9">
                                <input name="address" type="text" class="form-control" id="address" placeholder="School address" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="city" class="col-md-4 col-lg-3 col-form-label"><strong>City</strong></label>
                            <div class="col-md-8 col-lg-9">
                                <input name="city" type="text" class="form-control" id="city" placeholder="School city" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Contact" class="col-md-4 col-lg-3 col-form-label"><strong>Contact No</strong></label>
                            <div class="col-md-8 col-lg-9">
                                <input name="contact" type="text" class="form-control" id="contact" placeholder="Enter contact no">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="Email" class="col-md-4 col-lg-3 col-form-label"><strong>Email</strong></label>
                            <div class="col-md-8 col-lg-9">
                                <input name="email" type="email" class="form-control" id="email" placeholder="example@mail.com">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="expiry" class="col-md-4 col-lg-3 col-form-label"><strong>Expiry Date</strong></label>
                            <div class="col-md-8 col-lg-9">
                                <input name="expiry" type="date" class="form-control" id="Email" placeholder="Expiry date">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Close</button>
                            <?php //if (isset($_POST['jsValue'])) { 
                            ?>
                            <!-- <button type="submit" name="add_school" class="btn btn-sm btn-success" disabled>Submit</button> -->
                            <?php //} else { 
                            ?>
                            <button type="submit" name="add_school" class="btn btn-sm btn-success">Submit</button>
                            <?php //} 
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add School modal -->

</main><!-- End #main -->

<script>
    // code to upload and view the image
    document.getElementById('uploadButton').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });
    document.getElementById('deleteButton').addEventListener('click', function() {
        document.getElementById('fileInput').value = '';
        document.getElementById('imagePreview').src = 'https://via.placeholder.com/70';
    });

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // code to get the search results if the client id exists
    function searchClient() {
        var searchQuery = document.getElementById('client_id').value.trim();

        // If the search query is empty, hide the results
        if (searchQuery.length === 0) {
            document.getElementById('client-result-main').style.display = 'none';
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/add-new-school.php', true); // Adjust the path to your PHP file
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // console.log(xhr.responseText);
                try {
                    var response = JSON.parse(xhr.responseText);

                    var resultsDiv = document.getElementById('client-result-main');
                    // resultsDiv.innerHTML = ''; // Clear previous results
                    var textDiv = document.getElementById('client-result');
                    textDiv.innerHTML = ''; // Clear previous results

                    if (response.length > 0) {
                        // Show the results div
                        resultsDiv.style.display = 'block';
                        resultsDiv.classList.remove('d-none');

                        // Loop through each result and show as a span
                        response.forEach(function(item) {

                            textDiv.classList.remove('bg-info');

                            // Create span to show message
                            var disp = document.createElement('span');
                            disp.textContent = item.msg; // Display the result 
                            // if (disp.textContent != 'Client Id is available!') {
                            //     // sendJsValue('yes');
                            //     document.getElementById('client_id').value = "";
                            // }
                            textDiv.classList.add('bg-info');
                            textDiv.classList.add('border');
                            textDiv.classList.add('rounded');
                            textDiv.classList.add('text-center');
                            textDiv.classList.add('text-light');
                            disp.style.display = 'block'; // Make the link a block element
                            textDiv.appendChild(disp);
                        });
                    } else {
                        resultsDiv.style.display = 'none';
                        resultsDiv.classList.add('d-none');
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response text:', xhr.responseText);
                }
            }
        };

        xhr.send('query=' + encodeURIComponent(searchQuery));
    }

    // ------------function unused
    // if the client id is already available
    function sendJsValue(vals) {
        var jsVar = document.getElementById('ds').style.display;
        document.getElementById('jsValue').value = jsVar;

        // Automatically submit the form, targeting the hidden iframe
        if (vals == 'no') {
            document.getElementById('hiddenForm').submit();
        }
    }

    // sending the admin to the selected school
    function sendRequest(schoolId) {
        var xhr = new XMLHttpRequest();
        var url = "./backend/set-school-developer.php";
        var params = "school_id=" + schoolId;
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);

                // Check the status in the response
                if (response.status === 'success') {
                    // Redirect based on the response
                    window.location.href = response.redirectUrl;
                    // console.log("You are successful!");
                } else {
                    alert('Error: ' + response.message);
                }
            }
        };
        xhr.send(params);
    }

    // code to get the search results of the matching schools
    function searchDatabase() {
        var searchQuery = document.getElementById('search-input').value.trim();

        // If the search query is empty, hide the results
        if (searchQuery.length === 0) {
            document.getElementById('results').style.display = 'none';
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './backend/search-school-developer.php', true); // Adjust the path to your PHP file
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);

                    var resultsDiv = document.getElementById('results');
                    resultsDiv.innerHTML = ''; // Clear previous results

                    if (response.length > 0) {
                        // Show the results div
                        resultsDiv.style.display = 'block';

                        // Loop through each result and add as a nav link
                        response.forEach(function(item) {
                            var resultItem = document.createElement('div');
                            resultItem.classList.add('dropdown-item'); // Bootstrap styling for each item

                            // Create a link element
                            var name = document.createElement('span');
                            // link.href = item.address; // Use the URL from the search results
                            name.textContent = item.name; // Display the result name
                            name.style.display = 'block'; // Make the link a block element
                            resultItem.appendChild(name);

                            // Optionally, display the URL below the name
                            var address = document.createElement('small');
                            address.textContent = item.address; // Display the URL as text
                            address.style.color = '#6c757d'; // Make the URL text grey
                            resultItem.appendChild(address);

                            resultsDiv.appendChild(resultItem);

                        });
                    } else {
                        resultsDiv.style.display = 'none';
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.error('Response text:', xhr.responseText);
                }
            }
        };

        xhr.send('query=' + encodeURIComponent(searchQuery));
    }
</script>


<!-- Footer section -->
<footer id="foote" class="footer mt-5">
    <div class="copyright">
        &copy; <strong><span>My School</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Designed by <a href="https://codsmine.com/">Codsmine.com</a>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center button"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>



<!-- google translate -->
<!-- <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> -->

</body>

</html>