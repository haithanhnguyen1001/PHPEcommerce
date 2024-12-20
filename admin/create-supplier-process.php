<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $description = $_POST['description'];

  $stmt = $conn->prepare("INSERT INTO supplier (name, description) VALUES (?, ?)");
  $stmt->bind_param("ss", $name, $description);
  $stmt->execute();

  header("Location: manage-supplier.php");
  exit();
}
