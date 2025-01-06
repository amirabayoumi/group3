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

    <style>
        body {
            background-color: rgb(255, 255, 255);
            min-height: 100vh;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: rgb(88, 87, 87);

            header {
                text-align: center;
            }

            main {
                margin-top: 5rem;

                background-color: #244d3b;
                width: 70%;
                max-width: 700px;
                display: grid;
                place-self: center;
                grid-template-columns: 1fr 1fr;
                border: 0.5px solid rgb(158, 161, 160);
                box-shadow: 5px 5px 10px rgb(118, 148, 132);
                border-radius: 10px;

                section {
                    &:nth-child(1) {
                        font-size: 5rem;
                        text-align: center;
                        border-right: 0.5px solid rgb(199, 204, 202);
                    }

                    &:nth-child(2) {
                        padding: 1rem;
                        text-align: center;
                        color: white;

                        form {
                            height: 80%;
                            display: grid;

                            h1 {
                                align-self: center;
                            }

                            div {
                                &:nth-child(2) {
                                    display: grid;
                                    gap: 1rem;

                                    button {
                                        background-color: rgb(219, 186, 39);
                                        border: none;
                                        border-radius: 8px;
                                        color: rgb(75, 74, 73);

                                        &:hover {
                                            background-color: rgb(126, 118, 85);
                                            color: white;
                                        }
                                    }
                                }


                            }
                        }


                    }

                }
            }

            >section {
                padding-top: 2rem;

                >div {
                    width: 60%;
                    display: grid;
                    place-self: center;
                    grid-template-columns: 20% 80%;
                    background-color: rgba(202, 47, 0, 0.37);
                    border-radius: 10px;
                    color: rgb(129, 41, 14);

                    h1 {
                        font-size: 2rem;


                        text-align: center;
                    }
                }

            }

        }

        @media (max-width: 600px) {
            body main {
                grid-template-columns: 1fr;
            }

            body main section:nth-child(1) h1 {
                font-size: 50px;
            }

        }
    </style>
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