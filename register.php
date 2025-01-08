<?php
$errors = [];

require("./header.php");
require_once("./function.inc.php");
requiredLoggedOut();


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$userList = getUser();

// print "<pre>";
// print_r($_POST);
// print "</pre>";

// print "<pre>";
// print_r($userList);
// print "</pre>";

// print '<pre>';
// print_r($_SESSION);
// print '</pre>';


$firstname = "";
$lastname = "";
$mail = "";
$password = "";
$username = "";


if (isset($_POST['submit'])) {

    if (!isset($_POST['firstname'])) {
        $errors[] = "First name is required.";
    } else {
        $firstname = $_POST['firstname'];

        if (strlen($firstname) < 1) {
            $errors[] = "First name is required.";
        }

        if (preg_match("/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i", $firstname)) {
            $errors[] = "First name can not contain special characters.";
        }
    }


    if (!isset($_POST['lastname'])) {
        $errors[] = "Last name is required.";
    } else {
        $lastname = $_POST['lastname'];

        if (strlen($lastname) < 1) {
            $errors[] = "Last name is required.";
        }

        if (preg_match("/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i", $lastname)) {
            $errors[] = "Last name can not contain special characters.";
        }
    }

    if (!isset($_POST['mail'])) {
        $errors[] = "Email address is required.";
    } else {
        $mail = $_POST['mail'];

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email address is invalid.";
        } else {
            if (isMailExist($mail)) {
                $errors[] = "This email address is already associated with an account.";
            }
        }
    }

    // Validatie voor password
    if (!isset($_POST['inputPassword2']) || !isset($_POST['inputPassword1'])) {
        $errors[] = "Password is required.";
    } else {
        if ($_POST['inputPassword2'] == $_POST['inputPassword1']) {
            $password = $_POST['inputPassword2'];
        } else {
            $errors[] = "Passwords are not the same.";
        }


        if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $password)) {
            $errors[] = "Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 symbol, 1 number and must be at least 8 characters long.";
        }
    }

    if (!isset($_POST['username']) || strlen($_POST['username']) < 1) {
        $errors[] = "Username is required.";
    } else {
        if (strlen($_POST['username']) < 5) {
            $errors[] = "Username is too short.";
        } else {
            $username = $_POST['username'];
        }
    }
    if (!isset($_POST['policy'])) {
        $errors[] = "Agreement of policy is required.";
    } else {
        $policy = $_POST['policy'];
    }
    if (!count($errors)) {
        $newId = addUser($firstname, $lastname, $mail, $username, $password);
        if (!$newId) {
            $errors[] = "An unknown error has occured, please contact us...";
        } else {

            header("Location: signin.php");
            exit;
        }
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
                min-width: 300px;

                form {
                    background-color: #ffffff;
                    padding: 1.5rem;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    max-width: 600px;

                    margin: 2rem auto;

                    h1 {
                        margin-bottom: 1rem;
                        padding-left: 1rem;
                        font-weight: bold;

                    }

                    fieldset {
                        border: 1px solid #244d3b;
                        border-radius: 5px;
                        padding: 1rem;
                        margin-bottom: 1.8rem;

                        legend {
                            font-size: 1.3rem;
                            font-weight: bold;
                            color: #244d3b;

                            label {
                                display: block;
                                margin-bottom: 1rem;
                                font-weight: bold;
                            }
                        }
                    }

                    input {
                        width: 100%;
                        padding: 1rem;
                        margin-bottom: 1rem;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        font-size: 1rem;
                    }

                    #passwordHelpBlock {
                        font-size: 0.9rem;
                        color: #244d3b;
                        margin-top: -0.8rem;
                        margin-bottom: 0.5rem;
                        text-align: left;
                    }

                    #policy {

                        /* background-color: #D72C0D; */
                        display: grid;
                        grid-template-columns: 1fr;

                        section {
                            padding: 0.5rem;



                            &:nth-child(1) {
                                width: 100%;
                                display: flex;
                                padding: 0;




                                input {
                                    display: inline;
                                    width: 10%;
                                    margin: 0;
                                }

                                label {
                                    font-size: 20px;
                                    width: 90%;
                                    white-space: nowrap
                                }

                            }

                            &:nth-child(2) {
                                line-height: 25px;
                                padding: 1rem;

                                details {
                                    font-size: 15px;

                                }

                                summary {
                                    font-size: 18px;
                                }
                            }

                            &:nth-child(3) {
                                display: flex;
                                align-items: center;

                                justify-content: space-between;

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
                            }
                        }



                    }

                    button:hover {
                        color: #244d3b;
                        background-color: #fff;
                        border: 1px solid #244d3b;
                        border-radius: 5px;
                    }

                    a {
                        color: #244d3b;
                        text-decoration: none;
                        font-size: 1rem;
                        margin-left: 1.5rem;
                    }

                    a:hover {
                        text-decoration: underline;
                    }

                    .error-container {
                        padding: 1rem;

                        ul {
                            list-style-type: none;
                            margin: 0;
                            padding: 0;

                            li {
                                font-size: 1.1rem;
                                color: #D72C0D;
                            }
                        }
                    }
                }
            }
        }
    </style>
    <title>Register with Pet Paradise</title>
</head>

<body>
    <main>
        <form action="./register.php" method="post">
            <h1>New Customer</h1>

            <p> </p>
            <?php if (count($errors)): ?>
                <div class="error-container">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> &#x2022; <?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <fieldset>
                <legend>Personal Information</legend><br>
                <input type="hidden" name="success_url" value="">
                <input type="hidden" name="error_url" value="">
                <div>
                    <label for="firstname">First name:</label>
                    <input type="text" id="firstname" name="firstname" placeholder="Enter first name">
                </div>
                <div>
                    <label for="lastname">Last name:</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Enter last name">
                </div>
            </fieldset>

            <fieldset>
                <legend>Login Details</legend><br>
                <div>
                    <label for="username">Username:</label>
                    <input type="username" name="username" id="username" placeholder="Enter username">
                </div>
                <div>
                    <label for="mail">Email address:</label>
                    <input type="email" name="mail" id="mail" placeholder="Enter email address">
                </div>
                <div>
                    <label for="inputPassword1">Password:</label>
                    <input type="password" name="inputPassword1" id="inputPassword1" placeholder="Enter password">
                </div>
                <div>
                    <label for="inputPassword2">Confirm password:</label>
                    <input type="password" name="inputPassword2" id="inputPassword2" placeholder="Confirm your password">
                </div>
                <div id="passwordHelpBlock" class="form-text">
                    Min. 8 characters. Use a combination of upper and lowercase letters, numbers or special characters.
                </div>
            </fieldset>

            <div id="policy">
                <section>
                    <input type="checkbox" id="policy" name="policy" value="1">
                    <label for="policy">I Agree to Privacy Policy*</label>
                </section>
                <section>
                    <details>
                        <summary>Check the policy terms*</summary>

                        Privacy Policy: We collect and use your personal data to provide and improve our services.
                        Your information is securely stored and will not be shared with third parties without consent,
                        except as required by law. By agreeing, you accept our terms of data handling.

                    </details>
                </section>

                <section> <button type="submit" id="send2" name="submit">Create Account</button>
                    <a href="https://">Back</a>
                </section>

            </div>


        </form>
    </main>
</body>

</html>