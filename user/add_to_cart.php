











<?php
include '../admin/db.php';
// Giả sử user_id = 1
$user_id = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $productID = $_POST['product_id'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];

  // Truy vấn để lấy cart_id từ bảng cart dựa trên user_id
  $stmt = $conn->prepare("SELECT id FROM cart WHERE user_id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  // Kiểm tra nếu đã có giỏ hàng
  if ($result->num_rows > 0) {
    $cart = $result->fetch_assoc();
    $cart_id = $cart['id'];

    // Thêm sản phẩm vào bảng cart_detail
    $stmt = $conn->prepare("INSERT INTO cart_detail (price, quantity, cart_id, product_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiii", $price, $quantity, $cart_id, $productID);
    $stmt->execute();

    // Chuyển hướng người dùng về trang sản phẩm
    header("Location: product.php?id=" . $productID);
    exit();
  } else {
    // Nếu không có giỏ hàng, có thể bạn muốn thông báo hoặc làm gì đó
    // Ví dụ: thông báo lỗi hoặc chuyển hướng về trang khác
    echo "No cart found for the user.";
  }
}
?>
