<?php
include 'db.php';

$orderID = $_GET['id'];

// Truy vấn thông tin hóa đơn
$order = $conn->query("
    SELECT `order`.id, `user`.`familyname`,`user`.`firstname`,`user`.`phone`, `order`.datetime
FROM `order`
JOIN `user` ON `order`.customer_id = `user`.id
    WHERE `order`.id = $orderID
")->fetch_assoc();

// Truy vấn chi tiết sản phẩm
$details = $conn->query("SELECT p.name,u.name as unit, od.quantity, od.price
FROM `order_details` as od
JOIN product as p on p.id = od.product_id
JOIN unit as u on p.unit_id = u.id
WHERE od.order_id = $orderID");

$totalQuantity = 0; // Tổng số lượng sản phẩm
$sum = 0; // Tổng tiền
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thông tin phiếu mua hàng</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container my-5">
    <h1 class="text-center mb-4">Thông tin phiếu nhập hàng</h1>

    <div class="card p-4 shadow-sm">
      <p><strong>ID Hóa đơn:</strong> <?php echo $order['id']; ?></p>
      <p><strong>Tên khách hàng:</strong> <?php echo $order['familyname']; ?> <?php echo $order['firstname']; ?></p>
      <p><strong>SDT:</strong> <?php echo $order['phone']; ?></p>
      <p><strong>Ngày mua hàng:</strong> <?php echo $order['datetime']; ?></p>

      <!-- Bảng danh sách sản phẩm -->
      <table class="table table-bordered">
        <thead>
          <tr class="text-center">
            <th>STT</th>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Đơn vị tính</th>
            <th>Thành tiền</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $stt = 1;
          while ($item = $details->fetch_assoc()) {
            $subtotal = $item['quantity'] * $item['price']; // Thành tiền từng sản phẩm
            $sum += $subtotal; // Cộng vào tổng tiền
            $totalQuantity += $item['quantity']; // Cộng số lượng sản phẩm
          ?>
            <tr class="text-center">
              <td><?php echo $stt++; ?></td>
              <td><?php echo $item['name']; ?></td>
              <td><?php echo $item['quantity']; ?></td>
              <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VND</td>
              <td><?php echo $item['unit']; ?></td>
              <td><?php echo number_format($subtotal, 0, ',', '.'); ?> VND</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

      <!-- Hiển thị tổng số lượng và tổng tiền -->
      <div class="mt-4">
        <p><strong>Tổng số lượng sản phẩm:</strong> <?php echo $totalQuantity; ?></p>
        <p><strong>Tổng tiền:</strong> <?php echo number_format($sum, 0, ',', '.'); ?> VND</p>
      </div>
      <div class="text-end">
        <a href="manage-order.php" class="btn btn-secondary">Quay lại</a>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>