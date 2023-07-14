<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $action = $_POST['action'];
    $drugId = $_POST['drugId'];
    $drugName = $_POST['drugName'];
    $drugFormula = $_POST['drugFormula'];
    $price = $_POST['price'];

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
        if ($action === 'add') {
            // Insert a new drug
            $stmt = $conn->prepare("INSERT INTO drugs (drugName, drugFormula, price) VALUES (:drugName, :drugFormula, :price)");
            $stmt->bindParam(':drugName', $drugName);
            $stmt->bindParam(':drugFormula', $drugFormula);
            $stmt->bindParam(':price', $price);
            $stmt->execute();
            echo "Drug added successfully";
        } elseif ($action === 'update') {
            // Update the drug
            $stmt = $conn->prepare("UPDATE drugs SET drugName = :drugName, drugFormula = :drugFormula, price = :price WHERE drugId = :drugId");
            $stmt->bindParam(':drugName', $drugName);
            $stmt->bindParam(':drugFormula', $drugFormula);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':drugId', $drugId);
            $stmt->execute();
            echo "Drug updated successfully";
        } elseif ($action === 'delete') {
            // Delete the drug
            $stmt = $conn->prepare("DELETE FROM drugs WHERE drugId = :drugId");
            $stmt->bindParam(':drugId', $drugId);
            $stmt->execute();
            echo "Drug deleted successfully";
        } else {
            echo "Invalid action";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $conn = null;
} else {
    echo "Invalid request";
}
?>
