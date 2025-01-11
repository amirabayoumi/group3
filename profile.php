<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require('./function.inc.php');
requiredLoggedIn();

// print '<pre>';
// print_r($_SESSION);
// print '</pre>';
if (isset($_POST["takeOffWishItem"])) {
    if (($_POST["takeOffWishItem"]) > 0) {
        if (isset($_SESSION["uid"])) {
            $userId = $_SESSION["uid"];
            $productId = $_POST["takeOffWishItem"];
            deleteProductFromWishlist($productId,  $userId);
        }
    }
}
if (isset($_SESSION['uid'])) {
    $userId = $_SESSION['uid'];
    $user = getUserById($userId);
}
// print '<pre>';
// print_r($_GET);
// print '</pre>';

if (isset($_GET['wishlist'])) {
    $wishList = getWishlistById($_SESSION['uid']);
    // print '<pre>';
    // print_r($wishList);
    // print '</pre>';
}
//not needed anymore 
// $toGetName = getWishlistById($_SESSION['uid']);




if (isset($_POST['search'])) {
    $items =  getItemsBySearch($_POST['searchname']);
} elseif (isset($_GET['cat'])) {
    $items = getItemsByCat($_GET['cat']);
} else {
    $items = getItems();
}
// print "<pre>";
// print_r($items);
// print "</pre>";

$cat = getCategory();

// print "<pre>";
// print_r($cat);
// print "</pre>";


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/userProfileHeader.css">
    <link rel="stylesheet" href="css/mainBody.css">
</head>

<body>

    <header>
        <img src="./images/Pet paradise.png" alt="logo">
        <h1><? if (isset($user['petname']) && strlen($user['petname']) > 1) {
                print $user['petname'];
            } else {
                print "Pet";
            } ?> Paradise</h1>
        <div>
            <a href="profile.php">Home</a>

            <div>
                <a href="#">Welcome, <?= $user['firstname'] ?>!</a>
                <aside id="profileDetails">
                    <div>
                        <h3>Your Profile Details</h3>
                        <p>Name: <?= $user['firstname'] ?> <?= $user['lastname'] ?></p>
                        <p>Country: <?= $user['country'] ?></p>
                        <p>UserName: <?= $user['username'] ?></p>
                        <p>Email: <?= $user['mail'] ?></p>
                        <?php if (strlen($user['petname']) > 1): ?>
                            <p> Pet Name : <?= $user['petname'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div> <a href="profile.php?updateProfile">Edit Profile</a>
                        <a href="profile.php?deleteProfile">Delete Profile</a>
                        <a href="./logout.php">Log out</a>
                    </div>



                </aside>
            </div>
            <a href="profile.php?wishlist"> Your Wishlist &#9829;</a>

        </div>

    </header>

    <main>
        <section class="wishList <?php if (!isset($_GET['wishlist'])) {
                                        print "hide";
                                    } else {
                                        print "show";
                                    } ?>">
            <?php foreach ($wishList as $wishItem): ?>
                <article>

                    <div>
                        <img src=" <?= $wishItem['image']; ?>" alt="" />
                        <div>
                            <p><?= $wishItem['title']; ?></p>
                            <h4><?= $wishItem['price']; ?> &#8364;</h4>
                        </div>

                        <p>
                            <?= $wishItem['description']; ?>
                        </p>

                    </div>
                    <div>


                        <p style="color: <?= !$wishItem['status'] ? '#914f3b' : 'black'  ?>"> <?= !$wishItem['status'] ? 'Not Available' : 'Available'  ?> </p>
                        <form action="profile.php?wishlist" method="post">
                            <button type="submit" name="takeOffWishItem" id="takeOffWishItem" value="<?= $wishItem['product_id']; ?>">&#x2665;</button>
                        </form>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>



        <?php if (isset($_GET['updateProfile'])) {
            require("./updateProfile.php");
        } ?>
        <?php if (isset($_GET['deleteProfile'])) {
            require("./deleteProfile.php");
        } ?>
        <?php if (!isset($_GET['wishlist']) && !isset($_GET['updateProfile']) && !isset($_GET['deleteProfile'])): ?>
            <?php $pageName = "profile.php";
            require("./body.php"); ?>
        <?php endif; ?>
    </main>



</body>

</html>