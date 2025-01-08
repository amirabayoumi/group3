<?php
$errors = [];
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

// Check if data exists in POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $country = $_POST['country'];
    $mail = $_POST['mail'];
    $username = $_POST['username'];
    $petname = $_POST['petname'];
    $password = $_POST['password'];

// print '<pre>';
// print_r($_POST);
// print '</pre>';

    // Check for empty inputs
    if (empty($firstname) || empty($lastname) || empty($country) || empty($mail) || empty($username) || empty($petname)) {
        $error = "All fields are required.";
    } else {
        // updates user data
        $updateResult = editUser($id, $firstname, $lastname, $country, $mail, $username, $petname, $password);

        if ($updateResult) {
            // if success redirect to adminUserCrud.php
            header("Location: adminUserCrud.php?message=User '{$firstname} {$lastname}' updated successfully");
            exit;
        } else {
            $error = "Error updating user. Please check the database connection or query.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Edit User</h1>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" name="firstname" id="firstname" class="form-control" value="<?= htmlspecialchars($user['firstname'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="<?= htmlspecialchars($user['lastname'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select name="country" id="country" class="form-select" required>
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

                    foreach ($countries as $country) {
                        $selected = ($user['country'] === $country) ? 'selected' : '';
                        echo "<option value=\"" . htmlspecialchars($country) . "\" $selected>" . htmlspecialchars($country) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label">Email</label>
                <input type="email" name="mail" id="mail" class="form-control" value="<?= htmlspecialchars($user['mail'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($user['username'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="petname" class="form-label">Pet Name</label>
                <input type="text" name="petname" id="petname" class="form-control" value="<?= htmlspecialchars($user['petname'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password (leave blank to keep current)</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="adminUserCrud.php" class="btn btn-secondary">Cancel</a>
            <a href="adminUserCrud.php" class="btn btn-success">Back to User List</a>
        </form>

    </div>
</body>

</html>