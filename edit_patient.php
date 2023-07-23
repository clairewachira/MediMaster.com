<?php
// Ensure the doctor is logged in
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== 'Doctor') {
    header('Location: login.php');
    exit;
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and update the patient information
    $patientId = $_POST['patientId'];
    // Implement your logic to update patient information in the database

    // Redirect back to the doctor's dashboard
    header('Location: doctor.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient Information</title>
</head>
<body>
    <h1>Edit Patient Information</h1>
    <form method="POST" action="edit_patient.php">
        <input type="text" name="patientId" placeholder="Enter patient ID" required>
        <!-- Add additional fields for editing patient information -->
        <button type="submit">Update</button>
    </form>
</body>
</html>
