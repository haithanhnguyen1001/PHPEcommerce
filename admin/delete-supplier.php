<?php
include 'db.php';

if (isset($_GET['id'])) {
  $supplierID = $_GET['id'];

  // Xóa sản phẩm (xóa cả ảnh nhờ ràng buộc FOREIGN KEY)
  $conn->query("DELETE FROM supplier WHERE id = $supplierID");

  header("Location: manage-supplier.php");
  exit();
}
