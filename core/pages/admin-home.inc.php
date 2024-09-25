<?php
session_start();

global $sql;

// Check if the user is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin-dashboard");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Escape the input
    $username = $sql->escape($username);
    $query = "SELECT * FROM admins WHERE username = '$username' LIMIT 1";
    $result = $sql->query($query);

    // Check if there is a result and process it
    if ($result && $sql->num_rows($result) > 0) {
        $user = $sql->fetch_assoc($result);

        // Verify the password
        if ($password == $user['password']) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['username'] = $username;
            header("Location: admin-dashboard");
            exit;
        } else {
            $error = "Invalid credentials!";
        }
    } else {
        $error = "Invalid credentials!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags and Title -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="shortcut icon" href="./gui/imgs/telinkslogo.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Arial', sans-serif;
        }
        .login-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 30px;
        }
        .login-container img {
            display: block;
            margin: 0 auto 20px;
            width: 100px;
        }
        .login-container .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .login-container .btn-primary:hover {
            background-color: #0056b3;
        }
        .login-container .form-label {
            font-weight: bold;
        }
        .login-container .error-message {
            color: #dc3545;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="./gui/imgs/telinkslogo.png" alt="Logo">
        <h2>Admin Login</h2>
        <?php if (!empty($error)) echo "<p class='error-message'>$error</p>"; ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>