<?php
$errors = [];
require("./header.php");
require_once 'function.inc.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);




if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid product ID.";
    exit;
}


$productId = (int)$_GET['id'];


$product = getProductByID($productId);

if (!$product) {
    echo "Product not found.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/detail.css">

</head>

<body>
    <title><?= htmlspecialchars($product['title']); ?></title>
    <div class="container">
        <main>
            <section id="productDetails">
                <h1><?= htmlspecialchars($product['title']); ?></h1>
                <img src="<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['title']); ?>">
                <p><strong>Price:</strong> <?= $product['price']; ?> &#8364;</p>
            </section>
            <aside>
                <h2>Description</h2>
                <p><?= htmlspecialchars($product['description']); ?></p>
            </aside>
            <form action="index.php" method="post">
                <button type="submit" name="addWishItem" value="<?= $product['id']; ?>">
                    Add to Wishlist &#x2665;
                </button>
            </form>
        </main>
    </div>
</body>


<?php require('footer.php'); ?>