<?php
require('./function.inc.php');
requiredLoggedIn();

$errors = [];

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (isset($_SESSION['uid'])) {
    $userId = @$_SESSION['uid'];
    $user = getUserById($userId);
}

print '<pre>';
print_r(@$_SESSION);
print '</pre>';

if (@$_POST['submit_edit']) {
    print '<pre>';
    print_r($_POST);
    print '</pre>';

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $mail = $_POST['mail'];
    $username = $_POST['username'];
    $password1 = $_POST['inputPassword1'];
    $password2 = $_POST['inputPassword2'];

    if (strlen($firstname) == 0) {
        $errors[] = "First name is required";
    }

    if (strlen($lastname) == 0) {
        $errors[] = "Last name is required";
    }

    if (strlen($mail) == 0) {
        $errors[] = "Email is required";
    }

    if (strlen($username) == 0) {
        $errors[] = "Username is required";
    }

    if (strlen($password1) > 0 && $password1 != $password2) {
        $errors[] = "Passwords don't match.";
    }

    if (count($errors) == 0) {
        updateUser($_SESSION['uid'], $firstname, $lastname, $mail, $password1);
        header("Location: profile.php");
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update profile</title>
</head>

<body>

    <main>
        <form style="background-color: #8598b4c5;" action="./updateProfile.php" method="post">
            <?php if (count($errors)): ?>
                <div style="background-color: #faec6c; border-radius:20px ;">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li style="color: #6d1000ec"><?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            <?php endif; ?>

            <label for="firstname">First name*</label>
            <input type="text" id="firstname" name="firstname" size="28" value="<?= $user['firstname'] ?>">
            <label for="lastname">Last name*</label>
            <input type="text" id="lastname" name="lastname" size="28" value="<?= $user['lastname'] ?>">
            <br>
            <label for="mail">E-mail address*:</label>
            <input type="email" id="mail" name="mail" size="28" value="<?= $user['mail'] ?>">
            <br> <label for="username">Username*</label>
            <input type="text" id="username" name="username" size="28" value="<?= $user['username'] ?>">

            <label for="inputPassword1" class="form-label">New password*</label>
            <input type="password" id="inputPassword1" name="inputPassword1">
            <label for="inputPassword2" class="form-label"> Confirm new password*</label>
            <input type="password" id="inputPassword2" name="inputPassword2">
            <div id="passwordHelpBlock" class="form-text">
                Your password must be 8-20 characters long, contain at least 1 letter and 1 number and 1 special character, and must not contain spaces, or emoji.
            </div>

            <hr>
            <button type="submit" id="submit" name="submit_edit" value="1">Submit changes</button>
        </form>
    </main>

</body>

</html>