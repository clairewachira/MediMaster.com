<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $pharmacyName = $_POST['pharmacyName'];
    $address = $_POST['address'];
    $phoneCode = $_POST['phoneCode'];
    $phone = $_POST['phone'];

    // Validate form data
    if (empty($pharmacyName) || empty($address) || empty($phoneCode) || empty($phone)) {
        echo "All fields are required";
        exit;
    }

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
        // Prepare and execute the SQL INSERT statement
        $sql = "INSERT INTO pharmacy (pharmacyName, address, phoneCode, phone) VALUES (:pharmacyName, :address, :phoneCode, :phone)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pharmacyName', $pharmacyName);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phoneCode', $phoneCode);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();

        echo "New record created successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $conn = null;
} else {
    echo "Invalid request";
}
?>
