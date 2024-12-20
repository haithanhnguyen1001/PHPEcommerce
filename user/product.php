<?php
include '../admin/db.php';

$productID = $_GET['id'];


$product = $conn->query("SELECT *
FROM(
SELECT 
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
) as t1
WHERE t1.id =$productID")->fetch_assoc();

$result = $conn->query("SELECT p.id, p.name, p.description, pr.price, i.path
FROM product p
LEFT JOIN (
    SELECT product_id, price
    FROM price
    WHERE (product_id, datetime) IN (
        SELECT product_id, MAX(datetime)
        FROM price
        GROUP BY product_id
    )
) pr ON p.id = pr.product_id
LEFT JOIN image i ON p.id = i.product_id AND i.sort_order = 1;");

$images = $conn->query("SELECT *
FROM image
WHERE image.product_id =$productID");

$totalProduct = $conn->query("SELECT COUNT(*) AS total_rows
FROM (
    SELECT p.*, t.price, t.quantity, i.path
    FROM product AS p
    JOIN (
        SELECT cd.price, SUM(cd.quantity) AS quantity, cd.product_id
        FROM cart AS c
        JOIN cart_detail AS cd ON cd.cart_id = c.id
        WHERE c.user_id = 1
        GROUP BY cd.product_id
    ) AS t ON p.id = t.product_id
    LEFT JOIN image AS i ON i.product_id = p.id AND i.sort_order = 1
) AS result;
")->fetch_assoc();

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Product Page</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="product.css" />
</head>

<body>
  <nav>
    <a href="/">
      <img src="./assets/amazon_logo.png" width="100" alt="" />
    </a>
    <div class="nav-country">
      <img src="./assets/location_icon.png" height="20" alt="" />
      <div>
        <p>Deliver to</p>
        <h1>United Kingdom</h1>
      </div>
    </div>
    <div class="nav-search">
      <div class="nav-search-gategory">
        <p>All</p>
        <img src="./assets/dropdown_icon.png" height="12" alt="" />
      </div>
      <input
        type="text"
        class="nav-search-input"
        placeholder="Search Amazon" />
      <img src="./assets/search_icon.png" alt="" class="nav-search-icon" />
    </div>
    <div class="nav-language">
      <img src="./assets/us_flag.png" width="25" alt="" />
      <p>EN</p>
      <img src="./assets/dropdown_icon.png" width="8" alt="" />
    </div>
    <div class="nav-text">
      <p><a href="/signin.html">Hello, Sign in</a></p>
      <h1>
        Account & Lists
        <img src="./assets/dropdown_icon.png" width="8px" alt="" />
      </h1>
    </div>
    <div class="nav-text">
      <p>Return</p>
      <h1>& Orders</h1>
    </div>
    <a href="/signin.html" class="mobile-user-icon" style="display: none">
      <img src="./assets/user.png" alt="" />
    </a>
    <a href="cart.php" class="nav-cart">
      <img src="./assets/cart_icon.png" width="35px" alt="" />
      <h4>Cart (<?php echo $totalProduct['total_rows']; ?>)</h4>
    </a>
  </nav>
  <div class="nav-bottom">
    <div>
      <img src="./assets/menu_icon.png" width="25px" alt="" />
      <p>All</p>
    </div>
    <p>Today's Deal</p>
    <p>Customer Service</p>
    <p>Registry</p>
    <p>Gift Cards</p>
    <p>Sell</p>
  </div>
  <p class="breadcrum">Video Games > PC > Accessories > Headset</p>
  <div class="product-display">
    <div class="product-d-image">
      <div class="product-icons">
        <?php while ($image = $images->fetch_assoc()) {
          $imagePath = $image['path'] ? $image['path'] : '../images/product/nophoto.png';
          if ($image['sort_order'] != 1) { ?>
            <img src="<?php echo $imagePath; ?>" alt="" width="60" />
        <?php }
        } ?>
      </div>
      <div class="product-main-image">
        <?php
        $images->data_seek(0);
        while ($image = $images->fetch_assoc()) {
          $imagePath = $image['path'] ? $image['path'] : '../images/product/nophoto.png';
          if ($image['sort_order'] == 1) { ?>
            <img src="<?php echo $imagePath; ?>" alt="" width="400" />
        <?php }
        } ?>

      </div>
    </div>
    <div class="product-d-details">
      <p class="product-title">
        <?php echo $product['name']; ?>
      </p>
      <p class="brand-store">Visit the BENGOO Store</p>
      <div class="product-rating">
        <div>
          4.3 <img src="./assets/rating_img.png" height="20" alt="" />
          <p>106,956 ratings | Search this page</p>
        </div>
        <p><span>#1 Best Seller</span> in Xbox One Headsets</p>
        <h5>Số lượt mua sản phẩm: <?php echo $product['total_sold']; ?></h5>
        <hr />
      </div>
      <div class="product-d-price">
        <div>
          <p>-35%</p>
          <h1><span><?php echo number_format($product['current_price']) . ' VND'; ?>
            </span></h1>
        </div>
        <p>Get <b>Fast, Free Shipping</b> with <span>Amazon Prime</span></p>
        <p><span>FREE Returns</span></p>
        <p>
          Available at a lower price from <span>other sellers</span> that may
          not offer free Prime shipping
        </p>
      </div>
      <hr />
      <div class="product-description">
        <h1>About this item</h1>
        <ul>
          <li>
            <?php echo $product['description']; ?>
          </li>
        </ul>
      </div>
    </div>
    <div class="product-d-purchase">
      <div class="title">
        <h3>Buy new:</h3>
        <img src="./assets/circle_icon.png" width="20px" alt="" />
      </div>
      <h1 class="price"><?php echo number_format($product['current_price']) . ' VND'; ?></h1>
      <div class="gap">
        <p><b>Get Fast, Free Shipping</b> with <span>Amazon Prime</span></p>
        <p><span>FREE Returns</span></p>
      </div>
      <div class="gap">
        <p><span>FREE delivery</span> <b>Saturday</b>,</p>
        <p><b>January 27</b> on orders shipped by Amazon over $35</p>
      </div>
      <div class="gap">
        <p>
          Or fastest delivery <b>Tomorrow</b>, <b>January 23</b>. Order within
          <span>10 hrs 56 mins</span>
        </p>
      </div>
      <div class="delivery-location">
        <img src="./assets/location_icon_dark.png" width="20px" alt="" />
        <p><span>Deliver to New York 10014</span></p>
      </div>
      <h2 class="product-stock">In Stock (<?php echo $product['stock']; ?>)</h2>

      <form action="add_to_cart.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $productID; ?>">
        <input type="hidden" name="price" value="<?php echo $product['current_price']; ?>">
        <input type="number" class="product-quantity" name="quantity" value="1">
        <button class="btn">Add to Cart</button>
      </form>
      <div class="product-seller-info">
        <p>Ships from</p>
        <p><span>Amazon</span></p>
        <p>Sold by</p>
        <p><span>Bengoo Inc.</span></p>
        <p>Returns</p>
        <p><span>30-day refund/replacement</span></p>
        <p>Payment</p>
        <p><span>Amazon</span></p>
        <p>Ships from</p>
        <p><span>Secure transaction</span></p>
      </div>
      <hr />
      <button class="product-add-list">Add to List</button>
    </div>
  </div>
  <div class="products-slider-with-price">
    <h2>Deals Hot</h2>
    <div class="products">
      <?php while ($product = $result->fetch_assoc()) {
        $imagePath = $product['path'] ? $product['path'] : '../images/product/nophoto.png';
      ?>

        <div class="product-card">
          <div class="product-img-container">
            <a href="product.php?id=<?php echo $product['id']; ?>"><img src="<?php echo $imagePath; ?>" alt=""></a>

          </div>
          <div class="product-offer">
            <p>50% off</p> <span>Deal</span>
          </div>
          <p class="product-price">$ <span><?php echo $product['price']; ?></span></p>
          <h4><?php echo $product['name']; ?></h4>
        </div>

      <?php } ?>
    </div>
  </div>
  <footer class="product-footer">
    <img src="./assets/amazon_logo.png" width="100" alt="" />
    <p>© 1996-2024, Amazon.com, Inc. or its affiliates</p>
  </footer>
  <script>
    const scrollContainer = document.querySelectorAll(".products");
    for (const item of scrollContainer) {
      item.addEventListener("wheel", (e) => {
        e.preventDefault();
        item.scrollLeft += e.deltaY;
      });
    }
  </script>
</body>

</html>