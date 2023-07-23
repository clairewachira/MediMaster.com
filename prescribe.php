<?php
session_start();

// Ensure the doctor is logged in
if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== 'Doctor') {
    header('Location: login.php');
    exit;
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $patientId = $_POST['patientId'];
    $drugName = $_POST['drugName'];
    $frequency = $_POST['frequency'];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "drug_dispensing";

    // Create a new PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Perform the drug prescription logic - Insert into the prescriptions table
    $stmt = $conn->prepare("INSERT INTO prescriptions (user_id, drug_name, frequency) VALUES (:user_id, :drug_name, :frequency)");
    $stmt->bindParam(':user_id', $patientId);
    $stmt->bindParam(':drug_name', $drugName);
    $stmt->bindParam(':frequency', $frequency);
    $stmt->execute();

    echo "Drug prescribed successfully";

    // Close the database connection
    $conn = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Prescribe Drugs</title>
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

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #555555;
        }

        input[type="text"] {
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #007bff;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Prescribe Drugs</h1>
        <form method="POST" action="prescribe.php">
            <label for="patientId">Patient ID:</label>
            <input type="text" id="patientId" name="patientId" required>
            <label for="drugName">Drug Name:</label>
            <input type="text" id="drugName" name="drugName" required>
            <label for="frequency">Frequency:</label>
            <input type="text" id="frequency" name="frequency" required>
            <button type="submit">Prescribe</button>
        </form>
    </div>
</body>
</html>