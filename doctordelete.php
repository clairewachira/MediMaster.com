<?php
session_start();
require_once 'config.php';

// Check if the user is logged in as a doctor
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'Doctor') {
    // Check if the request is a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_SESSION['id']; // Get the doctor's ID from the session

        // Perform the SQL delete query to delete the doctor's record
        $query = "DELETE FROM users WHERE id='$id' AND usertype='Doctor'";
        mysqli_query($conn, $query);

        // Perform any additional cleanup or related tasks if needed

        echo "<script>alert('Doctor record deleted successfully');</script>";

        // Redirect to a relevant page after deletion, e.g., logout or homepage
        header('Location: logout.php');
        exit;
    } else {
        // Display the delete confirmation form
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Doctor Record</title>
    <!-- Add your stylesheets and scripts here -->
</head>
<body>
    <h2>Delete Doctor Record</h2>
    <p>Are you sure you want to delete your doctor record? This action cannot be undone.</p>
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
