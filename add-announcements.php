<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Daily expences and receiving</h1>
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li> -->
                <li class="breadcrumb-item active">My School system</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center ">Add Expenscss</h5>

                        <!-- Multi Columns Form -->
                        <form class="row g-3">
                        <div class="col-md-12">
                                <label for="inputCity" class="form-label">Date</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            <div class="col-md-12">
                                <label for="inputName5" class="form-label">Pay</label>
                                <input type="text" class="form-control" id="inputName5">
                            </div>
                            
                            <label for="inputName5" class="form-label">Description</label>
          <div class="col-md-12 quill-editor-full">
            <textarea name="" id="" rows="10"></textarea>
          </div>
                            <div class="col-md-6">
                                <label for="inputEmail5" class="form-label">Electricity</label>
                                <input type="email" class="form-control" id="inputEmail5">
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword5" class="form-label">Rent</label>
                                <input type="password" class="form-control" id="inputPassword5">
                            </div>
                            <div class="col-12">
                                <label for="inputAddress5" class="form-label">Furniture</label>
                                <input type="text" class="form-control" id="inputAddres5s" placeholder="">
                            </div>
                            <div class="col-12">
                                <label for="inputAddress2" class="form-label">construction</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="">
                            </div>
                            <div class="col-md-12">
                                <label for="inputCity" class="form-label">Other Expencess</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                           
                          
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>