<?php
session_start();
// Check if the user is logged in as a pharmacist
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'Pharmaceuticalcompany') { $username = $_SESSION['username'];
echo "Success!"; } 
else {
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
    <title>Patient Dashboard</title>
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
        <h1>Pharmaceuticalcompany Dashboard</h1> 
        <p class="username">Patient <?php echo $username; ?></p>
        <p class="welcome-message">Welcome, Pharmaceuticalcompany <?php echo $username; ?>!</p>
        <!-- Add your Pharmaceuticalcompany-specific content here -->
        <a class="logout-link" href="?logout=true">Logout</a>
    </div>
</body>
</html>
    