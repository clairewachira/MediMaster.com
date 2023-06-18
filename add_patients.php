<?php
require_once("Connection.php");

$PatientSSN = "587690";
$Name = "Claire";
$Address = "Nairobi";
$Age = "18";


$sql = "INSERT INTO patient (PatientSSN, Name, Address, Age,)
VALUES ('587690' , 'Claire' , 'Nairobi' , '18')";

if ($conn -> query($sql) ===TRUE){
    echo "New record created successfully";
}else {
    echo "Error creating table: " . $conn -> error;
}
$conn -> close();
?>