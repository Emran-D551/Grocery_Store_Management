<?php
include "db.php";

// Get selected category
$category = isset($_GET['category']) ? $_GET['category'] : "";

// Build query
if($category != ""){
    $stmt = $conn->prepare("SELECT * FROM products WHERE category=?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $products = $stmt->get_result();
} else {
    $products = $conn->query("SELECT * FROM products");
}

// Display products in a table
echo "<div class='container'>";
echo "<h3>Products</h3>";
echo "<table border='1' cellpadding='5' style='width:100%; text-align:center;'>";
echo "<tr>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Order</th>
      </tr>";

if($products->num_rows > 0){
    while($row = $products->fetch_assoc()){
        echo "<tr>
                <td>".$row['name']."</td>
                <td>".$row['category']."</td>
                <td>".$row['price']."</td>
                <td><a href='orders.php?product_id=".$row['id']."'>Order</a></td>
              </tr>";
    }
} 
else 
{
    echo "<tr><td colspan='4'>No products found</td></tr>";
}

echo "</table>";
echo "</div>";
?>
