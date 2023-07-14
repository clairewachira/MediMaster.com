<?php
require_once 'config.php';

// Check if the user is logged in as a patient
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'patient') {
    // Check if the request is a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_SESSION['id']; // Get the patients's ID from the session
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Perform the SQL update query to edit the patient's information
        $query = "UPDATE users SET name='$name', username='$username', email='$email' password='$password' WHERE id='$id' AND usertype='patient'";
        mysqli_query($conn, $query);

        echo "<script>alert('User information updated successfully');</script>";
    } else {
        // Retrieve the patient's information from the database based on the ID
        $id = $_SESSION['id']; // Get the patient's ID from the session
        $query = "SELECT * FROM users WHERE id='$id' AND usertype='patient'";
        $result = mysqli_query($conn, $query);
        $pharmaceutical = mysqli_fetch_assoc($result);

        if ($patient) {
?>

<!DOCTYPE html> 
<html> 
<head>
    <title>Patient Dashboard</title>
    <style>
        body {
            display: flex;
            justify-content: flex-end;
            align-items: flex-start;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: right;
        }

        .welcome-message,
        .logout-link {
            margin-top: 10px;
        }
    </style>
</head> 
<body>
    <div class="container"> 
        <h1>Patient Dashboard</h1> 
        <p class="username">Patient <?php echo $username; ?></p>
        <p class="welcome-message">Welcome, Patient <?php echo $username; ?>!</p>
        <!-- Add your patient-specific content here -->
        <a href="patientedit.php">Edit Patient Information</a>
        <br>
        <a href="patientdelete.php">Delete Patient Information</a>
        <br>
        <a class="logout-link" href="?logout=true">Logout</a>
    </div>
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

    