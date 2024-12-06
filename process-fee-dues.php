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

<?php
// if get request is valid
// if (!isset($_GET['id'])) {
//     redirect("./fee-requests.php");
// }
?>

<?php
// $id = escape($_GET['id']);
// // rejected fees
// if (isset($_POST['rejected']) && !empty($_POST['rejection_reason'])) {
//     $id = escape($_POST['id']);
//     $rejection_reason = escape($_POST['rejection_reason']);
//     $q = "UPDATE student_fee SET fee_method='', payment_date='', fee_status='rejected', admin_remarks='$rejection_reason' ";
//     $q .= "WHERE fee_id=$id AND fk_client_id='$client'";
//     $result = query($q);
//     if ($result) {
//         $name = escape($_POST['student_name']);
//         // fetching the admin id and adding the data
//         $admin_name = escape($_SESSION['login_name']);
//         $log = "Admin <strong>$admin_name</strong> rejected fees of student <strong>$name</strong>!";
//         $times = date('d/m/Y h:i a', time());
//         $times = (string) $times;
//         // adding activity into the logs
//         $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
//         $pass_query2 = mysqli_query($conn, $query);

//         redirect("./fee-requests.php");
//     }
// } elseif (isset($_POST['rejected']) && empty($_POST['rejection_reason'])) {
//     $message = "Please add fee rejection reason!";
// }

// // fee with dues
// if (isset($_POST['due']) && !empty($_POST['dues'])) {
//     $id = escape($_POST['id']);
//     $dues = escape($_POST['dues']);
//     $q2 = "UPDATE student_fee SET fee_status='dues', pending_dues='$dues', admin_remarks='' ";
//     $q2 .= "WHERE fee_id='$id' AND fk_client_id='$client'";
//     $rs1 = query($q2);
//     if ($rs1) {
//         $name = escape($_POST['student_name']);
//         // fetching the admin id and adding the data
//         $admin_name = escape($_SESSION['login_name']);
//         $log = "Admin <strong>$admin_name</strong> accepted fees of student <strong>$name</strong> as paid with some remaining dues!";
//         $times = date('d/m/Y h:i a', time());
//         $times = (string) $times;
//         // adding activity into the logs
//         $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
//         $pass_query2 = mysqli_query($conn, $query);


//         // addin the receivings
//         $date = date('Y-m-d', time());
//         $name = escape($_POST['student_name']);
//         $reg = escape($_POST['roll_no']);
//         $fee = escape($_POST['monthly_fee']);
//         $paid = (int) $fee - (int) $dues;
//         $comment = "Student $name, reg# $reg paid fee amount Rs.$paid with remaining dues Rs.$dues (Monthly Fee)";
//         $qer = "INSERT INTO expense_receiving (comment, expense, receiving, date, fk_client_id) ";
//         $qer .= "VALUES ('$comment', '0', '$paid', '$date', '$client')";
//         $res = query($qer);
//         if ($res) {
//             redirect("./fee-requests.php");
//         }
//     }
// } elseif (isset($_POST['due']) && empty($_POST['dues'])) {
//     $message = "Please add the remaining dues of the student!";
// }

// // the fee is totally paid
// if (isset($_POST['paid'])) {
//     $id = escape($_POST['id']);
//     $q2 = "UPDATE student_fee SET fee_status='paid' ";
//     $q2 .= "WHERE fee_id='$id' AND fk_client_id='$client'";
//     $rs1 = query($q2);
//     if ($rs1) {
//         $name = escape($_POST['student_name']);
//         // fetching the admin id and adding the data
//         $admin_name = escape($_SESSION['login_name']);
//         $log = "Admin <strong>$admin_name</strong> accepted fees of student <strong>$name</strong> as totally paid!";
//         $times = date('d/m/Y h:i a', time());
//         $times = (string) $times;
//         // adding activity into the logs
//         $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
//         $pass_query2 = mysqli_query($conn, $query);


