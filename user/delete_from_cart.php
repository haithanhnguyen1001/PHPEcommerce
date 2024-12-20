<?php
include '../admin/db.php';


$cartID = $_GET['cart_id'];
$productID = $_GET['product_id'];

// Xóa sản phẩm (xóa cả ảnh nhờ ràng buộc FOREIGN KEY)
$conn->query("DELETE FROM cart_detail WHERE cart_id = $cartID and product_id = $productID");

header("Location: cart.php");
exit();
