<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Giao Diện Quản Trị Admin</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      display: flex;
      height: 100vh;
      margin: 0;
    }

    /* Sidebar cố định */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
      height: 100%;
      background: #343a40;
      color: white;
      padding: 20px;
      box-sizing: border-box;
      overflow-y: auto;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
    }

    .sidebar a:hover {
      background: #495057;
    }

    /* Nội dung chính */
    .content {
      margin-left: 250px;
      padding: 20px;
      flex-grow: 1;
    }

    .nav-link.collapsed::after {
      content: '▼';
      float: right;
    }

    .nav-link:not(.collapsed)::after {
      content: '▲';
      float: right;
    }

    .collapse {
      display: none;
    }

    .collapse.show {
      display: block;
    }
  </style>
</head>

<body>

  <div class="sidebar p-3">
    <h4>Quản Trị</h4>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" href="#" data-toggle="collapse" data-target="#customerSubMenu" aria-expanded="false" aria-controls="customerSubMenu">
          Quản Lý Tài khoản
        </a>
        <ul class="nav flex-column ml-3 collapse" id="customerSubMenu">
          <li class="nav-item">
            <a class="nav-link" href="manage-user.php">Quản lí người dùng</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="manage-role.php">Quản lí role</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="manage-supplier.php">Quản Lý Nhà cung cấp</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Quản Lý Sản Phẩm</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Đơn Hàng</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Báo Cáo</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Cài Đặt</a>
      </li>
    </ul>
  </div>

  <div class="content">
    <h2>Nội Dung Quản Lý</h2>
    <p>Chào mừng đến với trang quản trị!</p>
    <!-- Bạn có thể thêm nội dung khác ở đây -->
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>