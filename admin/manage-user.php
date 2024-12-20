<?php
include 'db.php';
include 'sidebar.php';

$result = $conn->query("SELECT user.*, role.name as role
FROM user
JOIN user_role ON user.id = user_role.user_id
JOIN role ON role.id = user_role.role_id;");

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
    <h2>Quản lí người dùng</h2>
    <div class="text-end mb-4">
      <a href="create-user.php" class="btn btn-primary">Thêm người dùng mới</a>
    </div>
    <!-- Bạn có thể thêm nội dung khác ở đây -->
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Password</th>
          <th>Family Name</th>
          <th>First Name</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($user = $result->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['password']; ?></td>
            <td><?php echo $user['familyname']; ?></td>
            <td><?php echo $user['firstname']; ?></td>
            <td><?php echo $user['phone']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['role']; ?></td>
            <td>
              <a class="btn btn-warning btn-sm" href="update-user.php?id=<?php echo $user['id']; ?>">Sửa</a>
              <a class="btn btn-danger btn-sm" href="delete-user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xoá</a>
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