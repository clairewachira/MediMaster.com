<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $drugName = $_POST['drugName'];
    $drugFormula = $_POST['drugFormula'];
    $price = $_POST['price'];

    // Validate form data
    if (empty($drugName) || empty($drugFormula) || empty($price)) {
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
        $sql = "INSERT INTO drugs (drugName, drugFormula, price) VALUES (:drugName, :drugFormula, :price)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':drugName', $drugName);
        $stmt->bindParam(':drugFormula', $drugFormula);
        $stmt->bindParam(':price', $price);
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
