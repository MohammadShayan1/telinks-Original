<?php
// Use global sql class object
global $sql;

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize the input to ensure it's an integer
    
    // Prepare delete statement
    $delete_sql = "DELETE FROM newsletter WHERE id = ?";
    $stmt = $sql->query("DELETE FROM newsletter WHERE id = $delete_id");

    if ($stmt) {
        echo "<div class='alert alert-success'>Record deleted successfully.</div>";
    } else {
        // Use sql class to retrieve error
        echo "<div class='alert alert-danger'>Error deleting record: " . $sql->getError() . "</div>";
    }
}

// Fetch newsletter data
$result = $sql->query("SELECT * FROM newsletter");
?>

<h3 class="mt-5">Newsletter Submissions</h3>
<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($sql->num_rows($result) > 0) {
            $i = 1;
            while ($row = $sql->fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $i++ . "</td>";
                echo "<td>" . htmlspecialchars($row['n_name']) . "</td>"; // Ensure output is safe
                echo "<td>" . htmlspecialchars($row['n_email']) . "</td>"; // Ensure output is safe
                echo "<td><a href='?delete_id=" . intval($row['id']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No submissions found.</td></tr>";
        }
        ?>
    </tbody>
</table>

<a href="./pages/newslettercsv.php" class="btn btn-primary">Download CSV</a>

