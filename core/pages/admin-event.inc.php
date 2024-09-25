<?php
$db = new sql();
$query = $db->query("SELECT * FROM events ORDER BY date_from ASC");
?>

<!-- Add the buttons at the top -->
<div style="margin-bottom: 20px;">
    <a href="admin-event">
        <button style="padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer;">
            View Events
        </button>
    </a>
    <a href="admin-add-event">
        <button style="padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer;">
            Add New Event
        </button>
    </a>
</div>

<!-- Table to display events -->
<table border="1" cellspacing="0" cellpadding="10">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($event = $db->fetch_assoc($query)): ?>
        <tr>
            <td><?php echo htmlspecialchars($event['title']); ?></td>
            <td><?php echo htmlspecialchars($event['description']); ?></td>
            <td>
                <?php
                    $date_from = $event['date_from'] ? date('jS F', strtotime($event['date_from'])) : null;
                    $date_to = $event['date_to'] ? date('jS F Y', strtotime($event['date_to'])) : null;

                    if ($date_from && $date_to) {
                        echo $date_from . " - " . $date_to;
                    } elseif ($date_from) {
                        echo "Starts on " . $date_from;
                    } elseif ($date_to) {
                        echo "Ends on " . $date_to;
                    } else {
                        echo "No date specified";
                    }
                ?>
            </td>
            <td>
                <a href="admin-edit-event?id=<?php echo $event['id']; ?>">Edit</a>
                <a href="admin-delete-event?id=<?php echo $event['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
