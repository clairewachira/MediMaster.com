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

        // Fetch user details based on the provided ID
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Handle form submission for updating user details
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Retrieve and sanitize form data
                $newUsername = $_POST['username'];
                $newUsertype = $_POST['usertype'];

                // Update user details in the database
                $updateQuery = "UPDATE users SET username = ?, usertype = ? WHERE id = ?";
                $stmt = $db->prepare($updateQuery);
                $stmt->bind_param("ssi", $newUsername, $newUsertype, $userId);
                $stmt->execute();

                // Redirect back to view_users.php
                header('Location: view_users.php');
                exit;
            }
            ?>

            <!DOCTYPE html>
            <html>
            <head>
                <title>Edit User</title>
                <style>
                    /* Your CSS styles for the edit user form here */
                </style>
            </head>
            <body>
                <h1>Edit User</h1>
                <form action="edit_user.php?id=<?php echo $userId; ?>" method="POST">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>" required>
                    <label for="usertype">User Type:</label>
                    <select name="usertype">
                        <option value="Doctor" <?php if ($user['usertype'] === 'Doctor') echo 'selected'; ?>>Doctor</option>
                        <option value="Patient" <?php if ($user['usertype'] === 'Patient') echo 'selected'; ?>>Patient</option>
                        <option value="Pharmacist" <?php if ($user['usertype'] === 'Pharmacist') echo 'selected'; ?>>Pharmacist</option>
                        <option value="Pharmaceuticalcompany" <?php if ($user['usertype'] === 'Pharmaceuticalcompany') echo 'selected'; ?>>Pharmaceutical Company</option>
                        <option value="Admin" <?php if ($user['usertype'] === 'Admin') echo 'selected'; ?>>Admin</option>
                    </select>
                    <button type="submit">Save Changes</button>
                </form>
                <a href="view_users.php">Cancel</a>
            </body>
            </html>
            <?php
        } else {
            echo "User not found.";
        }

        // Close the database connection
        $db->close();
    } else {
        echo "User ID not provided.";
    }
} else {
    // Redirect to login page or show an error message
    header('Location: login.php');
    exit;
}
?>
