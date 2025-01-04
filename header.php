<?php
require("./function.inc.php");
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// print '<pre>';
// print_r($_SESSION);
// print '</pre>';

// $items = getItems();


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
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/icons.css">

</head>

<body>
    <header>
        <img src="/images/Pet paradise.png" alt="logo">
        <h1>Pet Paradise</h1>
        <div>
            <a href="./register.php"><i>Register</i></a>
            <a href="./signin.php"><b>Login</b></a>
            <i class="icon-user"></i>
        </div>
    </header>

    <body>

</html>