<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm đơn vị tính</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container my-5">
    <h1 class="text-center mb-4">Thêm đơn vị tính</h1>

    <form action="create-unit-process.php" method="POST" class="card p-4 shadow-sm">
      <div class="mb-3">
        <label for="name" class="form-label">Tên đơn vị tính:</label>
        <input type="text" name="name" id="name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Mô tả:</label>
        <textarea name="description" id="description" class="form-control" rows="4"></textarea>
      </div>

      <div class="d-flex justify-content-end">
        <a href="manage-unit.php" class="btn btn-light mr-3">Quay lại</a>
        <button type="submit" class="btn btn-success">Thêm</button>
      </div>
    </form>
  </div>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>