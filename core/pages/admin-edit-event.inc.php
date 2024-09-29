<?php
$db = new sql();

// Fetch the event data based on the event ID
$id = $_GET['id'];
$query = $db->query("SELECT * FROM events WHERE id = '$id'");
$event = $db->fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $db->escape($_POST['title']);
    $description = $db->escape($_POST['description']);
    $date_from = $db->escape($_POST['date_from']);
    $date_to = $db->escape($_POST['date_to']);
    $image_url = $db->escape($_POST['image_url']);

    // Update the event in the database
    $db->query("UPDATE events SET title='$title', description='$description', date_from='$date_from', date_to='$date_to', image_url='$image_url' WHERE id='$id'");

    if ($db->getError()) {
        echo "Error: " . $db->getError();
    } else {
        echo "Event updated successfully!";
    }
}
?>

<form method="POST" action="">
    <input type="text" name="title" value="<?php echo $event['title']; ?>" required>
    <textarea name="description" required><?php echo $event['description']; ?></textarea>
    <input type="date" name="date_from" value="<?php echo $event['date_from']; ?>">
    <input type="date" name="date_to" value="<?php echo $event['date_to']; ?>">
    <input type="text" name="image_url" value="<?php echo $event['image_url']; ?>" required>
    <button type="submit">Update Event</button>
</form>
