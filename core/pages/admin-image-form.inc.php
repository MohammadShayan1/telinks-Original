<?php
// Create a new instance of the sql class
$db = new sql();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_image'])) {
        $category = htmlspecialchars($_POST['category']);
        $alt_text = htmlspecialchars($_POST['alt_text']);

        // Check if files were uploaded
        if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
            $target_dir = "uploads/" . $category;
            $allowed_types = array("jpg", "jpeg", "png", "gif");

            // Ensure the uploads directory exists
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            // Loop through each file
            foreach ($_FILES['images']['name'] as $key => $image_name) {
                $image_tmp = $_FILES['images']['tmp_name'][$key];
                $imageFileType = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

                // Validate file type
                if (!in_array($imageFileType, $allowed_types)) {
                    $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    continue;
                }

                // Generate a unique name for the file
                $target_file = $target_dir . uniqid() . "." . $imageFileType;

                // Attempt to move the uploaded file
                if (move_uploaded_file($image_tmp, $target_file)) {
                    // Use the sql class to insert data into the database
                    $query = "INSERT INTO images (url, category, alt_text) VALUES ('" . $db->escape($target_file) . "', '" . $db->escape($category) . "', '" . $db->escape($alt_text) . "')";
                    $result = $db->query($query);

                    if ($result) {
                        $message = "Image uploaded and added successfully!";
                    } else {
                        $message = "Database Error: " . $db->getError();
                    }
                } else {
                    $message = "Error moving uploaded file.";
                }
            }
        } else {
            $message = "No files were uploaded.";
        }
    }

    // Edit image logic
    if (isset($_POST['edit_image'])) {
        $image_id = $_POST['image_id'];
        $alt_text = htmlspecialchars($_POST['alt_text']);
        $category = htmlspecialchars($_POST['category']);

        $query = "UPDATE images SET alt_text = '" . $db->escape($alt_text) . "', category = '" . $db->escape($category) . "' WHERE id = " . (int)$image_id;
        $result = $db->query($query);

        if ($result) {
            $message = "Image updated successfully!";
        } else {
            $message = "Database Error: " . $db->getError();
        }
    }

    // Delete image logic
    if (isset($_POST['delete_image'])) {
        $image_id = $_POST['image_id'];

        $query = "DELETE FROM images WHERE id = " . (int)$image_id;
        $result = $db->query($query);

        if ($result) {
            $message = "Image deleted successfully!";
        } else {
            $message = "Database Error: " . $db->getError();
        }
    }
}

// Fetch all images from the database
$images = $db->query("SELECT * FROM images")->fetch_all(MYSQLI_ASSOC);
?>

<h3 class="mt-4">Manage Images</h3>
<?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>

<!-- JS for toggling forms -->
<script>
function showForm(formId) {
    document.getElementById('addForm').style.display = 'none';
    document.getElementById('editForm').style.display = 'none';
    document.getElementById('deleteForm').style.display = 'none';
    document.getElementById(formId).style.display = 'block';
}

function editImage(id, alt_text, category) {
    document.getElementById('edit_image_id').value = id;
    document.getElementById('edit_alt_text').value = alt_text;
    document.getElementById('edit_category').value = category;
    showForm('editForm');
}

function deleteImage(id) {
    document.getElementById('delete_image_id').value = id;
    showForm('deleteForm');
}
</script>

<!-- Add Image Form -->
<div id="addForm" style="display:block;">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="images" class="form-label">Upload Images:</label>
            <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category:</label>
            <select class="form-select" id="category" name="category" required>
                <option value="" disabled selected>Select a category</option>
                <option value="climatech">Climatech</option>
                <option value="ch">Counsel Hour</option>
                <option value="sih">Self Investment Hour</option>
                <option value="olymtwo">Sports Team</option>
                <option value="iftar">Iftar Drive</option>
                <option value="plant">Plantation Drive</option>
                <option value="other">Others</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="alt_text" class="form-label">Alt Text:</label>
            <input type="text" class="form-control" id="alt_text" name="alt_text" required>
        </div>
        <button type="submit" name="add_image" class="btn btn-primary w-100">Add Images</button>
    </form>
</div>

<!-- Edit Image Form -->
<div id="editForm" style="display:none;">
    <form method="post" action="">
        <input type="hidden" id="edit_image_id" name="image_id">
        <div class="mb-3">
            <label for="edit_category" class="form-label">Category:</label>
            <select class="form-select" id="edit_category" name="category" required>
                <option value="climatech">Climatech</option>
                <option value="ch">Counsel Hour</option>
                <option value="sih">Self Investment Hour</option>
                <option value="olymtwo">Sports Team</option>
                <option value="iftar">Iftar Drive</option>
                <option value="plant">Plantation Drive</option>
                <option value="other">Others</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="edit_alt_text" class="form-label">Alt Text:</label>
            <input type="text" class="form-control" id="edit_alt_text" name="alt_text" required>
        </div>
        <button type="submit" name="edit_image" class="btn btn-primary w-100">Edit Image</button>
    </form>
</div>

<!-- Delete Image Form -->
<div id="deleteForm" style="display:none;">
    <form method="post" action="">
        <input type="hidden" id="delete_image_id" name="image_id">
        <p>Are you sure you want to delete this image?</p>
        <button type="submit" name="delete_image" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-secondary" onclick="showForm('addForm')">Cancel</button>
    </form>
</div>

<!-- List of Images -->
<table class="table mt-4">
    <thead>
        <tr>
            <th>Image</th>
            <th>Alt Text</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($images as $image): ?>
        <tr>
            <td><img src="<?= $image['url'] ?>" alt="<?= $image['alt_text'] ?>" style="width:100px;"></td>
            <td><?= $image['alt_text'] ?></td>
            <td><?= $image['category'] ?></td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="editImage(<?= $image['id'] ?>, '<?= $image['alt_text'] ?>', '<?= $image['category'] ?>')">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteImage(<?= $image['id'] ?>)">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
