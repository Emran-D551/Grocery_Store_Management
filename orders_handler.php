<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

include "db.php";

$user_id = $_SESSION['user_id'];

$orders = $conn->prepare("SELECT o.id, p.name, p.category, p.price, o.order_date 
                          FROM orders o 
                          JOIN products p ON o.product_id = p.id
                          WHERE o.user_id=? ORDER BY o.order_date DESC");
$orders->bind_param("i", $user_id);
$orders->execute();
$result = $orders->get_result();

echo "<div class='container'>";
echo "<h2>My Orders</h2>";
echo "<table border='1' cellpadding='5' style='width:100%; text-align:center;'>
        <tr>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Order Date</th>
        </tr>";

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td>".$row['name']."</td>
                <td>".$row['category']."</td>
                <td>".$row['price']."</td>
                <td>".$row['order_date']."</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No orders found</td></tr>";
}

echo "</table>";
echo "</div>";
?>
