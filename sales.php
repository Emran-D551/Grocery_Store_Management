<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

include "db.php";
?>




<!DOCTYPE html>
<html>
<head>
    <title>Sales - Grocery Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <a href="dashboard.php">Dashboard</a>
    <a href="my_orders.php">My Orders</a>
    <a href="sales.php">Sales</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h2>Sales Report</h2>
    <?php include "sales_handler.php"; ?>
</div>

</body>
</html>
