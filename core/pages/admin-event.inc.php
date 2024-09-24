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
            <td><?php echo $event['title']; ?></td>
            <td><?php echo $event['description']; ?></td>
            <td><?php echo date('jS F', strtotime($event['date_from'])) . " - " . date('jS F Y', strtotime($event['date_to'])); ?></td>
            <td>
                <a href="admin-edit-event?id=<?php echo $event['id']; ?>">Edit</a>
                <a href="admin-delete-event?id=<?php echo $event['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
