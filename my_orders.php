<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include "db.php";

$user_id = $_SESSION['user_id'];

// Get all orders placed by the logged-in user
$stmt = $conn->prepare("
    SELECT o.id AS order_id, p.name, p.category, p.price, o.order_date 
    FROM orders o
    JOIN products p ON o.product_id = p.id
    WHERE o.user_id=?
    ORDER BY o.order_date DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders - Grocery Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <a href="dashboard.php">Dashboard</a>
    <a href="my_orders.php">My Orders</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h2>My Orders</h2>

    <table border="1" cellpadding="5" style="width:100%; text-align:center;">
        <tr>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Order Date</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row['name']."</td>
                        <td>".$row['category']."</td>
                        <td>".$row['price']."</td>
                        <td>".$row['order_date']."</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>You have not placed any orders yet.</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
