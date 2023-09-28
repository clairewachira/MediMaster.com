<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}
$feedbackMessage = ''; // Initialize the feedback message

if(isset($_POST["submit"])){
 $name = $_POST["name"];
 $username = $_POST["username"];
 $email = $_POST["email"];
 $password = $_POST["password"];
 $usertype = $_POST["usertype"];
 $confirmpassword = $_POST["confirmpassword"];
 $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
 if(mysqli_num_rows($duplicate) > 0){
  $feedbackMessage = "";
}
 else{
  if($password == $confirmpassword){
   $query = "INSERT INTO users (name, username, email, password, usertype) VALUES ('$name', '$username', '$email', '$password', '$usertype')";

    mysqli_query($conn, $query);
    $feedbackMessage = "User Registered Successfully.";

     }
      else{
        $feedbackMessage = "Password Does not match";

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
    #feedbackMessage {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            display: none;
        }
  </style>
   <script>
    function showFeedback(message) {
      var feedbackElement = document.getElementById("feedback");
      feedbackElement.textContent = message;
      feedbackElement.style.display = "block";
      setTimeout(function() {
        feedbackElement.style.display = "none";
      }, 5000); // Display the message for 5 seconds
    }
  </script>
</head>
<body>
  <h2>Registration</h2>
  <div class="feedback" id="feedbackMessage"><?php echo $feedbackMessage; ?></div>

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

    <input type="hidden" name="id" id="id" value="">

    <button type="submit" name="submit">Register</button>
  </form>
  <div id="feedback" style="display: none;"></div>
  <a href="login.php">Login</a>
  <script>
     // JavaScript to display the feedback message
     function displayFeedback() {
        const feedbackMessage = "<?php echo $feedbackMessage; ?>";
        const feedbackDiv = document.getElementById("feedbackMessage");

        if (feedbackMessage) {
            feedbackDiv.innerHTML = feedbackMessage;
            feedbackDiv.style.display = "block";

            setTimeout(function () {
                feedbackDiv.style.display = "none";
            }, 5000); // Display for 5 seconds, adjust as needed
        }
    }

    // Call the displayFeedback function when the page loads
    window.onload = displayFeedback;

  </script>

</body>
</html>

