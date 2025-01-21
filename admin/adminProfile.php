<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require('../function.inc.php');
requiredLoggedInAdmin();

// print '<pre>';
// print_r($_SESSION);
// print '</pre>';



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/adminProfile.css">
    <link rel="icon" type="image/icon" href="../images/Pet paradise.png" />



</head>

<body>
    <header>
        <a href="./logoutAdmin.php"><i>Logout</i> </a>
        <div>
            <h1>Welcome Back, Admin!</h1>
            </p>You have now access to the main dashboard</p>
        </div>

    </header>
    <main>
        <a href="./adminUserCrud.php" title="Create, update, and manage user accounts .">
            <p>User Management</p>
        </a>
        <a href="./adminaddproduct.php" title="Oversee products, Add product, Delete product and keep inventory organized.">
            <p> Product Management </p>
        </a>
        <a href="./uploadlogo.php" title="upload new seasonal logo">
            <p> Upload new seasonal logo </p>
        </a>
    </main>

</body>

</html>