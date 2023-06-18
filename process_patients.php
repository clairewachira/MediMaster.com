<?php
//print_r($_POST)

$servername = "localhost";
$username = "root";
$password = "";
$database="drug_dispensing";


$conn = mysqli_connect($servername, $username, $password,$database);

if (!$conn){
    die("Connection failed: " .mysqli_connect_error());
}
echo "Connnected successfully";

$SSN = $_POST["SSN"]
$F_name = $_POST["F_name"];
$S_name = $_POST("S_name");
//echo $ssn;
$sql = "INSERT INTO register(SSN, F_name, S_name)
VALUES ('$SSN','$F_name','$S_name')";

if($conn -> query($sql) == TRUE){
    echo "New record success"
}else{
    echo "warning" .$sql . "<br>" . $conn->error;
}
?>