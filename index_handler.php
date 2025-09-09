<?php

session_start();
include "db.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
  {
  $user = $result->fetch_assoc();
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['name'] = $user['name'];
  header("Location: dashboard.php");
} else 
{
  echo "Invalid email or password! <a href='index.php'>Try again</a>";
}
$conn->close();
?>
