<?php
// require('./function.inc.php');
// requiredLoggedIn();

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

if (isset($_POST['cancel'])) {
    header("Location:profile.php");
}

?>

<form action="deleteProfile.php" method="post" id="deleteProfile">
    <h1>Are you sure you want to delete your profile?</h1>
    <section>
        <button type="submit" name="deleteUser">Yes, I'm sure!</button>
        <button type="submit" name="cancel">Cancel</button>
    </section>
</form>