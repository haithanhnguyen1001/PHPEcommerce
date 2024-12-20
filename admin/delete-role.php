<?php
include 'db.php';

if (isset($_GET['id'])) {
  $roleID = $_GET['id'];

  // Xóa sản phẩm (xóa cả ảnh nhờ ràng buộc FOREIGN KEY)
  $conn->query("DELETE FROM role WHERE id = $roleID");

  header("Location: manage-role.php");
  exit();
}
