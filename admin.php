<?php
session_start();

// Check if the user is logged in as an admin
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'Admin') {
    $username = $_SESSION['username'];
    echo "Success!";
} else {
    // Redirect to login page or show an error message
    header('Location: login.php');
    exit;
}

// Check if logout request is triggered
if (isset($_GET['logout'])) {
    // Destroy the session and redirect to the login page
    session_destroy();
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .username {
            margin-top: 10px;
            text-align: center;
        }

        .welcome-message {
            margin-top: 10px;
            text-align: center;
        }

        .admin-options {
            margin-top: 20px;
            text-align: center;
        }

        .admin-options a {
            display: block;
            margin-bottom: 10px;
            padding: 10px 20px;
            background-color: #4caf50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
        }

        .admin-options a:hover {
            background-color: #45a049;
        }

        .logout-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #888888;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <p class="username">Admin <?php echo $username; ?></p>
        <p class="welcome-message">Welcome, Admin <?php echo $username; ?>!</p>
        <div class="admin-options">
            <a href="view_users.php">View Users</a>
        </div>
        <a class="logout-link" href="?logout=true">Logout</a>
    </div>
</body>
</html>
