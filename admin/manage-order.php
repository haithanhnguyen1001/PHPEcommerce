<?php
include 'db.php';
include 'sidebar.php';

$result = $conn->query("SELECT `order`.id, `user`.`familyname`,`user`.`firstname`,`user`.`phone`, `order`.datetime
FROM `order`
JOIN `user` ON `order`.customer_id = `user`.id
ORDER BY `order`.datetime desc
");


?>

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


  <div class="content">
    <h2>Quản lí đơn hàng</h2>
    <!-- Bạn có thể thêm nội dung khác ở đây -->
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Family Name</th>
          <th>First Name</th>
          <th>Phone</th>
          <th>Ngày tạo đơn hàng</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($order = $result->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $order['id']; ?></td>
            <td><?php echo $order['familyname']; ?></td>
            <td><?php echo $order['firstname']; ?></td>
            <td><?php echo $order['phone']; ?></td>
            <td><?php echo $order['datetime']; ?></td>
            <td>
              <a class="btn btn-warning btn-sm" href="detail-order.php?id=<?php echo $order['id']; ?>">Xem chi tiết</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>