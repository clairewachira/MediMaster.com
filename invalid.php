<?php
// Check if user is already logged in and has an invalid user type
    if ($userType !== "valid_user_type") {
      header("Location: login.php"); // Redirect to logout page to clear invalid session data
      exit; // Terminate further script execution
    }
  
// Redirect to login page or show an error message
echo "Invalid user type.";
?>