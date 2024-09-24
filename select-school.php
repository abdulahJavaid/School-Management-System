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
</style>

<main id="mai" class="mai">
    <div class="container">

        <div class="pagetitle px-5 py-2">
            <h1>All Schools</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Select School</li>
                    <!-- <li class="breadcrumb-item d-flex justify-content-end"></li> -->
                </ol>
            </nav>

        </div><!-- End Page Title -->

        <!-- class and sections -->
        <div class="pagetitle">
            <div class="row">
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

</main><!-- End #main -->

<script>
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
    function searchDatabase() {
    var searchQuery = document.getElementById('search-input').value.trim();

    // If the search query is empty, clear the results
    if (searchQuery.length === 0) {
        document.getElementById('results').innerHTML = '';
        return;
    }

    // Create a new XMLHttpRequest
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './backend/search-school-developer.php', true); // Adjust path if needed
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Function to execute when the request is complete
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText); // Parse the JSON response

                // Clear previous results
                var resultsDiv = document.getElementById('results');
                resultsDiv.innerHTML = '';

                // Check if we received results
                if (response.length > 0) {
                    // Loop through the results and display them
                    response.forEach(function(item) {
                        var resultItem = document.createElement('div');
                        resultItem.textContent = item.name; // Adjust to the field you want to display
                        resultsDiv.appendChild(resultItem);
                    });
                } else {
                    resultsDiv.innerHTML = '<div>No matches found</div>';
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
                console.error('Response text:', xhr.responseText); // Log the raw response text for debugging
            }
        }
    };

    // Send the search query to the PHP script
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




<!-- ======= Footer ======= -->
<?php //include_once("includes/footer.php"); 
?>