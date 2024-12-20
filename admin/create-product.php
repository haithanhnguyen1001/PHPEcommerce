<?php
include 'db.php';

// Lấy danh sách tất cả vai trò
$units = $conn->query("SELECT * FROM unit");

?>


<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm sản phẩm mới</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container my-5">
    <h1 class="text-center mb-4">Thêm sản phẩm mới</h1>

    <form action="create-product-process.php" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
      <div class="mb-3">
        <label for="name" class="form-label">Product name:</label>
        <input type="text" name="name" id="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Description:</label>
        <input type="text" name="description" id="name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="unit" class="form-label">Đơn vị tính:</label>
        <select name="unit_id" id="unit" class="form-select" required>
          <option value="">Chọn đơn vị tính</option>
          <?php while ($unit = $units->fetch_assoc()) { ?>
            <option value="<?php echo $unit['id']; ?>">
              <?php echo $unit['name']; ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="images" class="form-label">Thêm hình ảnh mới:</label>
        <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
      </div>

      <!-- Khung preview hình ảnh -->
      <div class="mb-3">
        <label class="form-label">Preview hình ảnh:</label>
        <div id="preview-container" class="d-flex flex-wrap gap-2"></div>
      </div>

      <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-success">Thêm mới</button>
      </div>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- JavaScript để preview hình ảnh -->
  <script>
    document.getElementById('images').addEventListener('change', function(event) {
      const files = event.target.files;
      const previewContainer = document.getElementById('preview-container');
      previewContainer.innerHTML = ''; // Xóa nội dung preview cũ

      Array.from(files).forEach(file => {
        if (file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = file.name;
            img.style.width = '100px';
            img.style.height = '100px';
            img.style.objectFit = 'cover';
            img.className = 'rounded border';
            previewContainer.appendChild(img);
          };
          reader.readAsDataURL(file);
        }
      });
    });
  </script>
</body>

</html>