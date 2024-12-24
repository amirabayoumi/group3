<?php

require('./function.inc.php');
requiredLoggedInAdmin();

print '<pre>';
print_r($_SESSION);
print '</pre>';



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
    <h1>here is Admin CRUD</h1>
    <a href="./logoutAdmin.php"><i>logout admin page</i> </a>
    <!-- <a href="./index.php"><i>logout admin mode</i></a> -->
    <a href="./adminaddproduct.php"> <i>product management page</i> </a>
</body>

</html>