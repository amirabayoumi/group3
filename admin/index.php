<?php
$_SERVER["admin"] = true;
include_once "../includes/css_js.inc.php";
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require("../function.inc.php");
requiredLoggedOutAdmin();





// $userList = getUser();

// print "<pre>";
// print_r($_POST);
// print "</pre>";

// print "<pre>";
// print_r($userList);
// print "</pre>";
// print '<pre>';
// print_r($_SESSION);
// print '</pre>';


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
        $errors[] = "Name Or Key is not correct.";
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
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/icon" href="../images/Pet paradise.png" />
</head>

<body>

    <header>
        <img src="" alt="">
        <h1>Welcome to Admin Zone</h1>
        <p>Here you can control the Pet Paradise Shop.</p>
        <p>To access the admin zone, please enter your <strong>Name</strong> and <strong>Admin Key</strong>.</p>
    </header>

    <main>
        <section>
            <h1>&#128272;</h1>
        </section>
        <section>
            <form action="./index.php" method="post">
                <h1> Admin Login</h1>



                <div>
                    <input type="text" id="adminName" name="adminName" size="28" placeholder="Admin Name">
                    <input type="password" id="adminKey" name="adminKey" placeholder="Admin Key">
                    <button type="submit" id="submit" name="submit" value="1"> Enter Admin Dashboard </button>
                </div>
            </form>


        </section>
    </main>
    <section>
        <?php if (count($errors)): ?>
            <div>
                <h1>&#9888;</h1>
                <ul>

                    <?php foreach ($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

        <?php endif; ?>
    </section>

</body>

</html>