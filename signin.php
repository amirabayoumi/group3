<?php
require("./function.inc.php");
requiredLoggedOut();


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// $userList = getUser();

print "<pre>";
print_r($_POST);
print "</pre>";


print '<pre>';
print_r($_SESSION);
print '</pre>';

//------------------- amira@test.com
//------------------- TestTest123@@

$errors = [];
$mail = "";
$password = "";


if (isset($_POST['mail'])) {

    // eerst validatie op mail (low level)
    if (!strlen($_POST['mail'])) {
        $errors[] = "Please fill in e-mail.";
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
        $errors[] = "E-mail and/or password is not correct.";
    }
}




print "<pre>";
print_r($errors);
print "</pre>";




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
        <form style="background-color: #8598b4c5;" action="./signin.php" method="post">
            <h1> </h1>
            <?php if (count($errors)): ?>
                <div style="background-color: #faec6c; border-radius:20px ;">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li style="color: #6d1000ec"><?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            <?php endif; ?>


            <label for="mail">E-mail address*:</label>
            <input type="email" id="mail" name="mail" size="28" placeholder="Enter valid mail ">

            <label for="inputPassword" class="form-label">Password*</label>
            <input type="password" id="inputPassword" name="inputPassword">



            <button type="submit" id="submit" name="submit" value="1">Sign in</button>
        </form>
    </main>

</body>

</html>