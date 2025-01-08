<?php
$errors = [];
require('../function.inc.php');
requiredLoggedInAdmin();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// print '<pre>';
// print_r($errors);
// print '</pre>';

$users = getUser();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    if (deleteUser($id)) {
        header("Location: adminUserCrud.php?message=Record deleted successfully");
        exit;
    } else {
        $errors[] = "Error deleting user.";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Administration Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/adminProduct.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header>
        <h1>Administration Panel - Users</h1>
        <a href="./adminProfile.php">Back to Main Admin Page</a>
    </header>
    <main>
        <section>
            <h2>Users</h2>

            <?php if (isset($_GET['message'])): ?>
                <div class="alert alert-success" style="font-size: 1.2rem;">
                    <?= htmlspecialchars($_GET['message']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class=" alert alert-danger" style="font-size: 1.2rem;">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="get" action="./adminUserCrud.php">
            </form>
        </section>

        <div class="container">
            <div class="table-wrapper" style="position: relative; margin-top: 60px;">
                <a href="addform.php">
                    <button class="btn btn-success btn-lg" type="submit" style="position: absolute; top: -50px; right: 0;">
                        <i class="bi bi-plus-circle"></i> Add new item
                    </button>
                </a>


                <div class="table-responsive">
                    <div class="table-wrapper">

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">First name</th>
                                    <th scope="col">Last name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Pet name</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (isset($users) && is_array($users)): ?>
                                    <?php foreach ($users as $user): ?>

                                        <td><?= $user['id'] ?></td>
                                        <td><?= $user['firstname'] ?></td>
                                        <td><?= $user['lastname'] ?></td>
                                        <td><?= $user['username'] ?></td>
                                        <td><?= $user['country'] ?></td>
                                        <td><?= $user['mail'] ?></td>
                                        <td><?= $user['password'] ?></td>
                                        <td><?= $user['petname'] ?></td>
                                        <td>
                                            <a href="editUser.php?id=<?= $user['id']; ?>" class="d-inline-block me-2">
                                                <button type="button" class="btn btn-outline-warning">Edit</button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="deleteUser.php?id=<?= $user['id']; ?>" class="d-inline-block">
                                                <button type="button" class="btn btn-outline-danger">Delete</button>
                                            </a>
                                        </td>


                                        </tr>

                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">No users found.</td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </main>
</body>

</html>