<?php
$errors = [];
require('../function.inc.php');
require('./adminFunctions.php');
requiredLoggedInAdmin();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $username = $_POST['username'] ?? '';
    $country = $_POST['country'] ?? '';
    $mail = $_POST['mail'] ?? '';
    $petname = $_POST['petname'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($firstname) || empty($lastname) || empty($mail) || empty($username) || empty($password)) {
        $errors[] = "All fields marked with * are required.";
    }

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please provide a valid email address.";
    }

    if (checkExistingUser($username, $mail)) {
        $errors[] = "Username or email already exists. Please choose a different one.";
    }

    if (empty($errors)) {
        $result = addNewUser($firstname, $lastname, $mail, $country, $username, $petname, $password);
        if ($result) {
            header("Location: adminUserCrud.php?message=User '{$firstname} {$lastname}' added successfully");
            exit;
        } else {
            $errors[] = "Error adding user. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/icon" href="../images/Pet paradise.png" />
</head>

<body>
    <div class="container mt-5">
        <h1>Add User</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name*</label>
                <input type="text" name="firstname" id="firstname" class="form-control" value="<?= htmlspecialchars($firstname ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name*</label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="<?= htmlspecialchars($lastname ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select name="country" id="country" class="form-select">
                    <?php
                    $countries = [
                        "Albania",
                        "Andorra",
                        "Austria",
                        "Belarus",
                        "Belgium",
                        "Bosnia and Herzegovina",
                        "Bulgaria",
                        "Croatia",
                        "Cyprus",
                        "Czech Republic",
                        "Denmark",
                        "Estonia",
                        "Finland",
                        "France",
                        "Germany",
                        "Greece",
                        "Hungary",
                        "Iceland",
                        "Ireland",
                        "Italy",
                        "Kosovo",
                        "Latvia",
                        "Liechtenstein",
                        "Lithuania",
                        "Luxembourg",
                        "Malta",
                        "Moldova",
                        "Monaco",
                        "Montenegro",
                        "Netherlands",
                        "North Macedonia",
                        "Norway",
                        "Poland",
                        "Portugal",
                        "Romania",
                        "San Marino",
                        "Serbia",
                        "Slovakia",
                        "Slovenia",
                        "Spain",
                        "Sweden",
                        "Switzerland",
                        "Ukraine",
                        "United Kingdom",
                        "Vatican City"
                    ];

                    foreach ($countries as $c) {
                        $selected = ($country === $c) ? 'selected' : '';
                        echo "<option value=\"" . htmlspecialchars($c) . "\" $selected>" . htmlspecialchars($c) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label">Email*</label>
                <input type="email" name="mail" id="mail" class="form-control" value="<?= htmlspecialchars($mail ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username*</label>
                <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($username ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="petname" class="form-label">Pet Name</label>
                <input type="text" name="petname" id="petname" class="form-control" value="<?= htmlspecialchars($petname ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password*</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
            <a href="adminUserCrud.php" class="btn btn-secondary">Cancel</a>
            <a href="adminUserCrud.php" class="btn btn-success">Back to User List</a>
        </form>
    </div>
</body>

</html>