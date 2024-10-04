<?php
// Check if the user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: home");
    exit;
}

// Set timeout period in seconds (15 minutes)
$timeout_duration = 900;

// Check if the last activity timestamp is set
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    // Last request was more than 15 minutes ago, so log out the user
    session_unset();
    session_destroy();
    header("Location: admin-home");
    exit;
}

// Update last activity timestamp
$_SESSION['last_activity'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->title() ?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="./gui/imgs/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./gui/imgs/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./gui/imgs/favicon/favicon-16x16.png">
    <link rel="manifest" href="./gui/imgs/favicon/site.webmanifest">
    <link rel="mask-icon" href="./gui/imgs/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #daddd8; /* Light Yellow */
            --secondary-color: #1c1c1c; /* Deep Blue */
            --text-color: #1c1c1c; /* Dark Gray text color for better readability */
        }

        body {
            background-color: var(--primary-color);
            color: var(--text-color);
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2, h3 {
            text-align: center;
            color: var(--secondary-color);
        }

        .container img {
            display: block;
            margin: 0 auto 20px;
            width: 100px; /* Adjust this size as needed */
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border: none;
        }

        .btn-primary:hover {
            background-color: #333333; /* Slightly darker for hover effect */
        }

        .form-label {
            font-weight: bold;
            color: var(--text-color);
        }

        .message {
            text-align: center;
            color: #28a745;
            font-weight: bold;
        }

        .logout-link {
            display: block;
            text-align: center;
            margin-bottom: 20px;
            color: #dc3545;
        }

        .sidebar {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 250px;
    background-color: #f8f9fa;
    transition: all 0.3s ease;
    z-index: 1000;
}

.show-sidebar {
    display: block;
}


        .sidebar .nav-link {
            color: var(--secondary-color);
        }

        .sidebar .nav-link.active {
            font-weight: bold;
            color: #333333;
        }

        /* Hamburger Menu */
        .navbar-toggler {
            border: none;
        }

        .navbar-toggler-icon {
            font-size: 24px;
        }

        /* Collapsed Sidebar */
        @media (max-width: 992px) {
            #sidebarMenu {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: #f8f9fa;
                z-index: 1000;
                transition: transform 0.3s ease;
            }

            .collapse.show {
                display: block !important;
                transform: translateX(0%);
            }

            .collapse {
                transform: translateX(-100%);
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Navbar for hamburger menu -->
        <nav class="navbar navbar-light bg-light d-lg-none">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars navbar-toggler-icon"></i> <!-- Font Awesome hamburger icon -->
                </button>
            </div>
        </nav>

        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-lg-2 d-lg-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./admin-dashboard">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./admin-event">
                                <i class="fas fa-calendar-alt"></i> Event (Upcoming)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./regmember">
                                <i class="fas fa-user-plus"></i> Add Alumni
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./newsletter">
                                <i class="fas fa-newspaper"></i> Newsletter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./admin-image-form">
                                <i class="fas fa-images"></i> Gallery (Add Image)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./admin-olympiad">
                                <i class="fas fa-trophy"></i> Olympiad 4.0
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-lg-10 ms-sm-auto px-md-4">
                <div class="container mt-4">
                    <img src="./gui/imgs/telinkslogo.png" alt="Logo">
                    <h2><?php echo 'Welcome, ' . $_SESSION['username']; ?></h2>
                    <a href="./admin-logout" class="logout-link">Logout</a>

