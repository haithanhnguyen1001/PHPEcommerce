<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Nhận dữ liệu từ form
  $supplierID = $_POST['supplier_id'];
  $productID = $_POST['product_id'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $currentDateTime = date('Y-m-d H:i:s');

  $stmt = $conn->prepare("INSERT INTO receipt (supplier_id, datetime) VALUES (?, ?)");
  $stmt->bind_param("is", $supplierID, $currentDateTime);
  $stmt->execute();

  $receiptID = $conn->insert_id;

  $stmt = $conn->prepare("INSERT INTO receipt_details (receipt_id, product_id, price, quantity) VALUES (?, ?,?,?)");
  $stmt->bind_param("iiii", $receiptID, $productID, $price, $quantity);
  $stmt->execute();


  $stmt = $conn->prepare("INSERT INTO price (product_id, price, datetime) VALUES (?,?,?)");
  $stmt->bind_param("iis", $productID, $price, $currentDateTime);
  $stmt->execute();


  // Chuyển hướng về trang quản lý người dùng
  header("Location: manage-receipt.php");
  exit();
}
