<?php
// Create a new instance of the sql class
$db = new sql();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_image'])) {
    $category = htmlspecialchars($_POST['category']);
    $alt_text = htmlspecialchars($_POST['alt_text']);

    // Check if files were uploaded
    if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
        $target_dir = "uploads/";
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
                // Detailed error message for each failed file
                $message = "Error moving uploaded file: " . error_get_last()['message'];
                $message .= "<br>Target directory: " . $target_dir;
                $message .= "<br>Target file: " . $target_file;
            }
        }
    } else {
        $message = "No files were uploaded.";
    }
}
?>

<h3 class="mt-4">Add New Images</h3>
<?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>
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
