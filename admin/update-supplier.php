<?php
include 'db.php';

// Lấy ID sản phẩm
$supplierID = $_GET['id'];
$supplier = $conn->query("SELECT * FROM supplier WHERE id = $supplierID")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sửa thông tin nhà cung cấp</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container my-5">
    <h1 class="text-center mb-4">Sửa thông tin nhà cung cấp</h1>

    <form action="update-supplier-process.php" method="POST" class="card p-4 shadow-sm">
      <input type="hidden" name="id" value="<?php echo $supplier['id']; ?>">

      <div class="mb-3">
        <label for="name" class="form-label">Tên nhà cung cấp:</label>
        <input type="text" name="name" id="name" class="form-control" value="<?php echo $supplier['name']; ?>" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Mô tả:</label>
        <textarea name="description" id="description" class="form-control" rows="4"><?php echo $supplier['description']; ?></textarea>
      </div>
      <div class="d-flex justify-content-end">
        <a href="manage-supplier.php" class="btn btn-light mr-3">Quay lại</a>
        <button type="submit" class="btn btn-success">Cập nhật</button>
      </div>
    </form>
  </div>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>