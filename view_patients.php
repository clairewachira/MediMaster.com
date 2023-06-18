<?php
require_once ("Connection.php");
$sql= "SELECT * FROM register";
$results = $conn->query($sql);
$row = $results->fetch_assoc();
print_r($results);
?>