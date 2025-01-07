<?php
require('./function.inc.php');
requiredLoggedIn();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (isset($_SESSION['uid'])) {
    $userId = @$_SESSION['uid'];
    $user = getUserById($userId);
}

if (isset($_POST['deleteUser'])) {
    deleteUser($_SESSION['uid']);
    unset($_SESSION['loggedin']);
    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete profile</title>
    <link rel="stylesheet" href="css/deleteUserProfile.css">
    <link rel="stylesheet" href="css/userProfileHeader.css">
</head>

<body>

    <main>
        <form action="deleteProfile.php" method="post">
            <h1>Are you sure you want to delete your profile?</h1>
            <button type="submit" name="deleteUser">Yes I am sure</button>
        </form>


    </main>

</body>

</html>