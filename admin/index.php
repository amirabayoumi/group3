<?php
$_SERVER["admin"] = true;
include_once "../includes/css_js.inc.php";
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require("../function.inc.php");
requiredLoggedOutAdmin();





// $userList = getUser();

print "<pre>";
print_r($_POST);
print "</pre>";

// print "<pre>";
// print_r($userList);
// print "</pre>";
print '<pre>';
print_r($_SESSION);
print '</pre>';


$errors = [];
$adminName = "";
$adminKey = "";


if (isset($_POST['submit'])) {

    // eerst validatie op mail (low level)
    if (!strlen($_POST['adminName'])) {
        $errors[] = "Please fill in Admin name";
    }

    // validatie op password (low level)
    if (!strlen($_POST['adminKey'])) {
        $errors[] = "Please fill Admin key.";
    }

    $uid = isValidLoginAdmin($_POST['adminName'], $_POST['adminKey']);

    if ($uid) {
        // login success
        setLoginAdmin($uid);
        header("Location: adminProfile.php");
        exit;
    } else {
        $errors[] = "E-mail and/or password is not correct.";
    }
}




// print "<pre>";
// print_r($errors);
// print "</pre>";




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/mvp.css">
</head>

<body>
    <header>


        <h1>Welcome Back!</h1>



    </header>
    <main>
        <form style="background-color: #8598b4c5;" action="./index.php" method="post">
            <h1> Admin Page </h1>
            <!-- <?php if (count($errors)): ?>
                <div style="background-color: #faec6c; border-radius:20px ;">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li style="color: #6d1000ec"><?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            <?php endif; ?> -->


            <label for="adminName">Admin name:</label>
            <input type="text" id="adminName" name="adminName" size="28" placeholder="">

            <label for="adminKey" class="form-label">key:</label>
            <input type="password" id="adminKey" name="adminKey">



            <button type="submit" id="submit" name="submit" value="1">Sign in</button>
        </form>
    </main>

</body>

</html>