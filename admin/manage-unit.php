<?php
include 'db.php';
include 'sidebar.php';

$result = $conn->query("SELECT * FROM unit");

// if ($result) {
//   if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//       print_r($row);
//     }
//   } else {
//     echo "No records found.";
//   }
// } else {
//   echo "Query failed: " . $conn->error;
// }
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
    <h2>Quản lí đơn vị tính</h2>
    <div class="text-end mb-4">
      <a href="create-unit.php" class="btn btn-primary">Thêm đơn vị tính mới</a>
    </div>
    <!-- Bạn có thể thêm nội dung khác ở đây -->
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Unit name</th>
          <th>Unit Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($unit = $result->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $unit['id']; ?></td>
            <td><?php echo $unit['name']; ?></td>
            <td><?php echo $unit['description']; ?></td>
            <td>
              <a class="btn btn-warning btn-sm" href="update-unit.php?id=<?php echo $unit['id']; ?>">Sửa</a>
              <a class="btn btn-danger btn-sm" href="delete-unit.php?id=<?php echo $unit['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xoá</a>
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