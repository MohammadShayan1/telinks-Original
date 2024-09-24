<?php
global $sql;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_member'])) {
    $name = htmlspecialchars($_POST['name']);
    $position = htmlspecialchars($_POST['position']);
    $tenure = htmlspecialchars($_POST['tenure']);
    $linkedin = htmlspecialchars($_POST['linkedin']);

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/teamtech/";
        $imageFileType = strtolower(pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "jpeg", "png", "gif");

        // Validate file type
        if (!in_array($imageFileType, $allowed_types)) {
            $message = "<div class='alert alert-danger'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
        } else {
            // Validate file size (e.g., 2MB max)
            if ($_FILES["profile_picture"]["size"] > 2000000) {
                $message = "<div class='alert alert-danger'>File is too large. Maximum allowed size is 2MB.</div>";
            } else {
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }
                $target_file = $target_dir . uniqid() . "." . $imageFileType;
                if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                    // Use query() for simple insert query
                    $stmt = $sql->query("INSERT INTO teamtech (name, position, tenure, linkedin, profile_picture) 
                                         VALUES ('$name', '$position', '$tenure', '$linkedin', '$target_file')");
                    if ($stmt) {
                        $message = "<div class='alert alert-success'>Member added successfully!</div>";
                    } else {
                        $message = "<div class='alert alert-danger'>Database Error: " . $sql->error . "</div>";
                    }
                } else {
                    $message = "<div class='alert alert-danger'>Error moving uploaded file.</div>";
                }
            }
        }
    }
}

// Handle deleting a member and their profile picture
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize the input
    
    // Fetch the profile picture path before deleting the member
    $result = $sql->query("SELECT profile_picture FROM teamtech WHERE id = '$delete_id'");
    $member = $sql->fetch_assoc($result);

    if ($member && !empty($member['profile_picture']) && file_exists($member['profile_picture'])) {
        // Delete the profile picture file from the server
        unlink($member['profile_picture']);
    }

    // Delete the member from the database
    $stmt = $sql->query("DELETE FROM teamtech WHERE id = '$delete_id'");
    
    if ($stmt) {
        $message = "<div class='alert alert-success'>Member deleted successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error deleting member.</div>";
    }
}

// Fetch all members
$result = $sql->query("SELECT * FROM teamtech");
?>

<!-- JavaScript to switch between Add and View screens -->
<script>
    function showAddMember() {
        document.getElementById('add-member-form').style.display = 'block';
        document.getElementById('view-members').style.display = 'none';
    }

    function showViewMembers() {
        document.getElementById('add-member-form').style.display = 'none';
        document.getElementById('view-members').style.display = 'block';
    }
</script>

<h3 class="mt-4">Admin Dashboard</h3>

<!-- Buttons to toggle between Add and View -->
<button class="btn btn-secondary" onclick="showAddMember()">Add Member</button>
<button class="btn btn-secondary" onclick="showViewMembers()">View Members</button>

<!-- Add Member Form -->
<div id="add-member-form" style="display: block;">
    <h3 class="mt-4">Add New Member</h3>
    <?php if (isset($message)) echo $message; ?>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Position:</label>
            <input type="text" class="form-control" id="position" name="position" required>
        </div>
        <div class="mb-3">
            <label for="tenure" class="form-label">Tenure:</label>
            <input type="text" class="form-control" id="tenure" name="tenure" required>
        </div>
        <div class="mb-3">
            <label for="linkedin" class="form-label">LinkedIn URL:</label>
            <input type="url" class="form-control" id="linkedin" name="linkedin" required>
        </div>
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Profile Picture:</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" required>
        </div>
        <button type="submit" name="add_member" class="btn btn-primary w-100">Add Member</button>
    </form>
</div>

<!-- View Members Section -->
<div id="view-members" style="display: none;">
    <h3 class="mt-4">Member List</h3>
    <?php if (isset($message)) echo $message; ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Tenure</th>
                <th>LinkedIn</th>
                <th>Profile Picture</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $sql->fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['position']; ?></td>
                <td><?php echo $row['tenure']; ?></td>
                <td><a href="<?php echo $row['linkedin']; ?>" target="_blank">LinkedIn</a></td>
                <td><img src="<?php echo $row['profile_picture']; ?>" width="50" height="50"></td>
                <td>
                    <a href="edit_member?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this member?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
