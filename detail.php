<?php
$errors = [];
require("./header.php");
require_once 'function.inc.php';
requiredLoggedInAdmin();
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
    <link rel="stylesheet" href="./css/details.css">

</head>

<body>
    <title><?= htmlspecialchars($product['title']); ?> - Details</title>
    <main>
        <section id="productDetails">
            <h1><?= htmlspecialchars($product['title']); ?></h1>
            <img src="<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['title']); ?>">
            <p><strong>Price:</strong> <?= $product['price']; ?> &#8364;</p>
        </section>
        <aside>
            <h3>Description</h3>
            <p><?= htmlspecialchars($product['description']); ?></p>
        </aside>
        <form action="home.php" method="post">
            <button type="submit" name="addWishItem" value="<?= $product['id']; ?>">
                Add to Wishlist &#x2665;
            </button>
        </form>
        <a href="index.php" title="Back to Home">
            <button type="button">Back to Home</button>
        </a>
        </section>
    </main>
</body>


<!-- <?php require('footer.inc.php'); ?>  - TODO-->