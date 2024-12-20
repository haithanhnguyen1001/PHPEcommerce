<?php
include 'db.php';


$suppliers = $conn->query("SELECT * FROM supplier");
$products = $conn->query("SELECT * FROM product");

?>


<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tạo phiếu nhập hàng mới</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container my-5">
    <h1 class="text-center mb-4">Tạo phiếu nhập hàng mới</h1>

    <form action="create-receipt-process.php" method="POST" class="card p-4 shadow-sm">

      <div class="mb-3">
        <label for="supplier" class="form-label">Nhà cung cấp:</label>
        <select name="supplier_id" id="supplier" class="form-select" required>
          <option value="">Chọn nhà cung cấp</option>
          <?php while ($supplier = $suppliers->fetch_assoc()) { ?>
            <option value="<?php echo $supplier['id']; ?>">
              <?php echo $supplier['name']; ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="product" class="form-label">Sản phẩm:</label>
        <select name="product_id" id="product" class="form-select" required>
          <option value="">Chọn sản phẩm</option>
          <?php while ($product = $products->fetch_assoc()) { ?>
            <option value="<?php echo $product['id']; ?>">
              <?php echo $product['name']; ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Số lượng nhập:</label>
        <input type="text" name="quantity" id="quantity" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Đơn giá:</label>
        <input type="text" name="price" id="price" class="form-control" required>
      </div>

      <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-success">Tạo mới</button>
      </div>
    </form>
  </div>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>