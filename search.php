<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}
include "db.php";

$q = $_GET['q'];
$results = $conn->query("SELECT * FROM products WHERE name LIKE '%$q%'");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Search Results</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Search Results for "<?php echo $q; ?>"</h2>
  <a href="dashboard.php">Back to Dashboard</a>
  <table border="1" cellpadding="5">
    <tr><th>Name</th><th>Category</th><th>Price</th><th>Order</th></tr>
    <?php
    if ($results->num_rows > 0) {
      while($row = $results->fetch_assoc()) {
        echo "<tr>
                <td>".$row['name']."</td>
                <td>".$row['category']."</td>
                <td>".$row['price']."</td>
                <td><a href='orders.php?product_id=".$row['id']."'>Order</a></td>
              </tr>";
      }
    } else 
    {
      echo "<tr><td colspan='4'>No products found</td></tr>";
    }
    ?>
  </table>
</body>
</html>
