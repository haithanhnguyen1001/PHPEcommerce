<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Nhận dữ liệu từ form
  $name = $_POST['name'];
  $description = $_POST['description'];
  $unitID = $_POST['unit_id'];
  $uploadDir = '../images/product/'; // Thư mục lưu ảnh

  // Thêm sản phẩm vào bảng `product`
  $stmt = $conn->prepare("INSERT INTO product (name, description, unit_id) VALUES (?, ?, ?)");
  $stmt->bind_param("ssi", $name, $description, $unitID);
  $stmt->execute();

  // Lấy ID sản phẩm vừa được thêm vào
  $productID = $conn->insert_id;

  // Kiểm tra và xử lý upload ảnh
  if (!empty($_FILES['images']['name'][0])) {
    $sort_order = 1; // Biến sắp xếp thứ tự ảnh
    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
      // Lấy phần mở rộng file và tạo tên duy nhất
      $extension = pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION);
      $uniqueName = uniqid('img_', true) . '.' . $extension;
      $filePath = $uploadDir . $uniqueName;


      // Di chuyển file vào thư mục đích
      if (move_uploaded_file($tmp_name, $filePath)) {
        // Lưu thông tin ảnh vào bảng `image`
        $stmt = $conn->prepare("INSERT INTO image (path, product_id, sort_order) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $filePath, $productID, $sort_order);
        $stmt->execute();
        $sort_order++;
      }
    }
  }

  // Chuyển hướng về trang quản lý sản phẩm
  header("Location: manage-product.php");
  exit();
}
