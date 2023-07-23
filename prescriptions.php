<?php
session_start();

// Check if the user is logged in as a pharmacist
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'Pharmacist') {
    $username = $_SESSION['username'];


    // Database connection details
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $database = "drug_dispensing";

    // Create a new PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$database", $dbUsername, $dbPassword);

    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve prescriptions for patients only once and store in an array
    $query = "SELECT prescriptions.*, users.name AS patient_name FROM prescriptions
              INNER JOIN users ON prescriptions.user_id = users.id
              WHERE users.usertype = 'Patient'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $prescriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Redirect to login page or show an error message
    header('Location: login.php');
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Prescriptions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        
        h1 {
            text-align: center;
            margin-top: 30px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Prescriptions for <?php echo $username; ?></h1>
    <table>
        <thead>
            <tr>
                <th>Prescription ID</th>
                <th>Patient Name</th>
                <th>Drug Name</th>
                <th>Frequency</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prescriptions as $prescription): ?>
                <tr>
                    <td><?php echo $prescription['prescription_id']; ?></td>
                    <td><?php echo $prescription['patient_name']; ?></td>
                    <td><?php echo $prescription['drug_name']; ?></td>
                    <td><?php echo $prescription['frequency']; ?></td>
                    <td>
                        <form method="POST" action="dispense.php">
                            <input type="hidden" name="prescriptionId" value="<?php echo $prescription['prescription_id']; ?>">
                            <input type="hidden" name="drugName" value="<?php echo $prescription['drug_name']; ?>">
                            <input type="number" name="price" min="0.01" step="0.01" required>
                            <button type="submit" name="dispense">Dispense</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
