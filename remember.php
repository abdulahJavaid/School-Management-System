<?php

    // 1. Teacher log/activity for marking the class attendance is missing
    // 2. passwords encryption on all site
    // 3. image uploads on all site
    // 4. hover for buttons
    // 5. define access level for teacher & admins(accountant, profiler, scheduler)
    // 6. students parents are missing
    // 7. Required missing from all form fields


?>
// Fetch data from the database
$query = "SELECT * FROM image";
$result = mysqli_query($conn, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    echo "<table border='1'>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Image</th>
        <th>Action</th>
    </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>" . $row["firstname"] . "</td>
            <td>" . $row["lastname"] . "</td>
            <td>" . $row["email"] . "</td>
            <td>" . $row["password"] . "</td>
            <td><img src='" . $row["img"] . "' height='100'></td>
            <td>
                <a href='edit.php?id=" . $row["id"] . "'>Edit</a> | 
                <a href='delete.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
            </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);
?>