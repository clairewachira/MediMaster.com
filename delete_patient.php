<?php
// Ensure the doctor is logged in
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== 'Doctor') {
    header('Location: login.php');
    exit;
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and delete the patient information
    $patientId = $_POST['patientId'];
    // Implement your logic to delete patient information from the database

    // Redirect back to the doctor's dashboard
    header('Location: doctor.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Patient Information</title>
</head>
<body>
    <h1>Delete Patient Information</h1>
    <form method="POST" action="delete_patient.php">
        <input type="text" name="patientId" placeholder="Enter patient ID" required>
        <!-- Add additional confirmation or verification steps if needed -->
        <button type="submit">Delete</button>
    </form>
</body>
</html>
