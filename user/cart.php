<?php
include '../admin/db.php';

$cart = $conn->query("SELECT p.*, t.price, t.quantity, i.path
FROM product AS p
JOIN (
    SELECT cd.price, SUM(cd.quantity) AS quantity, cd.product_id
    FROM cart AS c
    JOIN cart_detail AS cd ON cd.cart_id = c.id
    WHERE c.user_id = 1
    GROUP BY cd.product_id
) AS t ON p.id = t.product_id
LEFT JOIN image AS i ON i.product_id = p.id AND i.sort_order = 1;");


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
  <title>Cart</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="cart.css" />
</head>

<body>
  <nav>
    <a href="index.php">
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
    <a href="/signin.html" class="mobile-user-icon" style="display: none;">
      <img src="./assets/user.png" alt="">
    </a>
    <a href="" class="nav-cart">
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
  <div class="cart">
    <div class="cart-left">
      <h1>Shopping Cart</h1>
      <hr />
      <?php
      $sum = 0;
      $total = 0;
      while ($product = $cart->fetch_assoc()) {
        $imagePath = $product['path'] ? $product['path'] : '../images/product/nophoto.png';
      ?>
        <div class="product-cart-list">
          <img src="<?php echo $imagePath; ?>" width="180px" alt="" />
          <div>
            <div class="product-cart-titleprice">
              <p>
                <?php echo $product['name']; ?>
              </p>
              <p><b><?php echo number_format($product['price']); ?> VND</b></p>
            </div>
            <p class="product-cart-bestseller">
              <span>#1 Best Seller</span>
            </p>
            <p class="product-cart-delivery">FREE delivery <b>Mon, Jan 29</b> available at checkout</p>
            <p class="product-cart-returns">FREE Returns &#11191</p>
            <p class="product-cart-giftoption">Gift options not available. <span>Learn more</span></p>
            <div class="cart-list-action">
              <h4>Số lượng <?php echo $product['quantity']; ?></h4>
              <hr>
              <p class="action-btn"><a href="delete_from_cart.php?cart_id=2&product_id=<?php echo $product['id']; ?>">Delete</a></p>
              <hr>
              <p class="action-btn">Save for later</p>
              <hr>
              <p class="action-btn">Compare with similar items</p>
              <hr>
              <p class="action-btn">Share</p>
            </div>
          </div>
        </div>
      <?php
        $sum++;
        $total += $product['quantity'] * $product['price'];
      } ?>
      <hr>
      <div class="cart-list-subtotal">
        Subtotal (<?php echo $sum; ?> items): <b><?php echo $total; ?> VND</b>
      </div>
    </div>
    <div class="cart-right">
      <div class="cart-free-delivery">
        <p>&#x2705</p>
        <p>Your order qualifies for FREE Shipping. <b>Choose this option at checkout.</b> See details</p>
      </div>
      <p class="cart-subtotal">Subtotal (<?php echo $sum; ?> items): <b><?php echo $total; ?></b> VND</p>
      <p class="cart-right-gift"> <input type="checkbox" name="" id=""> This order contains a gift</p>
      <button><a href="checkout.php?cart_id=2&user_id=1">Proceed to checkout</a></button>
    </div>
  </div>
  <footer class="footer-cart">
    <img src="./assets/amazon_logo.png" width="100" alt="">
    <p>© 1996-2024, Amazon.com, Inc. or its affiliates</p>
  </footer>
</body>

</html>