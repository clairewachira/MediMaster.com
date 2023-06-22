<?php
require_once 'config.php';

// Check if the user is logged in as a pharmacist
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'Pharmacist') {
    // Check if the request is a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_SESSION['id']; // Get the pharmacist's ID from the session
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Perform the SQL update query to edit the pharmacist's information
        $query = "UPDATE users SET name='$name', username='$username', email='$email' password='$password' WHERE id='$id' AND usertype='Pharmacist'";
        mysqli_query($conn, $query);

        echo "<script>alert('User information updated successfully');</script>";
    } else {
        // Retrieve the pharmacist's information from the database based on the ID
        $id = $_SESSION['id']; // Get the pharmacist's ID from the session
        $query = "SELECT * FROM users WHERE id='$id' AND usertype='Pharmacist'";
        $result = mysqli_query($conn, $query);
        $pharmacist = mysqli_fetch_assoc($result);

        if ($pharmacist) {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pharmacist Information</title>
    <!-- Add your stylesheets and scripts here -->
</head>
<body>
    <h2>Edit Pharmacist Information</h2>
    <form action="" method="post" autocomplete="off">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $pharmacist['name']; ?>" required><br>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $pharmacist['username']; ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $pharmacist['email']; ?>" required><br>
        <label for="password">Password : </label>
        <input type="password" name="password" id = "password"  value="<?php echo $pharmacist['password'];?>" required><br>
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
