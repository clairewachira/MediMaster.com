<?php
// Retrieve the data from the form
$doctorName = $_POST['doctorName'];
$ssn = $_POST['SSN'];
$dob = $_POST['dob'];
$years_of_experience = $_POST['years_of_experience'];
$speciality = $_POST['speciality'];
$user_password = $_POST['password'];

// Perform any necessary data validation here

// Connect to your database (assuming you have one)
$servername = "localhost";
$username = "root";
$db_password = "";
$dbname = "drug_dispensing";

$conn = new mysqli($servername, $username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL query to insert the data into the database
$sql = "INSERT INTO doctors(doctorName, ssn, dob, years_of_experience, speciality, password)
        VALUES ('$doctorName', '$ssn', '$dob', '$years_of_experience', '$speciality' , '$user_password')";

if ($conn->query($sql) === TRUE) {
    echo "New record inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
