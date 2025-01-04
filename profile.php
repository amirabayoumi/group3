<?php

require('./function.inc.php');
requiredLoggedIn();

print '<pre>';
print_r($_SESSION);
print '</pre>';

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
    if ($_GET['cat'] == "food") {
        $items = getItemsByCat(1);
    } else if ($_GET['cat'] == "toy") {
        $items = getItemsByCat(2);
    }
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
    <link rel="stylesheet" href="https://unpkg.com/mvp.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">

</head>

<body>
    <header>
        <a href="./logout.php"><i>Log out</i></a>


        <h1>Welcome <?= $toGetName[0]['firstname']; ?> !</h1>
        <hr>
        <a href="profile.php"><i> Profile Home</i></a>

        <br><br>
        <h1>here is the whislist!</h1>
        <a href="profile.php?wishlist" style="font-size: 40px; text-decoration:none"> &#9829;</a>
        <?php foreach ($wishList as $wishItem): ?>
            <div class="card mb-3" style="max-width: 90vh; display:grid; place-self:center;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= $wishItem['ogimage']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $wishItem['ogtitle']; ?></h5>
                            <p class="card-text"><?= $wishItem['ogdescription']; ?></p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </header>
    <main>
        <?php if (!isset($_GET['wishlist'])): ?>
            <?php require("./body.php"); ?>
        <?php endif; ?>
    </main>

</body>

</html>