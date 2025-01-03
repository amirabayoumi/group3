<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include("../function.inc.php");
$id = (int)$_GET['delete'];
$item = getProductByID($id);

print "<pre>";
print_r($_GET);
print "</pre>";


print "<pre>";
print_r($_POST);
print "</pre>";

// print "<pre>";
// print_r($item);
// print "</pre>";

if (isset($_POST['sure'])) {
    // print " delete confirm "; 

    deleteProduct($_POST['sure']);
    header("Location: adminaddproduct.php?message= Product deleted successfully");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap CRUD Data Table for Database with Modal Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">

</head>

<body>


    <div>
        <div class="modal-header">

        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete these Product?</p>
            <p class="text-warning"><small>This action cannot be undone.</small></p>
        </div>

        <div style="display: grid; place-self:center; width:80%; background-color:antiquewhite; text-align:center;">

            <img style="width:250px; place-self:center;" src="<?= $item['image']; ?>" alt="">
            <h1><?= $item['title']; ?></h1>
            <p> Description: <?= $item['description']; ?></p>
            <p>URL: <?= $item['url']; ?></p>
            <p>Price: <?= $item['price']; ?></p>

        </div>
        <div class="modal-footer">


            <form action="deleteProduct.php" method="post">
                <a href="./adminaddproduct.php" class="btn btn-info"> Cancel </a> <button type="submit" class="btn btn-danger" id="sure" name="sure" value="<?= $item['id']; ?>"> confirm Delete </button>
            </form>

        </div>
    </div>
    </form>
</body>

</html>