//         // adding the receivings
//         $date = date('Y-m-d', time());
//         $name = escape($_POST['student_name']);
//         $reg = escape($_POST['roll_no']);
//         $fee = escape($_POST['monthly_fee']);
//         $comment = "Student $name, reg# $reg paid full fee amount Rs.$fee (Monthly Fee)";
//         $qer = "INSERT INTO expense_receiving (comment, expense, receiving, date, fk_client_id) ";
//         $qer .= "VALUES ('$comment', '0', '$fee', '$date', '$client')";
//         $res = query($qer);
//         if ($res) {
//             redirect("./fee-requests.php");
//         }
//     }
// }
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
      <!-- <div class="col-xl-12" id="fee-tab">
        <div class="card">
          <div class="card-body pt-3">
            
            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Student Fee</button>
              </li>
            </ul>

            <div class="tab-content pt-2">
              <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                <div class="table-responsive">
                  <table class="table table-bordered border-primary">
                    <thead>
                      <tr>
                        <th scope="col">Reg no#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Monthly Fee</th>
                        <th scope="col">Funds</th>
                        <th scope="col">Total Fee</th>
                        <th scope="col">Month</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr id="fee-t-row">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">
                          <span class="d-inline-block"
                            tabindex="0"
                            data-bs-toggle="tooltip"
                            title="">
                            <button type="button" class="btn btn-sm btn-outline-dark"><i class="fa-solid fa-question"></i></button>
                          </span>

                        </td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="" id="">
                  <input type="hidden" name="student_id" value="" id="">
                  <input type="hidden" name="student_name" value="" id="">
                  <input type="hidden" name="roll_no" value="" id="">
                  <input type="hidden" name="monthly_fee" value="" id="">
                  <input type="hidden" name="year" value="" id="">
                  <input type="hidden" name="month" value="" id="">
                  <div class="row mb-3">
                    <div class="col-md-8 col-lg-9 mt-2">
                      <input name="dues" type="text" class="form-control" value="" placeholder="Remaining dues (if fees is not full paid)">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" name="paid" class="btn btn-sm btn-success">Full Paid</button>
                    <button type="submit" name="due" class="btn btn-sm btn-primary">Add dues</button>
                  </div>
                </form>

              </div>

            </div>

          </div>
        </div>

      </div> -->
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

  // process the unpaid fees of the student
  let fee = document.getElementById('fee-input');
  fee.addEventListener('keyup', function() {
    let search = fee.value.trim();
    var input = 'fee-input';
    var dropdown = 'fee-menu';
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './backend/search-process-fee-dues.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        try {
          var response = JSON.parse(xhr.responseText);
          var resultsDiv = document.getElementById(dropdown);
          resultsDiv.innerHTML = ''; // Clear previous results
          // console.log(response);
          if (response.length > 0) {
            // Show and style the results div
            resultsDiv.style.display = 'block';
            resultsDiv.style.maxHeight = '200px';
            resultsDiv.style.overflowY = 'scroll';
            resultsDiv.style.cursor = 'pointer';
            resultsDiv.style.position = "absolute";
            resultsDiv.style.top = "100%";
            resultsDiv.style.width = "100%";

            // Loop through each result
            response.forEach(function(item) {
              var resultItem = document.createElement('div');
              // Bootstrap styling for each item
              resultItem.classList.add('dropdown-item');

              // Create element
              var name = document.createElement('span');
              name.textContent = item.name + ' - roll#' + item.roll_no;
              name.style.display = 'block';
              resultItem.appendChild(name);

              // Add the result item to the results div
              resultsDiv.appendChild(resultItem);

              // Add onclick event for each result item
              resultItem.onclick = function() {
                var rollNo = item.roll_no;
                var xhr = new XMLHttpRequest();
                xhr.open('POST', './backend/search-process-fee-dues.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                  if (xhr.readyState === 4 && xhr.status === 200) {
                    try {
                      var response = JSON.parse(xhr.responseText);
                      // console.log(response);
                      if (Object.keys(response).length > 0) {
                        var the_div = document.getElementById('show-fee');
                        the_div.innerHTML = "";
                        // console.log(Object.keys(response));
                        // console.log('ksj');
                        //                       Object.keys(response).forEach(function(main_id) {
                        //   var item = response[main_id];
                        //   console.log(item); // Log each item to confirm it contains the expected data
                        //   // Proceed with creating feeTab here
                        // });
                        // Loop through each result
                        Object.keys(response).forEach(function(main_id) {
                          var item = response[main_id];

                          const feeTab = document.createElement('div');
                          feeTab.className = 'col-xl-8';
                          feeTab.id = '' + item.main_data.fee_id + '';

                          const card = document.createElement('div');
                          card.className = 'card';

                          const cardBody = document.createElement('div');
                          cardBody.className = 'card-body pt-3';

                          // Bordered Tabs
                          const navTabs = document.createElement('ul');
                          navTabs.className = 'nav nav-tabs nav-tabs-bordered';

                          const navItem = document.createElement('li');
                          navItem.className = 'nav-item';

                          const navLink = document.createElement('button');
                          navLink.className = 'nav-link active';
                          navLink.setAttribute('data-bs-toggle', 'tab');
                          navLink.setAttribute('data-bs-target', '#profile-edit');
                          navLink.textContent = 'Student Fee';

                          navItem.appendChild(navLink);
                          navTabs.appendChild(navItem);

                          // Tab Content
                          const tabContent = document.createElement('div');
                          tabContent.className = 'tab-content pt-2';

                          const tabPane = document.createElement('div');
                          tabPane.className = 'tab-pane fade show active profile-edit pt-3';
                          tabPane.id = 'profile-edit';

                          // Table
                          const tableContainer = document.createElement('div');
                          tableContainer.className = 'table-responsive';

                          const table = document.createElement('table');
                          table.className = 'table table-bordered border-primary';

                          const thead = document.createElement('thead');
                          const headerRow = document.createElement('tr');
                          ['Reg no#', 'Name', 'Monthly Fee', 'Funds', 'Total Fee', 'Month'].forEach(text => {
                            const th = document.createElement('th');
                            th.scope = 'col';
                            th.textContent = text;
                            headerRow.appendChild(th);
                          });
                          thead.appendChild(headerRow);

                          const tbody = document.createElement('tbody');
                          const tableRow = document.createElement('tr');
                          tableRow.id = 'fee-t-row';

                          let arr = [item.main_data.roll_no, item.main_data.name, item.main_data.monthly_fee, item.main_data.name, item.main_data.total_fee, item.main_data.month + ', ' + item.main_data.year];
                          for (let i = 0; i < 6; i++) {
                            const td = document.createElement('td');
                            if (i === 3) {
                              td.className = 'text-center';
                              const span = document.createElement('span');
                              span.className = 'd-inline-block text-center';
                              span.setAttribute('tabindex', '0');
                              span.setAttribute('data-bs-toggle', 'tooltip');
                              if (!item.funds) {
                                span.setAttribute('title', '---');
                              } else {
                                span.setAttribute('title', item.funds);
                              }

                              const button = document.createElement('button');
                              button.type = 'button';
                              button.className = 'btn btn-sm btn-outline-dark';
                              const icon = document.createElement('i');
                              icon.className = 'fas fa-question pro-header-icon ms-2';
                              button.appendChild(icon);
                              span.appendChild(button);
                              td.appendChild(span);
                            } else {
                              td.innerText = arr[i];
                            }
                            tableRow.appendChild(td);
                          }
                          tbody.appendChild(tableRow);

                          table.appendChild(thead);
                          table.appendChild(tbody);
                          tableContainer.appendChild(table);

                          // Form
                          const form = document.createElement('div');
                          // form.method = 'post';
                          // form.action = '';
                          // form.enctype = 'multipart/form-data';

                          // var arr1 = [item.main_data.fee_id, item.main_data.student_id, item.main_data.name, item.main_data.roll_no, item.main_data.monthly_fee, item.main_data.year, item.main_data.month];
                          // var counter = 0;
                          // ['id', 'student_id', 'student_name', 'roll_no', 'monthly_fee', 'year', 'month'].forEach(name => {
                          //   const input = document.createElement('input');
                          //   input.id = name + item.main_data.fee_id + '';
                          //   input.type = 'hidden';
                          //   input.name = name;
                          //   // input.value = arr1[counter];
                          //   form.appendChild(input);
                          //   counter++;
                          // });

                          const formRow = document.createElement('div');
                          formRow.className = 'row mb-3';

                          const col = document.createElement('div');
                          col.className = 'col-md-8 col-lg-9 mt-2';

                          const duesInput = document.createElement('input');
                          duesInput.name = 'dues';
                          duesInput.type = 'text';
                          duesInput.id = "reason" + item.main_data.fee_id + '';
                          duesInput.className = 'form-control';
                          duesInput.placeholder = 'Remaining dues (if fees is not full paid)';
                          col.appendChild(duesInput);
                          formRow.appendChild(col);

                          form.appendChild(formRow);

                          const buttonsContainer = document.createElement('div');
                          buttonsContainer.className = 'text-center';

                          ['Full Paid', 'Add dues'].forEach((text, index) => {
                            const button = document.createElement('button');
                            button.type = 'submit';
                            button.name = index === 0 ? 'paid' : 'due';
                            button.className = `btn btn-sm ${index === 0 ? 'btn-success' : 'btn-primary'} ms-1`;
                            button.textContent = text;
                            // Add onclick event to the button
                            button.onclick = function() {
                              // console.log(`${text} button clicked`);
                              if (text === 'Full Paid') {
                                var the_fee_id = item.main_data.fee_id;
                                var fee_id = the_fee_id;
                                var student_id = item.main_data.student_id;
                                var name = item.main_data.name;
                                var roll_no = item.main_data.roll_no;
                                var total_fee = item.main_data.total_fee;
                                var year = item.main_data.year;
                                var month = item.main_data.month;

                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', './backend/search-process-fee-dues.php', true);
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xhr.onreadystatechange = function() {
                                  if (xhr.readyState === 4 && xhr.status === 200) {
                                    try {
                                      var response = JSON.parse(xhr.responseText);
                                      // console.log(response);
                                      if (response.length > 0) {
                                        // Loop through each result
                                        response.forEach(function(data) {
                                          if (data.message.includes('paid')) {
                                            document.getElementById(item.main_data.fee_id).style.display = "none";
                                            var popup = document.getElementById('pop-up');
                                            popup.innerText = "";
                                            popup.style.display = 'block';
                                            popup.style.position = 'fixed';
                                            popup.style.top = '15%';
                                            popup.style.right = '30%';
                                            popup.style.backgroundColor = '#d4edda';
                                            popup.style.color = '#155724';
                                            popup.style.padding = '10px';
                                            popup.style.borderRadius = '5px';
                                            popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                            popup.style.zIndex = '9999';
                                            popup.innerText = data.message;

                                            // Hide the popup after 3 seconds
                                            setTimeout(function() {
                                              popup.style.display = 'none';
                                            }, 3000);
                                          } else if (data.message.includes('error')) {
                                            var popup = document.getElementById('pop-up');
                                            popup.innerText = "";
                                            popup.style.display = 'block';
                                            popup.style.position = 'fixed';
                                            popup.style.top = '15%';
                                            popup.style.right = '30%';
                                            popup.style.backgroundColor = '#f8d7da';
                                            popup.style.color = '#721c24';
                                            popup.style.padding = '10px';
                                            popup.style.borderRadius = '5px';
                                            popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                            popup.style.zIndex = '9999';
                                            popup.innerText = data.message;

                                            // Hide the popup after 3 seconds
                                            setTimeout(function() {
                                              popup.style.display = 'none';
                                            }, 3000);
                                          }
                                        });
                                      }
                                    } catch (e) {
                                      console.error('Error parsing JSON:', e);
                                      console.error('Response text:', xhr.responseText);
                                    }
                                  }
                                };
                                xhr.send('all_fee_clear=done&fee_id=' + encodeURIComponent(fee_id) + '&student_id=' + encodeURIComponent(student_id) + '&name=' + encodeURIComponent(name) + '&roll_no=' + encodeURIComponent(roll_no) + '&total_fee=' + encodeURIComponent(total_fee) + '&year=' + encodeURIComponent(year) + '&month=' + encodeURIComponent(month));

                              } else if (text === 'Add dues') {
                                const duesInput = document.getElementById('reason' + item.main_data.fee_id);
                                if (duesInput && duesInput.value.trim() == '') {
                                  var popup = document.getElementById('pop-up');
                                  popup.innerText = "";
                                  popup.style.display = 'block';
                                  popup.style.position = 'fixed';
                                  popup.style.top = '15%';
                                  popup.style.right = '30%';
                                  popup.style.backgroundColor = '#f8d7da';
                                  popup.style.color = '#721c24';
                                  popup.style.padding = '10px';
                                  popup.style.borderRadius = '5px';
                                  popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                  popup.style.zIndex = '9999';
                                  popup.innerText = 'Add the amount of remaining dues!';

                                  // Hide the popup after 3 seconds
                                  setTimeout(function() {
                                    popup.style.display = 'none';
                                  }, 3000);
                                } else {
                                  var dues = duesInput.value.trim();
                                  var the_fee_id = item.main_data.fee_id;
                                  var fee_id = the_fee_id;
                                  var student_id = item.main_data.student_id;
                                  var name = item.main_data.name;
                                  var roll_no = item.main_data.roll_no;
                                  var total_fee = item.main_data.total_fee;
                                  var year = item.main_data.year;
                                  var month = item.main_data.month;

                                  var xhr = new XMLHttpRequest();
                                  xhr.open('POST', './backend/search-process-fee-dues.php', true);
                                  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                  xhr.onreadystatechange = function() {
                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                      try {
                                        var response = JSON.parse(xhr.responseText);
                                        // console.log(response);
                                        if (response.length > 0) {
                                          // Loop through each result
                                          response.forEach(function(data) {
                                            if (data.message.includes('paid')) {
                                              document.getElementById(item.main_data.fee_id).style.display = "none";
                                              var popup = document.getElementById('pop-up');
                                              popup.innerText = "";
                                              popup.style.display = 'block';
                                              popup.style.position = 'fixed';
                                              popup.style.top = '15%';
                                              popup.style.right = '30%';
                                              popup.style.backgroundColor = '#d4edda';
                                              popup.style.color = '#155724';
                                              popup.style.padding = '10px';
                                              popup.style.borderRadius = '5px';
                                              popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                              popup.style.zIndex = '9999';
                                              popup.innerText = data.message;

                                              // Hide the popup after 3 seconds
                                              setTimeout(function() {
                                                popup.style.display = 'none';
                                              }, 3000);
                                            } else if (data.message.includes('error')) {
                                              var popup = document.getElementById('pop-up');
                                              popup.innerText = "";
                                              popup.style.display = 'block';
                                              popup.style.position = 'fixed';
                                              popup.style.top = '15%';
                                              popup.style.right = '30%';
                                              popup.style.backgroundColor = '#f8d7da';
                                              popup.style.color = '#721c24';
                                              popup.style.padding = '10px';
                                              popup.style.borderRadius = '5px';
                                              popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                              popup.style.zIndex = '9999';
                                              popup.innerText = data.message;

                                              // Hide the popup after 3 seconds
                                              setTimeout(function() {
                                                popup.style.display = 'none';
                                              }, 3000);
                                            }
                                          });
                                        }
                                      } catch (e) {
                                        console.error('Error parsing JSON:', e);
                                        console.error('Response text:', xhr.responseText);
                                      }
                                    }
                                  };
                                  xhr.send('fee_clear_dues=done&fee_id=' + encodeURIComponent(fee_id) + '&student_id=' + encodeURIComponent(student_id) + '&name=' + encodeURIComponent(name) + '&roll_no=' + encodeURIComponent(roll_no) + '&total_fee=' + encodeURIComponent(total_fee) + '&year=' + encodeURIComponent(year) + '&month=' + encodeURIComponent(month) + '&dues=' + encodeURIComponent(dues));
                                }
                              }
                            };
                            buttonsContainer.appendChild(button);
                          });

                          form.appendChild(buttonsContainer);

                          // Assemble structure
                          tabPane.appendChild(tableContainer);
                          tabPane.appendChild(form);
                          tabContent.appendChild(tabPane);

                          cardBody.appendChild(navTabs);
                          cardBody.appendChild(tabContent);

                          card.appendChild(cardBody);
                          feeTab.appendChild(card);
                          //   console.log(feeTab);
                          document.getElementById('show-fee').appendChild(feeTab);
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
                xhr.send('unpaidFee=' + encodeURIComponent(rollNo));
              };
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
    xhr.send('searchFee=' + encodeURIComponent(search));
  });

  let dues = document.getElementById('dues-input');
  dues.addEventListener('keyup', function() {
    let search = dues.value.trim();
    var input = 'dues-input';
    var dropdown = 'dues-menu';
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './backend/search-process-fee-dues.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        try {
          var response = JSON.parse(xhr.responseText);
          var resultsDiv = document.getElementById(dropdown);
          resultsDiv.innerHTML = ''; // Clear previous results
          // console.log(response);
          if (response.length > 0) {
            // Show and style the results div
            resultsDiv.style.display = 'block';
            resultsDiv.style.maxHeight = '200px';
            resultsDiv.style.overflowY = 'scroll';
            resultsDiv.style.cursor = 'pointer';
            resultsDiv.style.position = "absolute";
            resultsDiv.style.top = "100%";
            resultsDiv.style.width = "100%";

            // Loop through each result
            response.forEach(function(item) {
              var resultItem = document.createElement('div');
              // Bootstrap styling for each item
              resultItem.classList.add('dropdown-item');

              // Create element
              var name = document.createElement('span');
              name.textContent = item.name + ' - roll#' + item.roll_no;
              name.style.display = 'block';
              resultItem.appendChild(name);

              // Add the result item to the results div
              resultsDiv.appendChild(resultItem);

              // Add onclick event for each result item
              //   resultItem.onclick = function() {
              //     document.getElementById(teacherName).value = item.name;
              //     document.getElementById(teacherId).value = item.id;
              //   };
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
    xhr.send('searchDues=' + encodeURIComponent(search));
  });

  // code to get all the teachers of the school on click
  function feeStudents() {
    var input = 'fee-input';
    var dropdown = 'fee-menu';

    var xhr = new XMLHttpRequest();
    xhr.open('POST', './backend/search-process-fee-dues.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        try {
          var response = JSON.parse(xhr.responseText);
          var resultsDiv = document.getElementById(dropdown);
          resultsDiv.innerHTML = '';
          // console.log(response);
          if (response.length > 0) {
            // Show and style the results div
            resultsDiv.style.display = 'block';
            resultsDiv.style.maxHeight = '200px';
            resultsDiv.style.overflowY = 'scroll';
            resultsDiv.style.cursor = 'pointer';
            resultsDiv.style.position = "absolute";
            resultsDiv.style.top = "100%";
            resultsDiv.style.width = "100%";

            // Loop through each result
            response.forEach(function(item) {
              var resultItem = document.createElement('div');
              // Bootstrap styling for each item
              resultItem.classList.add('dropdown-item');

              // Create element
              var name = document.createElement('span');
              name.textContent = item.name + ' - roll#' + item.roll_no;
              name.style.display = 'block';
              resultItem.appendChild(name);

              // Add the result item to the results div
              resultsDiv.appendChild(resultItem);

              // Add onclick event for each result item
              resultItem.onclick = function() {
                var rollNo = item.roll_no;
                var xhr = new XMLHttpRequest();
                xhr.open('POST', './backend/search-process-fee-dues.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                  if (xhr.readyState === 4 && xhr.status === 200) {
                    try {
                      var response = JSON.parse(xhr.responseText);
                      // console.log(response);
                      if (Object.keys(response).length > 0) {
                        var the_div = document.getElementById('show-fee');
                        the_div.innerHTML = "";

                        // Loop through each result
                        Object.keys(response).forEach(function(main_id) {
                          var item = response[main_id];

                          const feeTab = document.createElement('div');
                          feeTab.className = 'col-xl-8';
                          feeTab.id = '' + item.main_data.fee_id + '';

                          const card = document.createElement('div');
                          card.className = 'card';

                          const cardBody = document.createElement('div');
                          cardBody.className = 'card-body pt-3';

                          // Bordered Tabs
                          const navTabs = document.createElement('ul');
                          navTabs.className = 'nav nav-tabs nav-tabs-bordered';

                          const navItem = document.createElement('li');
                          navItem.className = 'nav-item';

                          const navLink = document.createElement('button');
                          navLink.className = 'nav-link active';
                          navLink.setAttribute('data-bs-toggle', 'tab');
                          navLink.setAttribute('data-bs-target', '#profile-edit');
                          navLink.textContent = 'Student Fee';

                          navItem.appendChild(navLink);
                          navTabs.appendChild(navItem);

                          // Tab Content
                          const tabContent = document.createElement('div');
                          tabContent.className = 'tab-content pt-2';

                          const tabPane = document.createElement('div');
                          tabPane.className = 'tab-pane fade show active profile-edit pt-3';
                          tabPane.id = 'profile-edit';

                          // Table
                          const tableContainer = document.createElement('div');
                          tableContainer.className = 'table-responsive';

                          const table = document.createElement('table');
                          table.className = 'table table-bordered border-primary';

                          const thead = document.createElement('thead');
                          const headerRow = document.createElement('tr');
                          ['Reg no#', 'Name', 'Monthly Fee', 'Funds', 'Total Fee', 'Month'].forEach(text => {
                            const th = document.createElement('th');
                            th.scope = 'col';
                            th.textContent = text;
                            headerRow.appendChild(th);
                          });
                          thead.appendChild(headerRow);

                          const tbody = document.createElement('tbody');
                          const tableRow = document.createElement('tr');
                          tableRow.id = 'fee-t-row';

                          let arr = [item.main_data.roll_no, item.main_data.name, item.main_data.monthly_fee, item.main_data.name, item.main_data.total_fee, item.main_data.month + ', ' + item.main_data.year];
                          for (let i = 0; i < 6; i++) {
                            const td = document.createElement('td');
                            if (i === 3) {
                              td.className = 'text-center';
                              const span = document.createElement('span');
                              span.className = 'd-inline-block text-center';
                              span.setAttribute('tabindex', '0');
                              span.setAttribute('data-bs-toggle', 'tooltip');
                              if (!item.funds) {
                                span.setAttribute('title', '---');
                              } else {
                                span.setAttribute('title', item.funds);
                              }

                              const button = document.createElement('button');
                              button.type = 'button';
                              button.className = 'btn btn-sm btn-outline-dark';
                              const icon = document.createElement('i');
                              icon.className = 'fas fa-question pro-header-icon ms-2';
                              button.appendChild(icon);
                              span.appendChild(button);
                              td.appendChild(span);
                            } else {
                              td.innerText = arr[i];
                            }
                            tableRow.appendChild(td);
                          }
                          tbody.appendChild(tableRow);

                          table.appendChild(thead);
                          table.appendChild(tbody);
                          tableContainer.appendChild(table);

                          // Form
                          const form = document.createElement('div');

                          const formRow = document.createElement('div');
                          formRow.className = 'row mb-3';

                          const col = document.createElement('div');
                          col.className = 'col-md-8 col-lg-9 mt-2';

                          const duesInput = document.createElement('input');
                          duesInput.name = 'dues';
                          duesInput.type = 'text';
                          duesInput.id = "reason" + item.main_data.fee_id + '';
                          duesInput.className = 'form-control';
                          duesInput.placeholder = 'Remaining dues (if fees is not full paid)';
                          col.appendChild(duesInput);
                          formRow.appendChild(col);

                          form.appendChild(formRow);

                          const buttonsContainer = document.createElement('div');
                          buttonsContainer.className = 'text-center';

                          ['Full Paid', 'Add dues'].forEach((text, index) => {
                            const button = document.createElement('button');
                            button.type = 'submit';
                            button.name = index === 0 ? 'paid' : 'due';
                            button.className = `btn btn-sm ${index === 0 ? 'btn-success' : 'btn-primary'} ms-1`;
                            button.textContent = text;
                            // Add onclick event to the button
                            button.onclick = function() {
                              // console.log(`${text} button clicked`);
                              if (text === 'Full Paid') {
                                var the_fee_id = item.main_data.fee_id;
                                var fee_id = the_fee_id;
                                var student_id = item.main_data.student_id;
                                var name = item.main_data.name;
                                var roll_no = item.main_data.roll_no;
                                var total_fee = item.main_data.total_fee;
                                var year = item.main_data.year;
                                var month = item.main_data.month;

                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', './backend/search-process-fee-dues.php', true);
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xhr.onreadystatechange = function() {
                                  if (xhr.readyState === 4 && xhr.status === 200) {
                                    try {
                                      var response = JSON.parse(xhr.responseText);
                                      // console.log(response);
                                      if (response.length > 0) {
                                        // Loop through each result
                                        response.forEach(function(data) {
                                          if (data.message.includes('paid')) {
                                            document.getElementById(item.main_data.fee_id).style.display = "none";
                                            var popup = document.getElementById('pop-up');
                                            popup.innerText = "";
                                            popup.style.display = 'block';
                                            popup.style.position = 'fixed';
                                            popup.style.top = '15%';
                                            popup.style.right = '30%';
                                            popup.style.backgroundColor = '#d4edda';
                                            popup.style.color = '#155724';
                                            popup.style.padding = '10px';
                                            popup.style.borderRadius = '5px';
                                            popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                            popup.style.zIndex = '9999';
                                            popup.innerText = data.message;

                                            // Hide the popup after 3 seconds
                                            setTimeout(function() {
                                              popup.style.display = 'none';
                                            }, 3000);
                                          } else if (data.message.includes('error')) {
                                            var popup = document.getElementById('pop-up');
                                            popup.innerText = "";
                                            popup.style.display = 'block';
                                            popup.style.position = 'fixed';
                                            popup.style.top = '15%';
                                            popup.style.right = '30%';
                                            popup.style.backgroundColor = '#f8d7da';
                                            popup.style.color = '#721c24';
                                            popup.style.padding = '10px';
                                            popup.style.borderRadius = '5px';
                                            popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                            popup.style.zIndex = '9999';
                                            popup.innerText = data.message;

                                            // Hide the popup after 3 seconds
                                            setTimeout(function() {
                                              popup.style.display = 'none';
                                            }, 3000);
                                          }
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
                                xhr.send('all_fee_clear=done&fee_id=' + encodeURIComponent(fee_id) + '&student_id=' + encodeURIComponent(student_id) + '&name=' + encodeURIComponent(name) + '&roll_no=' + encodeURIComponent(roll_no) + '&total_fee=' + encodeURIComponent(total_fee) + '&year=' + encodeURIComponent(year) + '&month=' + encodeURIComponent(month));

                              } else if (text === 'Add dues') {
                                const duesInput = document.getElementById('reason' + item.main_data.fee_id);
                                if (duesInput && duesInput.value.trim() == '') {
                                  var popup = document.getElementById('pop-up');
                                  popup.innerText = "";
                                  popup.style.display = 'block';
                                  popup.style.position = 'fixed';
                                  popup.style.top = '15%';
                                  popup.style.right = '30%';
                                  popup.style.backgroundColor = '#f8d7da';
                                  popup.style.color = '#721c24';
                                  popup.style.padding = '10px';
                                  popup.style.borderRadius = '5px';
                                  popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                  popup.style.zIndex = '9999';
                                  popup.innerText = 'Add the amount of remaining dues!';

                                  // Hide the popup after 3 seconds
                                  setTimeout(function() {
                                    popup.style.display = 'none';
                                  }, 3000);
                                } else {
                                  var dues = duesInput.value.trim();
                                  var the_fee_id = item.main_data.fee_id;
                                  var fee_id = the_fee_id;
                                  var student_id = item.main_data.student_id;
                                  var name = item.main_data.name;
                                  var roll_no = item.main_data.roll_no;
                                  var total_fee = item.main_data.total_fee;
                                  var year = item.main_data.year;
                                  var month = item.main_data.month;

                                  var xhr = new XMLHttpRequest();
                                  xhr.open('POST', './backend/search-process-fee-dues.php', true);
                                  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                  xhr.onreadystatechange = function() {
                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                      try {
                                        var response = JSON.parse(xhr.responseText);
                                        // console.log(response);
                                        if (response.length > 0) {
                                          // Loop through each result
                                          response.forEach(function(data) {
                                            if (data.message.includes('paid')) {
                                              document.getElementById(item.main_data.fee_id).style.display = "none";
                                              var popup = document.getElementById('pop-up');
                                              popup.innerText = "";
                                              popup.style.display = 'block';
                                              popup.style.position = 'fixed';
                                              popup.style.top = '15%';
                                              popup.style.right = '30%';
                                              popup.style.backgroundColor = '#d4edda';
                                              popup.style.color = '#155724';
                                              popup.style.padding = '10px';
                                              popup.style.borderRadius = '5px';
                                              popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                              popup.style.zIndex = '9999';
                                              popup.innerText = data.message;

                                              // Hide the popup after 3 seconds
                                              setTimeout(function() {
                                                popup.style.display = 'none';
                                              }, 3000);
                                            } else if (data.message.includes('error')) {
                                              var popup = document.getElementById('pop-up');
                                              popup.innerText = "";
                                              popup.style.display = 'block';
                                              popup.style.position = 'fixed';
                                              popup.style.top = '15%';
                                              popup.style.right = '30%';
                                              popup.style.backgroundColor = '#f8d7da';
                                              popup.style.color = '#721c24';
                                              popup.style.padding = '10px';
                                              popup.style.borderRadius = '5px';
                                              popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                                              popup.style.zIndex = '9999';
                                              popup.innerText = data.message;

                                              // Hide the popup after 3 seconds
                                              setTimeout(function() {
                                                popup.style.display = 'none';
                                              }, 3000);
                                            }
                                          });
                                        }
                                      } catch (e) {
                                        console.error('Error parsing JSON:', e);
                                        console.error('Response text:', xhr.responseText);
                                      }
                                    }
                                  };
                                  xhr.send('fee_clear_dues=done&fee_id=' + encodeURIComponent(fee_id) + '&student_id=' + encodeURIComponent(student_id) + '&name=' + encodeURIComponent(name) + '&roll_no=' + encodeURIComponent(roll_no) + '&total_fee=' + encodeURIComponent(total_fee) + '&year=' + encodeURIComponent(year) + '&month=' + encodeURIComponent(month) + '&dues=' + encodeURIComponent(dues));
                                }
                              }
                            };
                            buttonsContainer.appendChild(button);
                          });

                          form.appendChild(buttonsContainer);

                          // Assemble structure
                          tabPane.appendChild(tableContainer);
                          tabPane.appendChild(form);
                          tabContent.appendChild(tabPane);

                          cardBody.appendChild(navTabs);
                          cardBody.appendChild(tabContent);

                          card.appendChild(cardBody);
                          feeTab.appendChild(card);
                          //   console.log(feeTab);
                          document.getElementById('show-fee').appendChild(feeTab);
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
                xhr.send('unpaidFee=' + encodeURIComponent(rollNo));
              };
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
    xhr.send('allQueryF=' + encodeURIComponent('1'));
  }

  // code to get all the teachers of the school
  function duesStudents() {
    var input = 'dues-input';
    var dropdown = 'dues-menu';
    // var searchQuery = document.getElementById(teacherName).value.trim();
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './backend/search-process-fee-dues.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        try {
          var response = JSON.parse(xhr.responseText);
          var resultsDiv = document.getElementById(dropdown);
          resultsDiv.innerHTML = ''; // Clear previous results
          // console.log(response);
          if (response.length > 0) {
            // Show and style the results div
            resultsDiv.style.display = 'block';
            resultsDiv.style.maxHeight = '200px';
            resultsDiv.style.overflowY = 'scroll';
            resultsDiv.style.cursor = 'pointer';
            resultsDiv.style.position = "absolute";
            resultsDiv.style.top = "100%";
            resultsDiv.style.width = "100%";

            // Loop through each result
            response.forEach(function(item) {
              var resultItem = document.createElement('div');
              // Bootstrap styling for each item
              resultItem.classList.add('dropdown-item');

              // Create element
              var name = document.createElement('span');
              name.textContent = item.name + ' - roll#' + item.roll_no;
              name.style.display = 'block';
              resultItem.appendChild(name);

              // Add the result item to the results div
              resultsDiv.appendChild(resultItem);

              // Add onclick event for each result item
              //   resultItem.onclick = function() {
              //     document.getElementById(teacherName).value = item.name;
              //     document.getElementById(teacherId).value = item.id;
              //   };
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
    xhr.send('allQueryD=' + encodeURIComponent('1'));
  }
</script>

<!-- ======= Footer ======= -->
<?php include_once("includes/footer.php"); ?>