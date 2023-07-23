<?php
session_start();

// Check if the user is logged in as a doctor
if (isset($_SESSION['username']) && $_SESSION['usertype'] === 'Doctor') {
    $username = $_SESSION['username'];
} else {
    // Redirect to login page or show an error message
    header('Location: login.php');
    exit;
}

// Check if logout request is triggered
if (isset($_GET['logout'])) {
    // Destroy the session and redirect to the login page
    session_destroy();
    header('Location: login.php');
    exit;
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the entered patient ID or name
    $searchInput = $_POST['searchInput'];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "drug_dispensing";

    // Create a new PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        // Prepare the search query for the user
        $query = "SELECT * FROM users WHERE id = :searchInput OR name = :searchInput";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':searchInput', $searchInput);
        $stmt->execute();

        // Fetch the user details
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // User found, display the details
            $userID = $user['id'];
            $userName = $user['name'];
            $userEmail = $user['email'];
            // Other user details

            echo "User found:<br>";
            echo "User ID: $userID<br>";
            echo "User Name: $userName<br>";
            echo "Email: $userEmail<br>";

            // Retrieve prescribed drugs for the specific patient
            $query = "SELECT prescriptions.*, drugs.drugName FROM prescriptions
                      INNER JOIN drugs ON prescriptions.drug_name = drugs.drugId
                      INNER JOIN users ON prescriptions.user_id = users.id
          WHERE users.name = :searchInput";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':searchInput', $searchInput);
            $stmt->execute();
            $prescriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($prescriptions)) {
                echo "Prescribed Drugs:<br>";
                foreach ($prescriptions as $prescription) {
                    echo "Prescription ID: " . $prescription['prescription_id'] . "<br>";
                    echo "Drug Name: " . $prescription['drugName'] . "<br>";
                    echo "Frequency: " . $prescription['frequency'] . "<br>";
                    // Display other prescription details
                    echo "<br>";
                }
            } else {
                echo "No prescriptions found for the user.";
            }
        } else {
            echo "User not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $conn = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search User Records</title>
</head>
<body>
    <h1>Search User Records</h1>
    <form method="POST" action="search_patient.php">
        <input type="text" name="searchInput" placeholder="Enter user ID or name" required>
        <button type="submit">Search</button>
    </form>
</body>
</html>
