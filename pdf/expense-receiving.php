<?php
if (isset($_POST['one'])) {
    $query = "SELECT * FROM school_profile_ ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];
    $address = $row['address'];
    $contact = $row['contact'];
    $email = $row['email'];

    // <tr>
    // <th colspan='4' style='min-width:auto;'><h3>Total Expenses</h3></th>
    // </tr>

    $html = "<div style='clear:float;'><img style='float:left;' src='images/savy.png' height='155px' width='155px' alt='school-image'>";
    $html .= "<h1>$name</h1><h5>$address</h5><h5>$contact</h5><h5>$email</h5></div><br><h2 style='clear:both;'>Expense and Receiving</h2>";
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
        $query = "SELECT * FROM expense_receiving WHERE date='$date'";
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
        $query = "SELECT * FROM expense_receiving WHERE date BETWEEN '$date' AND '$date1'";
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
</tr>
</tbody>
</table>
<br><br><br>
<strong>Owner Signature:</strong> <u><span style='width:100px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></u>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong>Accountant Signature:</strong> <u><span style='width:100px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></u>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong>Editor Signature:</strong> <u><span style='width:100px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></u>
<br><br>
<strong>Dated:</strong> <u><span style='width:100px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></u>
";

    // <td><img src='./uploads/expense-uploads/$img' width='50px' height='50px' alt=''></td>
}
