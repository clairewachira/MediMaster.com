<?php
require_once("Connection.php");
$name="fentanyl";
$price="100";
$formula="C22H28N2O";

$sql="INSERT INTO drugs(name,price,formula)
VALUES('femtanyl','100','C22H28N20')";

if($conn -> query($sql)===TRUE){
    echo "Table Drugs created successfully";
}else{
    echo"Error creating table: " .$conn->error;
}

$conn->close();
?>