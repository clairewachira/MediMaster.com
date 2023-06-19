
<?php
session_start();
// Check if the user is logged in as a patient
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'Patient') { $username = $_SESSION['username'];
   echo "Success!"; }
    else {
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
        <h1>Doctor Dashboard</h1> 
        <p class="username">Patient <?php echo $username; ?></p>
        <p class="welcome-message">Welcome, Patient <?php echo $username; ?>!</p>
        <!-- Add your patient-specific content here -->
        <a class="logout-link" href="?logout=true">Logout</a>
    </div>
</body>
</html>
    