<?php
session_start();
// Check if the user is already logged in
if (isset($_SESSION['username'])) {
// Redirect to the appropriate user-specific page
redirectUser($_SESSION['usertype']);
}
// Check for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Retrieve and sanitize form data
$username = $_POST['username'];
$password = $_POST['password'];
$usertype = $_POST['usertype'];
// Connect to the database
$db = new mysqli('localhost', 'root', '', 'drug_dispensing');
// Check for database connection errors
if ($db->connect_error) {
     die('Connection failed: ' . $db->connect_error);
}
// Prepare and execute the query to fetch user details
$query = "SELECT id,username, usertype FROM users WHERE username = ? AND
password = ?"; $stmt = $db->prepare($query);
   $stmt->bind_param("ss", $username, $password);
   $stmt->execute();
   $stmt->store_result();
if ($stmt->num_rows === 1) {
// Fetch user details from the query result
   $stmt->bind_result($id, $username, $usertype);
   $stmt->fetch();
// Set session data
    $_SESSION['id'] = $id;
    $_SESSION['username'] = $username; 
    $_SESSION['usertype'] = $usertype;
// Redirect to the appropriate user-specific page
redirectUser($usertype);
} 
else {
// Invalid login credentials
$error = 'Invalid username or password.'; }
// Close the database connection
$db->close();
}
// Function to redirect user based on their usertype
function redirectUser($usertype) {
switch ($usertype) {
case 'Doctor':
header('Location: doctor.php');
exit;
case 'Patient':
header('Location: patient.php');
exit;
case 'Pharmacist':
     header('Location: pharmacist.php');
    exit;
case 'Pharmaceuticalcompany':
    header('Location: pharmaceuticalcompany.php');
    exit;
default:
header('Location: invalid.php');
exit; } 
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }

        h2 {
            text-align: center;
        }

        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>User Login</h2>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <label for="usertype">User Type:</label>
        <select name="usertype">
            <option value="Doctor">Doctor</option>
            <option value="Patient">Patient</option>
            <option value="Pharmacist">Pharmacist</option>
            <option value="Pharmaceuticalcompany">Pharmaceutical Company</option>
        </select>
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>

