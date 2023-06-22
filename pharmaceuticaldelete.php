<?php
require_once 'config.php';

// Check if the user is logged in as a pharmaceutical company
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'Pharmaceutical') {
    // Check if the request is a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_SESSION['id']; // Get the pharmaceutical company's ID from the session

        // Perform the SQL delete query to delete the pharmaceutical company's information
        $query = "DELETE FROM users WHERE id='$id' AND usertype='Pharmaceutical'";
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
    <title>Delete Pharmaceutical Company Account
        <!-- Add your stylesheets and scripts here -->
</head>
<body>
    <h2>Delete Pharmaceuticalcompany Account</h2>
    <p>Are you sure you want to delete your account?</p>
    <form action="" method="post">
        <button type="submit">Delete Account</button>
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
