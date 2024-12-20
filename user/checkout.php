<?php
include '../admin/db.php';
$cartID = $_GET['cart_id'];
$userID = $_GET['user_id'];

$currentDateTime = date('Y-m-d H:i:s');


$stmt = $conn->prepare("INSERT INTO `order` (customer_id, datetime) VALUES (?, ?)");
$stmt->bind_param("is", $userID, $currentDateTime);
$stmt->execute();

$orderID = $conn->insert_id;

$query = "
    SELECT p.id AS product_id, t.price, t.quantity
    FROM product AS p
    JOIN (
        SELECT cd.price, SUM(cd.quantity) AS quantity, cd.product_id
        FROM cart AS c
        JOIN cart_detail AS cd ON cd.cart_id = c.id
        WHERE c.user_id = ?
        GROUP BY cd.product_id
    ) AS t ON p.id = t.product_id
    LEFT JOIN image AS i ON i.product_id = p.id AND i.sort_order = 1;
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userID); // Gắn user_id vào truy vấn
$stmt->execute();
$result = $stmt->get_result();

// Lặp qua các sản phẩm trong giỏ hàng và chèn vào bảng order_detail
while ($row = $result->fetch_assoc()) {
  $productID = $row['product_id'];
  $price = $row['price'];
  $quantity = $row['quantity'];

  // Chèn vào bảng order_detail
  $insertQuery = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
  $insertStmt = $conn->prepare($insertQuery);
  $insertStmt->bind_param("iiii", $orderID, $productID, $quantity, $price);
  $insertStmt->execute();
}

$conn->query("DELETE FROM cart_detail WHERE cart_id = $cartID");


header("Location: index.php");
exit();
