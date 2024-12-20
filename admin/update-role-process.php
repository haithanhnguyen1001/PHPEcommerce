<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];


  $stmt = $conn->prepare("UPDATE role SET name = ?, description = ? WHERE id = ?");
  $stmt->bind_param("ssi", $name, $description, $id);
  $stmt->execute();

  header("Location: manage-role.php");
  exit();

  // echo "Cập nhật thành công! <a href='manage-role.php'>Quay lại danh sách</a>";
}
