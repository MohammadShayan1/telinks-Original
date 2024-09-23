<?php
// Create a new instance of the sql class
$db = new sql();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $db->escape($_POST['title']);
    $description = $db->escape($_POST['description']);
    $date_from = $db->escape($_POST['date_from']);
    $date_to = $db->escape($_POST['date_to']);
    
    // Handling the image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_error = $_FILES['image']['error'];

        // Ensure the uploads directory exists
        $upload_dir = './gui/imgs/upcoming-events/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Validate and move the uploaded file
        $image_path = $upload_dir . basename($image_name);
        if (move_uploaded_file($image_tmp, $image_path)) {
            // Insert the event into the database with the image path
            $db->query("INSERT INTO events (title, description, date_from, date_to, image_url) VALUES ('$title', '$description', '$date_from', '$date_to', '$image_path')");

            if ($db->getError()) {
                echo "Error: " . $db->getError();
            } else {
                echo "Event added successfully!";
            }
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "No image uploaded or there was an error.";
    }
}
?>

<!-- Form to add event -->
<form method="POST" action="" enctype="multipart/form-data" style="max-width: 600px; margin: auto;">
    <div style="margin-bottom: 15px;">
        <label for="title" style="display: block; font-weight: bold; margin-bottom: 5px;">Event Title</label>
        <input type="text" id="title" name="title" placeholder="Event Title" style="width: 100%; padding: 8px;" required>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="description" style="display: block; font-weight: bold; margin-bottom: 5px;">Event Description</label>
        <textarea id="description" name="description" placeholder="Event Description" style="width: 100%; padding: 8px;" required></textarea>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="date_from" style="display: block; font-weight: bold; margin-bottom: 5px;">Start Date</label>
        <input type="date" id="date_from" name="date_from" style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="date_to" style="display: block; font-weight: bold; margin-bottom: 5px;">End Date</label>
        <input type="date" id="date_to" name="date_to" style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="image" style="display: block; font-weight: bold; margin-bottom: 5px;">Event Image</label>
        <input type="file" id="image" name="image" style="width: 100%; padding: 8px;" required>
    </div>

    <div>
        <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer;">
            Add Event
        </button>
    </div>
</form>
