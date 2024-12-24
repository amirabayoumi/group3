<?php

session_start();
print '<pre>';
print_r($_SESSION);
print '</pre>';

unset($_SESSION['loggedin']);

header("Location: index.php");
exit;
