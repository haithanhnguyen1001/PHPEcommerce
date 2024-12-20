<?php
include '../admin/db.php';

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
  <title>Amazon Clone by GreatStack</title>
  <link rel="stylesheet" href="style.css" />
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
      <p><a href="signin.php">Hello, Sign in</a></p>
      <h1>
        Nguyen Hai Thanh
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
  <div class="header-slider">
    <a href="#" class="control_prev">&#129144</a>
    <a href="#" class="control_next">&#129146</a>
    <ul>
      <img src="./assets/header1.jpg" class="header-img" alt="" />
      <img src="./assets/header2.jpg" class="header-img" alt="" />
      <img src="./assets/header3.jpg" class="header-img" alt="" />
      <img src="./assets/header4.jpg" class="header-img" alt="" />
      <img src="./assets/header5.jpg" class="header-img" alt="" />
      <img src="./assets/header6.jpg" class="header-img" alt="" />
    </ul>
  </div>
  <div class="box-row header-box">
    <div class="box-col">
      <h3>Free international returns</h3>
      <img src="./assets/box1-1.jpg" alt="">
      <a href="/">Shop More</a>
    </div>
    <div class="box-col">
      <h3>Lunar New Year</h3>
      <img src="./assets/box1-2.jpg" alt="">
      <a href="/">Shop More</a>
    </div>
    <div class="box-col">
      <h3>Toy under $25</h3>
      <img src="./assets/box1-3.jpg" alt="">
      <a href="/">Shop More</a>
    </div>
    <div class="box-col">
      <h3>Deals in PC</h3>
      <img src="./assets/box1-4.jpg" alt="">
      <a href="/">Shop More</a>
    </div>
  </div>
  <div class="box-row">
    <div class="box-col">
      <h3>Grooming Product</h3>
      <img src="./assets/box2-1.jpg" alt="">
      <a href="/">Shop More</a>
    </div>
    <div class="box-col">
      <h3>Lastest Devices</h3>
      <img src="./assets/box2-2.jpg" alt="">
      <a href="/">Shop More</a>
    </div>
    <div class="box-col">
      <h3>Pets Food</h3>
      <img src="./assets/box2-3.jpg" alt="">
      <a href="/">Shop More</a>
    </div>
    <div class="box-col">
      <h3>Fashion Mart</h3>
      <img src="./assets/box2-4.jpg" alt="">
      <a href="/">Shop More</a>
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
  <div class="products-slider">
    <h2>Best Sellers in Sports & Outdoors</h2>
    <div class="products">
      <img src="./assets/product1-1.jpg" alt="">
      <img src="./assets/product1-2.jpg" alt="">
      <img src="./assets/product1-3.jpg" alt="">
      <img src="./assets/product1-4.jpg" alt="">
      <img src="./assets/product1-5.jpg" alt="">
      <img src="./assets/product1-6.jpg" alt="">
      <img src="./assets/product1-7.jpg" alt="">
      <img src="./assets/product1-8.jpg" alt="">
      <img src="./assets/product1-9.jpg" alt="">
      <img src="./assets/product1-10.jpg" alt="">
    </div>
  </div>
  <div class="box-row">
    <div class="box-col">
      <h3>Stationary</h3>
      <img src="./assets/box3-1.jpg" alt="">
      <a href="/">Shop More</a>
    </div>
    <div class="box-col">
      <h3>Laptops for study</h3>
      <img src="./assets/box3-2.jpg" alt="">
      <a href="/">Shop More</a>
    </div>
    <div class="box-col">
      <h3>Office chairs</h3>
      <img src="./assets/box3-3.jpg" alt="">
      <a href="/">Shop More</a>
    </div>
    <div class="box-col">
      <h3>Gaming Monitor</h3>
      <img src="./assets/box3-4.jpg" alt="">
      <a href="/">Shop More</a>
    </div>
  </div>
  <div class="products-slider-with-price">
    <h2>Deals Under $25</h2>
    <div class="products">
      <div class="product-card">
        <div class="product-img-container">
          <img src="./assets/product2-1.jpg" alt="">
        </div>
        <div class="product-offer">
          <p>27% off</p> <span>Deal</span>
        </div>
        <p class="product-price">$ <span>14.49</span> List Price:$19.95</p>
        <h4>This product is the best for you</h4>
      </div>
      <div class="product-card">
        <div class="product-img-container">
          <img src="./assets/product2-2.jpg" alt="">
        </div>
        <div class="product-offer">
          <p>27% off</p> <span>Deal</span>
        </div>
        <p class="product-price">$ <span>14.49</span> List Price:$19.95</p>
        <h4>This product is the best for you</h4>
      </div>
      <div class="product-card">
        <div class="product-img-container">
          <img src="./assets/product2-3.jpg" alt="">
        </div>
        <div class="product-offer">
          <p>27% off</p> <span>Deal</span>
        </div>
        <p class="product-price">$ <span>14.49</span> List Price:$19.95</p>
        <h4>This product is the best for you</h4>
      </div>
      <div class="product-card">
        <div class="product-img-container">
          <img src="./assets/product2-4.jpg" alt="">
        </div>
        <div class="product-offer">
          <p>27% off</p> <span>Deal</span>
        </div>
        <p class="product-price">$ <span>14.49</span> List Price:$19.95</p>
        <h4>This product is the best for you</h4>
      </div>
      <div class="product-card">
        <div class="product-img-container">
          <img src="./assets/product2-5.jpg" alt="">
        </div>
        <div class="product-offer">
          <p>27% off</p> <span>Deal</span>
        </div>
        <p class="product-price">$ <span>14.49</span> List Price:$19.95</p>
        <h4>This product is the best for you</h4>
      </div>
      <div class="product-card">
        <div class="product-img-container">
          <img src="./assets/product2-6.jpg" alt="">
        </div>
        <div class="product-offer">
          <p>27% off</p> <span>Deal</span>
        </div>
        <p class="product-price">$ <span>14.49</span> List Price:$19.95</p>
        <h4>This product is the best for you</h4>
      </div>
      <div class="product-card">
        <div class="product-img-container">
          <img src="./assets/product2-7.jpg" alt="">
        </div>
        <div class="product-offer">
          <p>27% off</p> <span>Deal</span>
        </div>
        <p class="product-price">$ <span>14.49</span> List Price:$19.95</p>
        <h4>This product is the best for you</h4>
      </div>
      <div class="product-card">
        <div class="product-img-container">
          <img src="./assets/product2-8.jpg" alt="">
        </div>
        <div class="product-offer">
          <p>27% off</p> <span>Deal</span>
        </div>
        <p class="product-price">$ <span>14.49</span> List Price:$19.95</p>
        <h4>This product is the best for you</h4>
      </div>
      <div class="product-card">
        <div class="product-img-container">
          <img src="./assets/product2-9.jpg" alt="">
        </div>
        <div class="product-offer">
          <p>27% off</p> <span>Deal</span>
        </div>
        <p class="product-price">$ <span>14.49</span> List Price:$19.95</p>
        <h4>This product is the best for you</h4>
      </div>
      <div class="product-card">
        <div class="product-img-container">
          <img src="./assets/product2-10.jpg" alt="">
        </div>
        <div class="product-offer">
          <p>27% off</p> <span>Deal</span>
        </div>
        <p class="product-price">$ <span>14.49</span> List Price:$19.95</p>
        <h4>This product is the best for you</h4>
      </div>
      <div class="product-card">
        <div class="product-img-container">
          <img src="./assets/product2-11.jpg" alt="">
        </div>
        <div class="product-offer">
          <p>27% off</p> <span>Deal</span>
        </div>
        <p class="product-price">$ <span>14.49</span> List Price:$19.95</p>
        <h4>This product is the best for you</h4>
      </div>
    </div>
  </div>
  <div class="products-slider">
    <h2>Best Sellers in Sports & Outdoors</h2>
    <div class="products">
      <a href="/product.php"><img src="./assets/product_img.jpg" alt=""></a>
      <img src="./assets/product1-1.jpg" alt="">
      <img src="./assets/product1-2.jpg" alt="">
      <img src="./assets/product1-3.jpg" alt="">
      <img src="./assets/product1-4.jpg" alt="">
      <img src="./assets/product1-5.jpg" alt="">
      <img src="./assets/product1-6.jpg" alt="">
      <img src="./assets/product1-7.jpg" alt="">
      <img src="./assets/product1-8.jpg" alt="">
      <img src="./assets/product1-9.jpg" alt="">
      <img src="./assets/product1-10.jpg" alt="">
    </div>
  </div>
  <div class="box-row">
    <div class="box-col">
      <h3>Stationary</h3>
      <img src="./assets/box3-1.jpg" alt="">
      <a href="/">Shop More</a>
    </div>
    <div class="box-col">
      <h3>Laptops for study</h3>
      <img src="./assets/box3-2.jpg" alt="">
      <a href="/">Shop More</a>
    </div>
    <div class="box-col">
      <h3>Office chairs</h3>
      <img src="./assets/box3-3.jpg" alt="">
      <a href="/">Shop More</a>
    </div>
    <div class="box-col">
      <h3>Gaming Monitor</h3>
      <img src="./assets/box3-4.jpg" alt="">
      <a href="/">Shop More</a>
    </div>
  </div>
  <footer>
    <img src="./assets/amazon_logo.png" width="100" alt="">
    <p>© 1996-2024, Amazon.com, Inc. or its affiliates</p>
  </footer>
  <script src="script.js"></script>
</body>

</html>