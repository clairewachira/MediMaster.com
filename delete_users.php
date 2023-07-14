<?php
session_start();

// Check if the user is logged in as an admin
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'Admin') {
    // Check if user ID is provided
    if (isset($_GET['id'])) {
        $userId = $_GET['id'];

        // Connect to the database
        $db = new mysqli('localhost', 'root', '', 'drug_dispensing');
        // Check for database connection errors
        if ($db->connect_error) {
            die('Connection failed: ' . $db->connect_error);
        }

        // Delete the user from the database
        $deleteQuery = "DELETE FROM users WHERE id = ?";
        $stmt = $db->prepare($deleteQuery);
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        // Redirect back to view_users.php
        header('Location: view_users.php');
        exit;
    } else {
        echo "User ID not provided.";
    }
} else {
    // Redirect to login page or show an error message
    header('Location: login.php');
    exit;
}
?>
