<?php
// $errors = [];
// require("./header.php");
// require_once 'function.inc.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);




// if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
//     echo "Invalid product ID.";
//     exit;
// }


// $productId = (int)$_GET['id'];


// $product = getProductByID($productId);

// if (!$product) {
//     echo "Product not found.";
//     exit;
// }

if (isset($_GET['detail'])) {
    $productId = (int)$_GET['detail'];
    $product = getProductForDetails($productId);
}

// print '<pre>';
// print_r($product);
// print '</pre>';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/detail.css">

</head>

<div id="detailBody">
    <title><?= htmlspecialchars($product['title']); ?></title>
    <div id="detailContainer">
        <div id="detailMain">
            <section id="productDetails">
                <h1 id="productTitle"><?= htmlspecialchars($product['title']); ?></h1>
                <a href="<?= $product['url']; ?>"><img src="<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['title']); ?>"></a>
                <p><strong>Price:</strong> <?= $product['price']; ?> &#8364;</p>
            </section>
            <aside id="productDescription">
                <h2>Description</h2>
                <p><?= htmlspecialchars($product['description']); ?></p>
            </aside>
            <form action="<?= $pageName; ?>?detail=<?= $product['id']; ?>" method="post">
                <button type="submit" style="visibility: <?php if (!isset($_SESSION['uid'])) {
                                                                print "hidden;";
                                                            } ?>" id=" <?php if ($product['user_id'] == $_SESSION['uid']) {
                                                                            print "takeOffWishItem";
                                                                        } else {
                                                                            print "addWishItem";
                                                                        }
                                                                        ?>" name="<?php if ($product['user_id'] == $_SESSION['uid']) {
                                                                                        print "takeOffWishItem";
                                                                                    } else {
                                                                                        print "addWishItem";
                                                                                    }
                                                                                    ?>" value=" <?= $product['id']; ?>"> <?php if (isset($_SESSION['uid']) && $product['user_id'] == $_SESSION['uid']) {
                                                                                                                                print "&#x2665;";
                                                                                                                            } elseif (isset($_SESSION['uid']) && $product['user_id'] != $_SESSION['uid']) {
                                                                                                                                print " Add &#x2665;";
                                                                                                                            }


                                                                                                                            ?> </button>

            </form>
        </div>
    </div>
</div>