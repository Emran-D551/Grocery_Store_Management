<?php
include "db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password']; // (Not hashed, as per requirement)

$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
  echo "Registration successful! <a href='index.php'>Login Here</a>";
} else {
  echo "Error: " . $conn->error;
}
$conn->close();
?>
