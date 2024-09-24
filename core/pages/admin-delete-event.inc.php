<?php
$db = new sql();

// Get the event ID from the URL
$id = $_GET['id'];

// Delete the event
$db->query("DELETE FROM events WHERE id = '$id'");

if ($db->getError()) {
    echo "Error: " . $db->getError();
} else {
    echo "Event deleted successfully!";
    // Redirect back to the events list
    header('Location: admin_events.php');
}
?>
