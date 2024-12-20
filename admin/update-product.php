<?php
include 'db.php';

$productID = $_GET['id'];
$product = $conn->query("SELECT * from product where id = $productID")->fetch_assoc();


$units = $conn->query("SELECT * FROM unit");

$images = $conn->query("SELECT * FROM image where product_id = $productID");

?>



<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sửa thông tin sản phẩm</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container my-5">
    <h1 class="text-center mb-4">Sửa thông tin sản phẩm</h1>

    <form action="update-product-process.php" method="POST" class="card p-4 shadow-sm">
      <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

      <div class="mb-3">
        <label for="name" class="form-label">Product name:</label>
        <input type="text" name="name" id="name" class="form-control" value="<?php echo $product['name']; ?>" required>
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Description:</label>
        <input type="text" name="description" id="name" class="form-control" value="<?php echo $product['description']; ?>" required>
      </div>


      <div class="mb-3">
        <label for="unit" class="form-label">Đơn vị tính:</label>
        <select name="unit_id" id="unit" class="form-select" required>
          <option value="">Chọn đơn vị tính</option>
          <?php while ($unit = $units->fetch_assoc()) { ?>
            <option value="<?php echo $unit['id']; ?>" <?php echo ($unit['id'] == $product['unit_id']) ? 'selected' : ''; ?>>
              <?php echo $unit['name']; ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <!-- Hiển thị bảng hình ảnh -->
      <div class="card mb-4 p-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="mb-0">Danh sách hình ảnh</h5>
          <a class="btn btn-primary" href="add-image-product.php?product_id=<?php echo $product['id']; ?>">+ Thêm</a>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr class="text-center">
              <th>STT</th>
              <th>Hình ảnh</th>
              <th>Sort Order</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $stt = 1;
            while ($image = $images->fetch_assoc()) { ?>
              <tr class="text-center">
                <td><?php echo $stt++; ?></td>
                <td>
                  <img src="<?php echo $image['path']; ?>" alt="Hình ảnh sản phẩm" class="img-thumbnail" style="width: 100px; height: auto;">
                </td>
                <td><?php echo $image['sort_order']; ?></td>
                <td>
                  <!-- Nút xóa -->
                  <a href="delete-image-product.php?image_id=<?php echo $image['id']; ?>&product_id=<?php echo $productID; ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa hình ảnh này?');">Xóa</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-success">Cập nhật</button>
      </div>
    </form>
  </div>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>