<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Grocery Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <a href="dashboard.php">Dashboard</a>
    <a href="my_orders.php">My Orders</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>

    <!-- Category Links -->
    <h3>Categories</h3>
    <ul>
        <li><a href="dashboard.php">All Products</a></li>
        <li><a href="dashboard.php?category=Fruits">Fruits</a></li>
        <li><a href="dashboard.php?category=Vegetables">Vegetables</a></li>
        <li><a href="dashboard.php?category=Dairy">Dairy</a></li>
        <li><a href="dashboard.php?category=Bakery">Bakery</a></li>
    </ul>

</div>

<!-- Include the handler to show products -->
<?php include "dashboard_handler.php"; ?>

</body>
</html>
