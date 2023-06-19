<?php
session_start();
$conn = mysqli_connect("localhost", "root", "","drug_dispensing");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>