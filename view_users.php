<?php
session_start();

// Check if the user is logged in as an admin
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'Admin') {
    // Connect to the database
    $db = new mysqli('localhost', 'root', '', 'drug_dispensing');
    // Check for database connection errors
    if ($db->connect_error) {
        die('Connection failed: ' . $db->connect_error);
    }
    // Fetch all users from the database
    $query = "SELECT * FROM users";
    $result = $db->query($query);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>View Users</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f7f7f7;
                padding: 20px;
            }

            h1 {
                text-align: center;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            th {
                background-color: #f2f2f2;
            }

            a {
                display: block;
                margin-top: 20px;
                text-align: center;
                color: #888888;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <h1>View Users</h1>
        <table>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>User Type</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['usertype']; ?></td>
                    <td>
                        <a href="edit_users.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <!-- Add the Delete link if you have a delete_users.php file -->
                        <a href="delete_users.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <a href="admin.php">Back to Admin Dashboard</a>
    </body>
    </html>
    <?php
    // Close the database connection
    $db->close();
} else {
    // Redirect to login page or show an error message
    header('Location: login.php');
    exit;
}
?>
