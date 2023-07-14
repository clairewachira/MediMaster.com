<?php
session_start();

// Check if a session is active
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.html");
    exit();
}

// Display the logged-in admin's username
$loggedInUsername = $_SESSION['username'];

// Other admin-specific functionality goes here

// HTML code for the admin page
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
</head>
<body>
    <h2>Welcome, Admin <?php echo $loggedInUsername; ?></h2>
    <p>Admin-specific content goes here.</p>
    <div id="user-info">
        Logged in as: <?php echo $loggedInUsername; ?>
    </div>
    <a href="logout.php">Logout</a>
</body>
</html>
