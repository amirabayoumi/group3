<?php

require('./function.inc.php');
requiredLoggedIn();

// print '<pre>';
// print_r($_SESSION);
// print '</pre>';

if (isset($_SESSION['uid'])) {
    $userId = $_SESSION['uid'];
    $user = getUserById($userId);
}
// print '<pre>';
// print_r($_GET);
// print '</pre>';

if (isset($_GET['wishlist'])) {
    $wishList = getWishlistById($_SESSION['uid']);
}
// need to fix 
// get name by user better instead get name by wishlist !!
$toGetName = getWishlistById($_SESSION['uid']);

// print '<pre>';
// print_r($wishList);
// print '</pre>';


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
</head>

<body>

    <header>
        <img src="./images/Pet paradise.png" alt="logo">
        <h1><? if (strlen($user['petname']) > 1) {
                print $user['petname'];
            } else {
                print "Pet";
            } ?> Paradise</h1>
        <div>
            <a href="profile.php">Home</a>

            <div>
                <p>Welcome, <?= $user['firstname'] ?>!</p>
                <aside>
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
                    <div> <a href="updateProfile.php">Edit Profile</a>
                        <a href="deleteProfile.php">Delete Profile</a>
                        <a href="./logout.php">Log out</a>
                    </div>



                </aside>
            </div>
            <a href="profile.php?wishlist"> Your Wishlist &#9829;</a>

        </div>

    </header>

    <main>
        <section style="display:<?php if (!isset($_GET['wishlist'])) {
                                    print "none";
                                } else {
                                    print "";
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

                        <p><?= $wishItem['stock']; ?> left in stock</p>
                        <a href="detail.php">Buy</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>

        <?php if (!isset($_GET['wishlist'])): ?>
            <?php $pageName = "profile.php";
            require("./body.php"); ?>
        <?php endif; ?>
    </main>



</body>

</html>