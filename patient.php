<?php
session_start();

// Check if the user is logged in as a patient
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'Patient') {
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

// Database connection details
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$database = "drug_dispensing";

// Create a new PDO connection
$conn = new PDO("mysql:host=$servername;dbname=$database", $dbUsername, $dbPassword);

// Set PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Retrieve prescriptions for the specific patient
$query = "SELECT * FROM prescriptions WHERE user_id = :username";
$stmt = $conn->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->execute();
$prescriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient's Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h1 {
            color: #007bff;
        }

        .welcome-message {
            font-size: 18px;
            margin-top: 10px;
        }

        .logout-link {
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
            display: inline-block;
        }

        .logout-link:hover {
            text-decoration: underline;
        }

        .prescriptions-container {
            margin-top: 30px;
        }

        .prescription-item {
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .prescription-item p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Patient Dashboard</h1>
        <p class="username">Patient <?php echo $username; ?></p>
        <p class="welcome-message">Welcome, Patient <?php echo $username; ?>!</p>
        <!-- Add your patient-specific content here -->
        <a href="patientedit.php" class="action-link">Edit Patient Information</a>
        <br>
        <a href="patientdelete.php" class="action-link">Delete Patient Information</a>
        <br>
        <a class="logout-link" href="?logout=true">Logout</a>
        
        <div class="prescriptions-container">
            <h2>Prescriptions</h2>
            <?php if (!empty($prescriptions)): ?>
                <?php foreach ($prescriptions as $prescription): ?>
                    <div class="prescription-item">
                        <p>Prescription ID: <?php echo $prescription['prescription_id']; ?></p>
                        <p>Drug Name: <?php echo $prescription['drug_name']; ?></p>
                        <p>Frequency: <?php echo $prescription['frequency']; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No prescriptions available.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>