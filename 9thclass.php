<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<style>
    .decoration {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 20px;
    }
    .de-li {
        list-style: none;
        margin: 15px;
        border-radius: 8px;
        transition: background-color 0.3s, transform 0.3s;
        width: 200px; /* Adjust the width as needed */
        text-align: center;
    }
    .de-li a {
        display: block; /* Make the link fill the entire li */
        padding: 15px; /* Add padding to create a button effect */
        text-decoration: none;
        color: white;
        font-weight: bold;
        border-radius: 8px; /* Match the li border radius */
        transition: background-color 0.3s; /* Transition for the background */
    }
    .de-li:hover {
        transform: scale(1.05);
    }
    .subject-english { background-color: #3498db; }
    .subject-urdu { background-color: #e74c3c; }
    .subject-math { background-color: #f1c40f; }
    .subject-quran { background-color: #2ecc71; }
    .subject-isl { background-color: #9b59b6; }
    .subject-pak { background-color: #e67e22; }
    .subject-physic { background-color: #1abc9c; }
    .subject-chemistry { background-color: #34495e; }
    .subject-biology { background-color: #8e44ad; }
    .subject-computer { background-color: #16a085; }
    .subject-general { background-color: #2980b9; }
    .subject-civics { background-color: #d35400; }
    .subject-history { background-color: #c0392b; }
    .subject-education { background-color: #f39c12; }
    
    /* Hover effect for links */
    .de-li a:hover {
        opacity: 0.9; /* Slight opacity change on hover */
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Syllabus MCQS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-md-12">
                <h1 class="syllabus-h"><b>Choose Subject</b></h1>
                <ul class="decoration">
                    <li class="de-li subject-english"><a class="style" href="English9th.php">English</a></li>
                    <li class="de-li subject-urdu"><a class="style" href="urdu9th.php">Urdu</a></li>
                    <li class="de-li subject-math"><a class="style" href="math9th.php">Mathematics</a></li>
                    <li class="de-li subject-quran"><a class="style" href="generalmath9th.php">General Math</a></li>
                    <li class="de-li subject-isl"><a class="style" href="islamiat9th.php">Islamiat</a></li>
                    <li class="de-li subject-pak"><a class="style" href="pak9th.php">Pak Study</a></li>
                    <li class="de-li subject-physic"><a class="style" href="physic9th.php">Physics</a></li>
                    <li class="de-li subject-chemistry"><a class="style" href="chemistry9th.php">Chemistry</a></li>
                    <li class="de-li subject-biology"><a class="style" href="biology9th.php">Biology</a></li>
                    <li class="de-li subject-computer"><a class="style" href="computer9th.php">Computer</a></li>
                    <li class="de-li subject-general"><a class="style" href="general9th.php">General Science</a></li>
                    <li class="de-li subject-civics"><a class="style" href="civics9th.php">Civics</a></li>
                    <li class="de-li subject-history"><a class="style" href="history9th.php">History</a></li>
                    <li class="de-li subject-education"><a class="style" href="education9th.php">Education</a></li>
                </ul>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>
