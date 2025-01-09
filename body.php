<?php
require_once("./function.inc.php");
// Number of items per page
$rowsPerPage = 6;

// Determine the current page
if (isset($_GET['page'])) {
    $currentPage = (int)$_GET['page'];
    if ($currentPage < 1) {
        $currentPage = 1;
    }
} else {
    $currentPage = 1;
}

// Calculate the starting index for the database query
$start = ($currentPage - 1) * $rowsPerPage;

// Fetch total number of products to calculate total pages
$totalItems = count(getItems()); // Using getItems() to get all products
$pages = ceil($totalItems / $rowsPerPage);




// print '<pre>';
// print_r($items);
// print '</pre>';


// print '<pre>';
// print_r($_POST);
// print '</pre>';
// print '<pre>';
// print_r($_SESSION);
// print '</pre>';

if (isset($_POST["addWishItem"])) {
    if (($_POST["addWishItem"]) > 0) {
        if (isset($_SESSION["uid"])) {
            $userId = $_SESSION["uid"];
            $productId = $_POST["addWishItem"];
            addProductToWishlist($productId,  $userId);
        } else {
        }
    }
}

if (isset($_POST["takeOffWishItem"])) {
    if (($_POST["takeOffWishItem"]) > 0) {
        if (isset($_SESSION["uid"])) {
            $userId = $_SESSION["uid"];
            $productId = $_POST["takeOffWishItem"];
            deleteProductFromWishlist($productId,  $userId);
        }
    }
}

// Fetch the products for the current page (implement function getProductPerPage)
$items = getProductPerPage($start, $rowsPerPage);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/mainBody.css">
</head>

<body>
    <section id="searchBar">
        <form action="<?= $pageName; ?>" method="post">
            <input type="text" id='searchname' name='searchname' placeholder="Search... ">
            <button type="submit" id='search' name="search" class="btn btn-primary"><i class="icon-search"></i></button>
        </form>
    </section>

    <section id="aboutUs">
        <h2>About us</h2>
        <p>
            Welcome to our webshop! We are a small pet shop where you can find the
            purr-fect supplies for your furry friends!
        </p>
    </section>

    <section id="categories">

        <div>
            <a href="<?php $pageName; ?>?cat=food"><img src="https://5.imimg.com/data5/SELLER/Default/2023/9/341168148/DH/HC/FG/158448362/dog-food-500x500.jpg" alt="food">
                <h5>Food</h5>
            </a>

        </div>
        <div>
            <a href="<?php $pageName; ?>?cat=toy"> <img src="https://i.etsystatic.com/38871768/r/il/76d029/6209376226/il_794xN.6209376226_1dn3.jpg" alt="toy">
                <h5>Toys</h5>
            </a>

        </div>
        <div>
            <a href="<?php $pageName; ?>?cat=care"> <img src="https://www.animalhumanesociety.org/sites/default/files/styles/scale_width_960/public/media/image/2023-04/untitled-instagram-post-square.png.jpg?itok=cBCBr_Do" alt="care">
                <h5>Care</h5>
            </a>

        </div>

    </section>
    <section id="itemsCards"><?php if (count($items) > 0): ?>



            <?php foreach ($items as $item): ?>
                <article>

                    <div id="item">
                        <img src="<?= $item['image']; ?>" alt="" />
                        <div>
                            <p><?= $item['title']; ?></p>
                            <h4><?= $item['price']; ?> &#8364;</h4>
                        </div>

                        <p>
                            <?= $item['description']; ?>
                        </p>
                    </div>
                    <div>

                        <p><?= $item['stock']; ?>Availability: </p>
                        <form action="<?= $pageName; ?>" method="post">
                            <button type="submit" id="<?php if ($item['user_id'] == $_SESSION['uid']) {
                                                            print "takeOffWishItem";
                                                        } else {
                                                            print "addWishItem";
                                                        }
                                                        ?>" name="<?php if ($item['user_id'] == $_SESSION['uid']) {
                                                                        print "takeOffWishItem";
                                                                    } else {
                                                                        print "addWishItem";
                                                                    }
                                                                    ?>" value=" <?= $item['id']; ?>"> <?php if (isset($_SESSION['uid']) && $item['user_id'] == $_SESSION['uid']) {
                                                                                                            print "&#x2665;";
                                                                                                        } elseif (isset($_SESSION['uid']) && $item['user_id'] != $_SESSION['uid']) {
                                                                                                            print " Add &#x2665;";
                                                                                                        } else {
                                                                                                            print "register to add to your wishlist ";
                                                                                                        }


                                                                                                        ?> </button>
                        </form>

                    </div>
                </article>

            <?php endforeach; ?>

        <?php else : ?>
            <h1>Oops! Sorry, no products were found. Please try searching again or send us a request with what you're looking for, and we'll be happy to assist you </h1>
        <?php endif; ?>
    </section>
    <ul class="pagination">
        <?php
        // This shows a "Previous" link only if the current page is greater than 1.
        if ($currentPage > 1): ?>
            <li><a href="<?= $pageName; ?>?page=<?= $currentPage - 1; ?>">Previous</a></li>
        <?php endif; ?>

        <?php
        // Loop through all pages to display page numbers.
        for ($i = 1; $i <= $pages; $i++): ?>
            <li <?= $i == $currentPage ? 'class="active"' : ''; ?>>
                <!-- Display page number as a link. "active" class added for the current page. -->
                <a href="<?= $pageName; ?>?page=<?= $i; ?>"><?= $i; ?></a>
            </li>
        <?php endfor; ?>

        <?php
        // Show "Next" link only if the current page is less than the total number of pages.
        if ($currentPage < $pages): ?>
            <li><a href="<?= $pageName; ?>?page=<?= $currentPage + 1; ?>">Next</a></li>
        <?php endif; ?>
    </ul>
</body>

</html>