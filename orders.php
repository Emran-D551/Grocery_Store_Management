<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

include "db.php";

// Check if product_id is provided
if(!isset($_GET['product_id'])){
    echo "Invalid request!";
    exit();
}

$product_id = $_GET['product_id'];
$user_id = $_SESSION['user_id'];

// Insert order into database
$stmt = $conn->prepare("INSERT INTO orders (user_id, product_id, order_date) VALUES (?, ?, NOW())");
$stmt->bind_param("ii", $user_id, $product_id);

if($stmt->execute()){
    $message = "Order placed successfully!";
} else {
    $message = "Failed to place order. Try again.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order - Grocery Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2><?php echo $message; ?></h2>
    <p><a href="dashboard.php">Back to Dashboard</a></p>
</div>

</body>
</html>
