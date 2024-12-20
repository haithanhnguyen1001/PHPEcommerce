<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $unit_id = $_POST['unit_id'];

  $stmt = $conn->prepare("UPDATE product SET name = ?, description = ?, unit_id = ? WHERE id = ?");
  $stmt->bind_param("ssii", $name, $description, $unit_id, $id);
  $stmt->execute();

  header("Location: manage-product.php");
  exit();

  // echo "Cập nhật thành công! <a href='manage-role.php'>Quay lại danh sách</a>";
}
