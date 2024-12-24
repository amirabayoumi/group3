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

$cat = getCatogery();

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


        <h1>Pet Paradise</h1>
        <p><b>Purr-fect Supplies for Your Furry Friends!<br></p>


        <a href="./register.php"><i>Register here</i></a>
        <a href="./signin.php"><b>already have an account ↗</b></a>

        <br><br>
        <nav><a href="index.php"><i>HOME</i></a></nav>
    </header>

    <body>

</html>