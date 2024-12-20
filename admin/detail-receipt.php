<?php
include 'db.php';

$receiptID = $_GET['id'];

// Truy vấn thông tin hóa đơn
$receipt = $conn->query("
    SELECT receipt.*, supplier.name 
    FROM receipt
    JOIN supplier ON receipt.supplier_id = supplier.id 
    WHERE receipt.id = $receiptID
")->fetch_assoc();

// Truy vấn chi tiết sản phẩm
$details = $conn->query("
    SELECT receipt_details.*, product.name, unit.name as unit
    FROM receipt_details
    JOIN product ON receipt_details.product_id = product.id
    JOIN unit ON product.unit_id = unit.id
    WHERE receipt_details.receipt_id = $receiptID
");

$totalQuantity = 0; // Tổng số lượng sản phẩm
$sum = 0; // Tổng tiền
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thông tin phiếu nhập hàng</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container my-5">
    <h1 class="text-center mb-4">Thông tin phiếu nhập hàng</h1>

    <div class="card p-4 shadow-sm">
      <p><strong>ID Hóa đơn:</strong> <?php echo $receipt['id']; ?></p>
      <p><strong>Nhà cung cấp:</strong> <?php echo $receipt['name']; ?></p>
      <p><strong>Ngày nhập hàng:</strong> <?php echo $receipt['datetime']; ?></p>

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
        <a href="manage-receipt.php" class="btn btn-secondary">Quay lại</a>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>