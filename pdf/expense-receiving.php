<?php
if (isset($_POST['one'])) {
    $query = "SELECT * FROM school_profile_ WHERE client_id='$client'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];
    $address = $row['address'];
    $contact = $row['contact'];
    $email = $row['email'];
    $pic = $row['image'];

    // <tr>
    // <th colspan='4' style='min-width:auto;'><h3>Total Expenses</h3></th>
    // </tr>

    $html = "<div style='clear:float;'><img style='float:left; margin: 10px; border-radius: 5%;' src='uploads/school-profile-uploads/$pic' height='155px' width='155px' alt='school-image'>";
    $html .= "<h1 style='padding-top: 10px;'>$name</h1><h5>$address</h5><h5>$contact</h5><h5>$email</h5></div><br><h2 style='clear:both;'>Expense and Receiving</h2>";

    // styles

    $html .= "
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            margin-top: 0px;
        }
        .table-container {
            width: 100%;
            margin: 0 auto;
        }
        table {
            width: 100%; 
            border-collapse: collapse;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
            white-space: normal;
        }
        th {
            background-color: #f0f0f0;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            table {
                width: 100%;
                font-size: 12px;
            }
        }
    </style>
    ";


    $html .= "<table border='1' style='border-collapse:collapse'>
<thead>
<tr>
<th style='min-width:200px;'>Date</th>
<th style='min-width:200px;'>Comment</th>
<th style='min-width:200px;'>Expense</th>
<th style='min-width:200px;'>Receiving</th>
</tr>
</thead>
<tbody>";
    if (empty($_POST['two']) || $_POST['one'] == $_POST['two']) {
        $date = escape($_POST['one']);
        // downloaded pdf name
        $pdf_name = "expense-receiving-" . $date . ".pdf";
        // fetching the admin id and adding the data
        $id = escape($_SESSION['login_id']);
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> generated expense/receiving sheet for date <strong>$date</strong>!";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_querys2 = mysqli_query($conn, $query);

        // fetching expense/receiving records
        $query = "SELECT * FROM expense_receiving WHERE date='$date' AND fk_client_id='$client'";
        $result = mysqli_query($conn, $query);

        $exp = 0;
        $rec = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $exp += (int) $row['expense'];
            $rec += (int) $row['receiving'];
            $comment = $row['comment'];
            $expense = $row['expense'];
            $date = $row['date'];
            $receiving = $row['receiving'];
            $html .= "<tr>
<td>$date</td>
<td>$comment</td>";
            if ($expense == 0) {
                $html .= "<td>---</td>";
            } else {
                $html .= "<td>Rs. $expense</td>";
            }
            if ($receiving == 0) {
                $html .= "<td>---</td>";
            } else {
                $html .= "<td>Rs. $receiving</td>";
            }
            $html .= "</tr>";
        }
    } else {
        $date = escape($_POST['one']);
        $date1 = escape($_POST['two']);
        // downloaded pdf name
        $pdf_name = "expense-receiving-from-" . $date . '-to-' . $date1 . ".pdf";

        // fetching the admin id and adding the data
        $id = escape($_SESSION['login_id']);
        $admin_name = escape($_SESSION['login_name']);
        $log = "Admin <strong>$admin_name</strong> generated expense/receiving sheet from <strong>$date</strong> to <strong>$date1</strong>!";
        $times = date('d/m/Y h:i a', time());
        $times = (string) $times;
        // adding activity into the logs
        $query = "INSERT INTO admin_logs(log_message, time, fk_client_id) VALUES('$log', '$times', '$client')";
        $pass_querys2 = mysqli_query($conn, $query);

        // fetching expense/receiving records
        $query = "SELECT * FROM expense_receiving WHERE date BETWEEN '$date' AND '$date1' AND fk_client_id='$client'";
        $result = mysqli_query($conn, $query);

        $exp = 0;
        $rec = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $exp += (int) $row['expense'];
            $rec += (int) $row['receiving'];
            $comment = $row['comment'];
            $expense = $row['expense'];
            $date = $row['date'];
            $receiving = $row['receiving'];
            $html .= "<tr>
    <td>$date</td>
    <td>$comment</td>";
            if ($expense == 0) {
                $html .= "<td>---</td>";
            } else {
                $html .= "<td>Rs. $expense</td>";
            }
            if ($receiving == 0) {
                $html .= "<td>---</td>";
            } else {
                $html .= "<td>Rs. $receiving</td>";
            }
            $html .= "</tr>";
        }
    }
    $sum = $rec - $exp;
    $html .= "
<tr>
<td colspan='2'>---</td>
<td>Rs. $exp</td>
<td>Rs. $rec</td>
</tr>
<tr>
<td colspan='2'>---</td>
<td colspan='2'><strong>Total: </strong>Rs. $sum</td>
</tr>";
    $html .= "</tbody>
          </table>
        </div>
        <br><br><br>
        <strong>Owner:</strong> <u>___________________</u>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <strong>Accountant:</strong> <u>___________________</u>
        <br><br><br>
        <strong>Dated:</strong> <u>___________________</u>
      </main>
    </body>
  </html>
";

    // <td><img src='./uploads/expense-uploads/$img' width='50px' height='50px' alt=''></td>
}
