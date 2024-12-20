<?php
include 'db.php';

if (isset($_GET['id'])) {
  $unitID = $_GET['id'];

  // Xóa sản phẩm (xóa cả ảnh nhờ ràng buộc FOREIGN KEY)
  $conn->query("DELETE FROM unit WHERE id = $unitID");

  header("Location: manage-unit.php");
  exit();
}
