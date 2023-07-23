<?php
session_start();

// Check if the user is logged in as a pharmacist
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'Pharmacist') {
    $username = $_SESSION['username'];
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
    <title>Pharmacist Dashboard</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333333;
        }

        .username {
            text-align: right;
            color: #777777;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .welcome-message {
            text-align: center;
            margin-top: 10px;
            color: #333333;
        }

        .dashboard-links {
            margin-top: 20px;
        }

        .dashboard-links a {
            display: block;
            margin-bottom: 10px;
            padding: 10px 20px;
            text-decoration: none;
            color: #333333;
            border: 1px solid #cccccc;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .dashboard-links a:hover {
            background-color: #f0f0f0;
            color: #007bff;
            border-color: #007bff;
        }

        .logout-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }

        .logout-link:hover {
            text-decoration: underline;
        }
    </style>
</head> 
<body>
    <div class="container"> 
        <h1>Pharmacist Dashboard</h1> 
        <p class="username">Pharmacist <?php echo $username; ?></p>
        <p class="welcome-message">Welcome, Pharmacist <?php echo $username; ?>!</p>
        <!-- Add your pharmacist-specific content here -->
        <div class="dashboard-links">
            <a href="pharmacistedit.php">Edit Pharmacist Information</a>
            <a href="pharmacistdelete.php">Delete Pharmacist Information</a>
            <a href="prescriptions.php">View All Prescriptions</a>
            <a href="dispense.php">Dispense Drugs</a>
        </div>
        <a class="logout-link" href="?logout=true">Logout</a>
    </div>
</body>
</html>