<?php
require_once 'config.php';

// Check if the user is logged in as a pharmaceutical company
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'Pharmaceutical') {
    // Check if the request is a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_SESSION['id']; // Get the pharmaceutical company's ID from the session
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Perform the SQL update query to edit the pharmaceutical company's information
        $query = "UPDATE users SET name='$name', username='$username', email='$email' password='$password' WHERE id='$id' AND usertype='Pharmaceutical'";
        mysqli_query($conn, $query);

        echo "<script>alert('User information updated successfully');</script>";
    } else {
        // Retrieve the pharmaceutical company's information from the database based on the ID
        $id = $_SESSION['id']; // Get the pharmaceutical company's ID from the session
        $query = "SELECT * FROM users WHERE id='$id' AND usertype='Pharmaceutical'";
        $result = mysqli_query($conn, $query);
        $pharmaceutical = mysqli_fetch_assoc($result);

        if ($pharmaceutical) {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pharmaceutical Company Information</title>
    <!-- Add your stylesheets and scripts here -->
</head>
<body>
    <h2>Edit Pharmaceutical Company Information</h2>
    <form action="" method="post" autocomplete="off">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $pharmaceutical['name']; ?>" required><br>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $pharmaceutical['username']; ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $pharmaceutical['email']; ?>" required><br>
        <label for="password">Password : </label>
        <input type="password" name="password" id = "password"  value="<?php echo $pharmaceutical['password'];?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>

<?php
        }
    }
} else {
    // Redirect to login page or show an error message
    header('Location: login.php');
    exit;
}
?>
