<?php
require("./header.php");
require_once("./function.inc.php");
requiredLoggedOut();


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// $userList = getUser();

// print "<pre>";
// print_r($_POST);
// print "</pre>";


// print '<pre>';
// print_r($_SESSION);
// print '</pre>';

//------------------- amira@test.com
//------------------- TestTest123@@

$errors = [];
$mail = "";
$password = "";


if (isset($_POST['mail'])) {

    // eerst validatie op mail (low level)
    if (!strlen($_POST['mail'])) {
        $errors[] = "Please fill in email.";
    }

    // validatie op password (low level)
    if (!strlen($_POST['inputPassword'])) {
        $errors[] = "Please fill in password.";
    }

    $uid = isValidLogin($_POST['mail'], $_POST['inputPassword']);

    if ($uid) {
        // login success
        setLogin($uid);
        header("Location: profile.php");
        exit;
    } else {
        $errors[] = "Email and/or password is not correct!";
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
    <title>Log in to Pet Paradise</title>
    <link rel="stylesheet" href="css/signin.css">
</head>

<body>

    <main>
        <section class="login">
            <form action="./signin.php" method="post">

                <p> </p>
                <?php if (count($errors)): ?>
                    <div class="error-container">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>


                <label for="mail">Email address:</label>
                <input type="email" id="mail" name="mail" size="28" placeholder="Please enter your email">

                <label for="inputPassword">Password:</label>
                <input type="password" id="inputPassword" name="inputPassword" placeholder="Please enter your password">



                <button type="submit" id="submit" name="submit" value="1">Log in</button>
            </form>
        </section>
    </main>

</body>

</html>