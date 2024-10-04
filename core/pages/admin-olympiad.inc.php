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
        echo "Record with roll number $id deleted successfully!";
    }
}

// Handle filters for game and gender
$selectedGame = isset($_POST['game_filter']) ? $_POST['game_filter'] : null;
$selectedGender = isset($_POST['gender_filter']) ? $_POST['gender_filter'] : null;

// Fetch all responses
$query = "SELECT * FROM olympiad_registrations WHERE 1=1";
if ($selectedGame) {
    $query .= " AND interest LIKE '%$selectedGame%'";
}
if ($selectedGender) {
    $query .= " AND gender = '$selectedGender'";
}
$result = $sql->query($query);

// Download CSV if requested
if (isset($_GET['download']) && $_GET['download'] == 'true') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="olympiad_registrations.csv"');
    
    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Full Name', 'Roll No', 'Department', 'Email', 'Contact No', 'Gender', 'Interest', 'Experience', 'Merch Interest', 'Commitment', 'Acknowledgement', 'ID Card']);
    
    $count = 1;
    while ($row = $sql->fetch_assoc($result)) {
        fputcsv($output, [
            $count++, $row['name'], $row['roll_no'], $row['department'], 
            $row['email'], $row['contact_no'], $row['gender'], $row['interest'], 
            $row['experience'], $row['merch'], $row['commitment'], $row['rules'], 
            $row['id_card']
        ]);
    }
    fclose($output);
    exit();
}
?>

<main class="container my-5">
    <h2 class="text-center mb-4">Olympiad 2024 Responses</h2>

    <!-- Filter Form -->
    <form method="POST" action="">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="game_filter" class="form-label">Filter by Game:</label>
                <select name="game_filter" id="game_filter" class="form-control">
                    <option value="">Select a game</option>
                    <option value="Cricket" <?php if ($selectedGame == 'Cricket') echo 'selected'; ?>>Cricket</option>
                    <option value="Football" <?php if ($selectedGame == 'Football') echo 'selected'; ?>>Football</option>
                    <option value="Volleyball" <?php if ($selectedGame == 'Volleyball') echo 'selected'; ?>>Volleyball</option>
                    <option value="Relay Race" <?php if ($selectedGame == 'Relay Race') echo 'selected'; ?>>Relay Race</option>
                    <option value="Badminton" <?php if ($selectedGame == 'Badminton') echo 'selected'; ?>>Badminton</option>
                    <option value="100M Sprint" <?php if ($selectedGame == '100M Sprint') echo 'selected'; ?>>100M Sprint</option>
                    <option value="Table Tennis" <?php if ($selectedGame == 'Table Tennis') echo 'selected'; ?>>Table Tennis</option>
                    <option value="Arm Wrestling" <?php if ($selectedGame == 'Arm Wrestling') echo 'selected'; ?>>Arm Wrestling</option>
                    <option value="Tug of war" <?php if ($selectedGame == 'Tug of war') echo 'selected'; ?>>Tug of war</option>
                    <option value="Chess" <?php if ($selectedGame == 'Chess') echo 'selected'; ?>>Chess</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="gender_filter" class="form-label">Filter by Gender:</label>
                <select name="gender_filter" id="gender_filter" class="form-control">
                    <option value="">Select a gender</option>
                    <option value="Male" <?php if ($selectedGender == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($selectedGender == 'Female') echo 'selected'; ?>>Female</option>
                </select>
            </div>
        </div>
        <div class="text-center my-3">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <!-- Download CSV Button -->
    <div class="mb-4 text-center">
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
                $count = 1; // Initialize a manual row counter
                // Loop through the records and display in table
                while ($row = $sql->fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$count}</td>";
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
                    echo "<td><img src='{$row['id_card']}'></td>";
                    echo "<td>";
                    echo "<form method='POST' action=''>";
                    echo "<input type='hidden' name='delete_id' value='{$row['id']}'>";
                    echo "<button type='submit' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                    $count++;
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
