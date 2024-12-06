<?php require_once("includes/header.php"); ?>

<!-- ======= Sidebar ======= -->
<?php require_once("includes/sidebar.php"); ?>

<?php
// getting the client id
$client = escape($_SESSION['client_id']);
?>

<?php
// checking session for appropriate access
if ($level == 'accountant' || $level == 'super') {
} else {
  redirect("./");
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Mark Fee & Dues as paid</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active"><?php echo $_SESSION['school_name']; ?></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <?php if (isset($message)) { ?>
    <div class="row">
      <div class="col-xl-8">
        <div class="alert alert-danger">
          <?php echo $message; ?>
        </div>
      </div>
    </div>
  <?php } ?>

  <div class="row d-flex justify-content-start">
    <!-- for unpaid fees -->
    <div class="col-auto">
      <label for="search_student" class="col-form-label"><strong>For Unpaid fee <code>*</code></strong></label>
      <div class="input-group mb-2" style="position: relative;">
        <button type="submit" name="add_subject" id="button-addon1" class="btn btn-sm btn-secondary disabled">
          <i class="fas fa-search pro-header-icon ps-2 py-2"></i>
        </button>
        <input
          id="fee-input"
          name="nameRollno"
          type="text"
          size="20"
          class="form-control"
          onclick="feeStudents()"
          onkeyup=""
          placeholder="Name or Roll#"
          aria-label="By name"
          aria-describedby="button-addon1"
          value="<?php
                  if (isset($_POST['name'])) {
                    echo $_POST['name'];
                  }
                  ?>"
          required />
        <div class="dropdown-menu show" id="fee-menu" aria-labelledby="search-input" style="position: absolute; z-index: 1000; display: none;"></div>
      </div>
    </div>
    <!-- for dues -->
    <div class="col-auto">
      <label for="search_student" class="col-form-label"><strong>For Pending dues <code>*</code></strong></label>
      <div class="input-group mb-2" style="position: relative;">
        <button type="submit" name="add_subject" id="button-addon1" class="btn btn-sm btn-secondary disabled">
          <i class="fas fa-search pro-header-icon ps-2 py-2"></i>
        </button>
        <input
          id="dues-input"
          name="nameRollno"
          type="text"
          size="20"
          class="form-control"
          onclick="duesStudents()"
          onkeyup=""
          placeholder="Name or Roll#"
          aria-label="By name"
          aria-describedby="button-addon1"
          value="<?php
                  if (isset($_POST['name'])) {
                    echo $_POST['name'];
                  }
                  ?>"
          required />
        <div class="dropdown-menu show" id="dues-menu" aria-labelledby="search-input" style="position: absolute; z-index: 1000; display: none;"></div>
      </div>
    </div>
  </div>

  <div id="pop-up" style="display: none;"></div>

  <section class="section profile">
    <div class="row" id="show-fee">

    </div>
  </section>

</main><!-- End #main -->

<script>
  document.addEventListener("click", clearResults);
  // clear all results
  function clearResults() {
    document.getElementById('fee-menu').style.display = 'none';
    document.getElementById('dues-menu').style.display = 'none';
  }
</script>

<!-- ========== Javascript for this page ============ -->
<?php include_once("refactoring/process-fee-dues-js.php"); ?>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>