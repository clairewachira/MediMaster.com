<?php
require_once 'config.php';
// Check if the user is logged in as a patient
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'Patient') {
    // Check if the request is a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_SESSION['id']; // Get the patient's ID from the session

        // Perform the SQL delete query to delete the patient's information
        $query = "DELETE FROM users WHERE id='$id' AND usertype='Patient'";
        mysqli_query($conn, $query);

        // Destroy the session and redirect to login page
        session_destroy();
        header('Location: login.php');
        exit;
    } else {
        // Show the confirmation dialog for deletion
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Patient Account</title>
    <!-- Add your stylesheets and scripts here -->
</head>
<body>
    <h2>Delete Patient Account</h2>
    <p>Are you sure you want to delete your account?</p>
    <form action="" method="post">
        <button type="submit">Delete</button>
    </form>
</body>
</html>

<?php
    }
} else {
    // Redirect to login page or show an error message
    header('Location: login.php');
    exit;
}
?>

