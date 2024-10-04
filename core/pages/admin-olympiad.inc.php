<?php
// Create SQL class instance
$sql = new sql();

// Check if the delete action is requested
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $deleteQuery = "DELETE FROM olympiad_registrations WHERE id = '$id'";
    $sql->query($deleteQuery);

    // Check for errors during deletion
    if ($sql->getError()) {
        echo "Error: " . $sql->getError();
    } else {
        echo "Record with rollnumber $id deleted successfully!";
    }
}

// Fetch all responses
$query = "SELECT * FROM olympiad_registrations";
$result = $sql->query($query);
?>

<main class="container my-5">
    <h2 class="text-center mb-4">Olympiad 2024 Responses</h2>

    <!-- Download CSV Button -->
    <div class="d-flex justify-content-between mb-4">
        <a href="./olympiadcsv?download=true" class="btn btn-primary">Download CSV</a>
    </div>

    <!-- Responsive Table Wrapper -->
    <div class="table-responsive">
        <!-- Table to display form responses -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Roll No</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Gender</th>
                    <th>Interest</th>
                    <th>Experience</th>
                    <th>Merch Interest</th>
                    <th>Commitment</th>
                    <th>Acknowledgement</th>
                    <th>ID Card</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the records and display in table
                while ($row = $sql->fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['roll_no']}</td>";
                    echo "<td>{$row['department']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['contact_no']}</td>";
                    echo "<td>{$row['gender']}</td>";
                    echo "<td>{$row['interest']}</td>";
                    echo "<td>{$row['experience']}</td>";
                    echo "<td>{$row['merch']}</td>";
                    echo "<td>{$row['commitment']}</td>";
                    echo "<td>{$row['rules']}</td>";
                    echo "<td><img src='{$row['id_card']}'></img></td>";
                    echo "<td>";
                    echo "<form method='POST' action=''>";
                    echo "<input type='hidden' name='delete_id' value='{$row['id']}'>";
                    echo "<button type='submit' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
