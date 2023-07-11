<?php
session_start();
// Check if the user is logged in as a doctor
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'Doctor') { $username = $_SESSION['username'];
echo "Success!"; } else {
// Redirect to login page or show an error message
header('Location: login.php');
exit; }
// Check if logout request is triggered
if (isset($_GET['logout'])) {
// Destroy the session and redirect to the login page
session_destroy();
header('Location: login.php');
exit; }
?>
<!DOCTYPE html> 
<html> 
<head>
    <title>Doctor's Dashboard</title>
    <style>
        body {
            display: flex;
            justify-content: flex-end;
            align-items: flex-start;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: right;
        }

        .welcome-message,
        .logout-link {
            margin-top: 10px;
        }
    </style>
</head> 
<body>
    <div class="container"> 
        <h1>Doctor Dashboard</h1> 
        <p class="username">Doctor <?php echo $username; ?></p>
        <p class="welcome-message">Welcome, Doctor <?php echo $username; ?>!</p>
        <!-- Add your doctor-specific content here -->
        <a href="doctoredit.php">Edit Doctor Information</a>
        <br>
        <a href="doctordelete.php">Delete Doctor Information</a>
        <br>
        <a class="logout-link" href="?logout=true">Logout</a>
    </div>
</body>
</html>
