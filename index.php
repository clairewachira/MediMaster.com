
<?php
require 'config.php';
if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Index</title>
    <style>
      .welcome {
        position: absolute;
        top: 10px;
        right: 10px;
      }
    </style>
  </head>
  <body>
    <div class="welcome">
      <?php echo "Welcome, " . $row["name"]; ?>
      <a href="logout.php">Logout</a>
    </div>
    <h1>Home Page</h1>
  </body>
</html>
