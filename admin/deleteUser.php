<?php
require('../function.inc.php');
require('./adminFunctions.php');
requiredLoggedInAdmin();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
 error_reporting(E_ALL);

// print '<pre>';
// print_r($errors);
// print '</pre>';


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: adminUserCrud.php?error=Invalid user ID");
    exit;
}

$id = intval($_GET['id']);


$user = getUserById($id); 

if (!$user) {
    header("Location: adminUserCrud.php?error=User not found");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm'])) {
        if (deleteThisUser($id)) {
            header("Location: adminUserCrud.php?message=User '{$user['firstname']} {$user['lastname']}' deleted successfully");
            exit;
        } else {
            $error = "Error deleting user.";
        }
    } else {
        header("Location: adminUserCrud.php?message=Deletion cancelled");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Confirm Deletion</h1>
        <p>Are you sure you want to delete the user <strong><?= htmlspecialchars($user['firstname']) . ' ' . htmlspecialchars($user['lastname']); ?></strong> (ID: <?= $user['id']; ?>)?</p>
        <p class="text-danger"><strong>This action cannot be undone!</strong></p>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <button type="submit" name="confirm" class="btn btn-danger">Delete</button>
            <a href="adminUserCrud.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>