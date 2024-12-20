<?php
include 'db.php';

if (isset($_GET['id'])) {
  $productID = $_GET['id'];

  // Xóa sản phẩm (xóa cả ảnh nhờ ràng buộc FOREIGN KEY)
  $conn->query("DELETE FROM image WHERE product_id = $productID");
  $conn->query("DELETE FROM product WHERE id = $productID");

  header("Location: manage-product.php");
  exit();
}
