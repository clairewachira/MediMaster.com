<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}
if(isset($_POST["submit"])){
 $name = $_POST["name"];
 $username = $_POST["username"];
 $email = $_POST["email"];
 $password = $_POST["password"];
 $usertype = $_POST["usertype"];
 $confirmpassword = $_POST["confirmpassword"];
 $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
 if(mysqli_num_rows($duplicate) > 0){
   echo
  "<script> alert('Username or Email Has Already Taken'); </script>";
 }
 else{
  if($password == $confirmpassword){
   $query = "INSERT INTO users VALUES('','$name','$username','$email','$password','$usertype')";
    mysqli_query($conn, $query);
    echo
      "<script> alert('Registration Successful'); </script>";
     }
      else{
       echo
            "<script> alert('Password Does Not Match'); </script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Registration</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    h2 {
      text-align: center;
    }

    form {
      max-width: 400px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #f2f2f2;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 3px;
      box-sizing: border-box;
    }

    button[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background-color: #45a049;
    }

    a {
      display: block;
      text-align: center;
      margin-top: 10px;
      color: #555;
    }
  </style>
</head>
<body>
  <h2>Registration</h2>
  <form action="" method="post" autocomplete="off">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="usertype">usertype : </label>
     <input type="text" name="usertype" id = "usertype" required value=""> <br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <label for="confirmpassword">Confirm Password:</label>
    <input type="password" name="confirmpassword" id="confirmpassword" required>

    <button type="submit" name="submit">Register</button>
  </form>
  <a href="login.php">Login</a>
</body>
</html>

