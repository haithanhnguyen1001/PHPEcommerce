<?php
include 'db.php';

// Lấy ID sản phẩm
$userID = $_GET['id'];
$user = $conn->query("SELECT user.*, role.name AS role
FROM user
JOIN user_role ON user.id = user_role.user_id
JOIN role ON role.id = user_role.role_id
WHERE user.id = $userID;")->fetch_assoc();

// Lấy danh sách tất cả vai trò
$roles = $conn->query("SELECT * FROM role");

?>



<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sửa thông tin nguời dùng</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container my-5">
    <h1 class="text-center mb-4">Sửa thông tin nguời dùng</h1>

    <form action="update-user-process.php" method="POST" class="card p-4 shadow-sm">
      <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

      <div class="mb-3">
        <label for="name" class="form-label">Username:</label>
        <input type="text" name="username" id="name" class="form-control" value="<?php echo $user['username']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Password:</label>
        <input type="text" name="password" id="name" class="form-control" value="<?php echo $user['password']; ?>" required>
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Family Name:</label>
        <input type="text" name="familyname" id="name" class="form-control" value="<?php echo $user['familyname']; ?>" required>
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">First Name:</label>
        <input type="text" name="firstname" id="name" class="form-control" value="<?php echo $user['firstname']; ?>" required>
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Phone:</label>
        <input type="text" name="phone" id="name" class="form-control" value="<?php echo $user['phone']; ?>" required>
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Email:</label>
        <input type="text" name="email" id="name" class="form-control" value="<?php echo $user['email']; ?>" required>
      </div>

      <!-- Dropdown chọn vai trò -->
      <div class="mb-3">
        <label for="role" class="form-label">Vai trò:</label>
        <select name="role_id" id="role" class="form-select" required>
          <option value="">Chọn vai trò</option>
          <?php while ($role = $roles->fetch_assoc()) { ?>
            <option value="<?php echo $role['id']; ?>" <?php echo ($role['name'] == $user['role']) ? 'selected' : ''; ?>>
              <?php echo $role['name']; ?>
            </option>
          <?php } ?>
        </select>
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