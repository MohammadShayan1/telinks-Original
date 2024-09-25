<?php
// Ensure no output before session start
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Unset and destroy session
session_unset();
session_destroy();

// Redirect after session is destroyed
header("Location: admin-home");
exit;
?>