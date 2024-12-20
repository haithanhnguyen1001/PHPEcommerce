<?php
include 'db.php';

// Lấy ID sản phẩm
$unitID = $_GET['id'];
$unit = $conn->query("SELECT * FROM unit WHERE id = $unitID")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sửa thông tin đơn vị tính</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container my-5">
    <h1 class="text-center mb-4">Sửa thông tin đơn vị tính</h1>

    <form action="update-unit-process.php" method="POST" class="card p-4 shadow-sm">
      <input type="hidden" name="id" value="<?php echo $unit['id']; ?>">

      <div class="mb-3">
        <label for="name" class="form-label">Tên đơn vị tính:</label>
        <input type="text" name="name" id="name" class="form-control" value="<?php echo $unit['name']; ?>" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Mô tả:</label>
        <textarea name="description" id="description" class="form-control" rows="4"><?php echo $unit['description']; ?></textarea>
      </div>
      <div class="d-flex justify-content-end">
        <a href="manage-unit.php" class="btn btn-light mr-3">Quay lại</a>
        <button type="submit" class="btn btn-success">Cập nhật</button>
      </div>
    </form>
  </div>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>