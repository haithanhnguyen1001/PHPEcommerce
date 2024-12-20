<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Nhận dữ liệu từ form
  $username = $_POST['username'];
  $password = $_POST['password'];
  $familyname = $_POST['familyname'];
  $firstname = $_POST['firstname'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $roleID = $_POST['role_id'];  // Lấy ID vai trò từ form

  // Cập nhật thông tin người dùng vào bảng user
  $stmt = $conn->prepare("INSERT INTO user (username, password, familyname, firstname, phone, email) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $username, $password, $familyname, $firstname, $phone, $email);
  $stmt->execute();

  // Lấy ID người dùng vừa được thêm vào
  $userID = $conn->insert_id;

  // Thêm vai trò người dùng vào bảng user_role
  $stmt = $conn->prepare("INSERT INTO user_role (user_id, role_id) VALUES (?, ?)");
  $stmt->bind_param("ii", $userID, $roleID);
  $stmt->execute();

  // Chuyển hướng về trang quản lý người dùng
  header("Location: manage-user.php");
  exit();
}
