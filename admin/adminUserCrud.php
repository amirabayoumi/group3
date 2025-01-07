<?php
$errors = [];
require('../function.inc.php');
requiredLoggedInAdmin();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


print '<pre>';
print_r($_POST);
print '</pre>';

print '<pre>';
print_r($errors);
print '</pre>';

$users = getUser();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Получить ID из URL
    if (deleteUser($id)) {
        header("Location: index.php?message=Record deleted successfully");
        exit;
    } else {
        echo "Error: Could not delete record.";
        exit;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Products</title>
    <link rel="stylesheet" href="./css/adminProduct.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">


</head>

<body>
    <header>
        <h1>Administration Panel - Users</h1>
        <a href="./adminProfile.php">Back to Main Admin Page</a>
    </header>
    <main>
        <section>
            <h2>Users</h2>

            <form method="post" action="./adminUserCrud.php">
            </form>
        </section>
        <a href="addform.php"><button class="btn btn-success btn-lg float-right" type="submit"><i class="bi bi-plus-circle"></i> Add new item</button></a>
        <div class="container">

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
                                        <a href="edit.php?id=<?= $user['id']; ?>">
                                            <button type="button" class="btn btn-outline-warning">Edit</button></a>
                                        <a href="adminUserCrud.php">
                                            <a href="adminUserCrud.php?action=delete&id=<?php echo $user['id']; ?>"></a> <button type="button" class="btn btn-outline-danger">Delete</button></a>
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