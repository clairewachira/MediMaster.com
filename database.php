<?php
$servername = "localhost";
$username = "root";
$password = "Kosiisamazing7.";
$databasename = "drug_dispensing";

// Create connection
$conn = new mysqli($servername, $username, $password, $databasename);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE patient (
id INT(6) PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
SSN INT(10),
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Patients created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>