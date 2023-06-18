<?php
$patientName = $_POST['patientName'];
$Gender = $_POST['Gender'];
$dob= $_POST['dob'];
$SSN=$_POST['SSN'];
$Email= $_POST['Email'];
$phoneCode = $_POST['phoneCode'];
$phone= $_POST['phone'];
if (!empty($patientName)  || !empty($Gender) || !empty($dob) || !empty($SSN)  || !empty($Email)  || !empty($Phonecode)  ||  !empty($phone)){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database="drug_dispensing";
    $conn= new mysqli($servername, $username, $password,$database);
    if(mysqli_connect_error()){
        die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());
    }else{
        $SELECT = "SELECT email from Patients Where email = ? Limit 1";
        $INSERT = "INSERT into Patients (patientName, Gender, dob, SSN, Email, phoneCode, phone) 
        Values(?, ?, ?, ?, ?, ?, ?)"; 

        $stmt = $conn ->prepare($SELECT);
        $stmt->bind_param("s",$Email);
        $stmt->execute();
        $stmt->bind_result($Email);
        $stmt->store_result();
        $rnum=$stmt->num_rows;
        if($rnum==0){
            $stmt->close();
            $stmt = $conn-> prepare ($INSERT);
            $stmt->bind_param("sssssss", $patientName, $Gender, $dob, $SSN, $Email, $phoneCode, $phone);
            $stmt->execute();
            echo"New record created successfully";
        }else{
            echo"Someone already registered using this email";
        }
        $stmt->close();
        $conn->close();
    }
}else{
    echo"All fields are required";
    die();
}
?>