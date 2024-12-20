<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Nhận dữ liệu từ form
  $userID = $_POST['id'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $familyname = $_POST['familyname'];
  $firstname = $_POST['firstname'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $roleID = $_POST['role_id'];  // Lấy ID vai trò từ form

  // Cập nhật thông tin người dùng
  $stmt = $conn->prepare("UPDATE user SET username = ?, password = ?, familyname = ?, firstname = ?, phone = ?, email = ? WHERE id = ?");
  $stmt->bind_param("ssssssi", $username, $password, $familyname, $firstname, $phone, $email, $userID);
  $stmt->execute();
  // Cập nhật vai trò người dùng
  $stmt = $conn->prepare("UPDATE user_role SET role_id = ? WHERE user_id = ?");
  $stmt->bind_param("ii", $roleID, $userID);
  $stmt->execute();

  // Chuyển hướng về trang quản lý người dùng
  header("Location: manage-user.php");
  exit();
}
