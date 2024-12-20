<?php
include 'db.php';
include 'sidebar.php';

$result = $conn->query("SELECT 
    p.id, 
    p.name, 
    p.description, 
    u.name AS unit_name,
    COALESCE(SUM(rd.quantity), 0) AS total_received, 
    COALESCE(SUM(od.quantity), 0) AS total_sold,
    (COALESCE(SUM(rd.quantity), 0) - COALESCE(SUM(od.quantity), 0)) AS stock,
    pr.price AS current_price  -- Giá sản phẩm tại thời điểm gần nhất
FROM 
    product p
JOIN 
    unit u ON p.unit_id = u.id
LEFT JOIN 
    receipt_details rd ON p.id = rd.product_id
LEFT JOIN 
    order_details od ON p.id = od.product_id
LEFT JOIN 
    price pr ON p.id = pr.product_id
    AND pr.datetime = (
        SELECT MAX(datetime) 
        FROM price 
        WHERE product_id = p.id 
        AND datetime <= NOW()  -- Lấy giá tại thời điểm gần nhất
    ) 
GROUP BY 
    p.id, p.name, p.description, u.name, pr.price
ORDER BY 
    p.name;
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
    <h2>Quản lí sản phẩm</h2>
    <div class="text-end mb-4">
      <a href="create-product.php" class="btn btn-primary">Thêm sản phẩm mới</a>
    </div>
    <!-- Bạn có thể thêm nội dung khác ở đây -->
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tên sản phẩm</th>
          <th>Mô tả</th>
          <th>Đơn vị tính</th>
          <th>Số lượng nhập</th>
          <th>Số lượng bán</th>
          <th>Tồn kho</th>
          <th>Giá bán hiện tại</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($product = $result->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $product['id']; ?></td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['description']; ?></td>
            <td><?php echo $product['unit_name']; ?></td>
            <td><?php echo $product['total_received']; ?></td>
            <td><?php echo $product['total_sold']; ?></td>
            <td><?php echo $product['stock']; ?></td>
            <td><?php echo $product['current_price']; ?></td>
            <td>
              <a class="btn btn-warning btn-sm" href="update-product.php?id=<?php echo $product['id']; ?>">Sửa</a>
              <a class="btn btn-danger btn-sm" href="delete-product.php?id=<?php echo $product['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xoá</a>
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