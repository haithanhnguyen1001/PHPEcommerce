<?php
include 'db.php';
$productID = $_GET['product_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Nhận dữ liệu từ form
  $sort_order = $_POST['sort_order'];
  $uploadDir = '../images/product/'; // Thư mục lưu ảnh

  // Kiểm tra và xử lý upload ảnh
  if (!empty($_FILES['images']['name'][0])) {
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
        break;
      }
    }
  }

  // Chuyển hướng về trang quản lý sản phẩm
  header("Location: update-product.php?id=" . $productID);
  exit();
}
