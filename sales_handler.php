<?php
// =====================
// 1. Show All Sales
// =====================
$stmt = $conn->prepare("
    SELECT o.id, u.name AS user_name, p.name AS product_name, p.category, p.price, o.order_date 
    FROM orders o
    JOIN products p ON o.product_id = p.id
    JOIN users u ON o.user_id = u.id
    ORDER BY o.order_date DESC
");
$stmt->execute();
$result = $stmt->get_result();

$total_sales = 0;

echo "<h3>All Sales</h3>";
echo "<table border='1' cellpadding='5' style='width:100%; text-align:center;'>
        <tr>
            <th>User</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Order Date</th>
        </tr>";

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td>".$row['user_name']."</td>
                <td>".$row['product_name']."</td>
                <td>".$row['category']."</td>
                <td>".$row['price']."</td>
                <td>".$row['order_date']."</td>
              </tr>";
        $total_sales += $row['price'];
    }
    echo "<tr>
            <td colspan='3'><b>Total Sales</b></td>
            <td colspan='2'><b>".$total_sales." BDT</b></td>
          </tr>";
} else {
    echo "<tr><td colspan='5'>No sales yet.</td></tr>";
}
echo "</table><br>";
 

// =====================
// 2. Category-wise Sales
// =====================
$cat_stmt = $conn->prepare("
    SELECT p.category, SUM(p.price) AS total_sales
    FROM orders o
    JOIN products p ON o.product_id = p.id
    GROUP BY p.category
");
$cat_stmt->execute();
$cat_result = $cat_stmt->get_result();

echo "<h3>Category-wise Sales</h3>";
echo "<table border='1' cellpadding='5' style='width:100%; text-align:center;'>
        <tr>
            <th>Category</th>
            <th>Total Sales (BDT)</th>
        </tr>";

if($cat_result->num_rows > 0){
    while($row = $cat_result->fetch_assoc()){
        echo "<tr>
                <td>".$row['category']."</td>
                <td>".$row['total_sales']."</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='2'>No sales yet.</td></tr>";
}
echo "</table><br>";


// =====================
// 3. User-wise Sales
// =====================
$user_stmt = $conn->prepare("
    SELECT u.name AS user_name, SUM(p.price) AS total_sales
    FROM orders o
    JOIN products p ON o.product_id = p.id
    JOIN users u ON o.user_id = u.id
    GROUP BY u.id
");
$user_stmt->execute();
$user_result = $user_stmt->get_result();

echo "<h3>User-wise Sales</h3>";
echo "<table border='1' cellpadding='5' style='width:100%; text-align:center;'>
        <tr>
            <th>User</th>
            <th>Total Sales (BDT)</th>
        </tr>";

if($user_result->num_rows > 0){
    while($row = $user_result->fetch_assoc()){
        echo "<tr>
                <td>".$row['user_name']."</td>
                <td>".$row['total_sales']."</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='2'>No sales yet.</td></tr>";
}
echo "</table>";
?>
