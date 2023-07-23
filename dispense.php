<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing";

// Create a new PDO connection
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

// Set PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 //Ensure $userId is set and not null
$userId = $_SESSION['user_id'] ?? null;

// Check if a patient ID is provided in the form submission
if ( $userId !== null && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prescriptionId'], $_POST['drugName'], $_POST['price'], $_POST['dispense'])) {
    // Retrieve the form data
    $prescriptionId = $_POST['prescriptionId'];
    $drugName = $_POST['drugName'];
    $price = $_POST['price'];
    $dateDispensed = date("Y-m-d");
    
    // Replace :userId with the actual user ID of the patient
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;


    // Insert the dispensed drug into dispensed_drugs table
    $stmt = $conn->prepare("INSERT INTO dispensed_drugs (prescription_id, user_id, drug_name, price, date_dispensed) VALUES (:prescriptionId, :userId, :drugName, :price, :dateDispensed)");
    $stmt->bindParam(':prescriptionId', $prescriptionId);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':drugName', $drugName);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':dateDispensed', $dateDispensed);
    $stmt->execute();

    echo "Drug dispensed successfully";
}
$query = "SELECT prescriptions.*, drugs.drugName FROM prescriptions
          INNER JOIN drugs ON prescriptions.drug_name = drugs.drugId
          WHERE prescriptions.user_id = :userId";
$stmt = $conn->prepare($query);
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$prescriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
