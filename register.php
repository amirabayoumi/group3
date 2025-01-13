<?php

include_once "includes/css_js.inc.php";
require("./header.php");
require_once("./function.inc.php");
requiredLoggedOut();


// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

// print "<pre>";
// print_r($_POST);
// print "</pre>";


$errors = [];
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


?>


<main class="register">
    <form action="./register.php" method="post" class="register-form">
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
                <input type="text" id="firstname" name="firstname" placeholder="Enter first name" value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname'], ENT_QUOTES) : ''; ?>">
            </div>
            <div>
                <label for="lastname">Last name:</label>
                <input type="text" id="lastname" name="lastname" placeholder="Enter last name" value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname'], ENT_QUOTES) : ''; ?>">
            </div>
        </fieldset>

        <fieldset>
            <legend>Login Details</legend><br>
            <div>
                <label for="username">Username:</label>
                <input type="username" name="username" id="username" placeholder="Enter username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES) : ''; ?>">
            </div>
            <div>
                <label for="mail">Email address:</label>
                <input type="email" name="mail" id="mail" placeholder="Enter email address" value="<?php echo isset($_POST['mail']) ? htmlspecialchars($_POST['mail'], ENT_QUOTES) : ''; ?>">
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
                <a href="index.php">Back</a>
            </section>

        </div>


    </form>
</main>
<?php require("./footer.php"); ?>