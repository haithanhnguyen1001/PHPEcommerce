<?php
include 'db.php';


$productID = $_GET['product_id'];
$imageID = $_GET['image_id'];

$conn->query("DELETE FROM image WHERE id = $imageID");
header("Location: update-product.php?id=" . $productID);
exit();
