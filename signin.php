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
        $errors[] = "E-mail and/or password is not correct!";
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
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300;400;700&display=swap");

        * {
            font-size: 62.5%;
            box-sizing: border-box;
        }

        body {
            font-family: 'Comic Neue', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #244d3b;

            main {
                display: flex;
                justify-content: space-around;
                margin: 3rem auto;
                max-width: 1200px;

                section {
                    background-color: #ffffff;
                    padding: 1.5rem;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    width: 45%;

                    label {
                        display: block;
                        margin-bottom: 0.5rem;
                        font-weight: bold;
                    }

                    input {
                        width: 100%;
                        padding: 1rem;
                        margin-bottom: 1rem;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        font-size: 1rem;
                    }

                    button {
                        transition: all .5s ease;
                        background-color: #244d3b;
                        color: #ffffff;
                        padding: 0.8rem 2rem;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        font-size: 1rem;
                    }

                    button:hover {
                        color: #244d3b;
                        background-color: #fff;
                        border: 1px solid #244d3b;
                        border-radius: 5px;
                    }
                }
            }
        }
    </style>
    <title>Log in to Pet Paradise</title>
</head>

<body>

    <main>
        <section class="login">
            <form action="./signin.php" method="post">

                <?php if (count($errors)): ?>
                    <div style="background-color: #faec6c; border-radius:20px ;">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li style="color: #244d3b"><?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                <?php endif; ?>


                <label for="mail">E-mail address:</label>
                <input type="email" id="mail" name="mail" size="28" placeholder="Please enter your email" required>

                <label for="inputPassword">Password:</label>
                <input type="password" id="inputPassword" name="inputPassword" placeholder="Please enter your password" required>



                <button type="submit" id="submit" name="submit" value="1">Log in</button>
            </form>
        </section>
    </main>

</body>

</html>