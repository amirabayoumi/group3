<?php

session_start();
print '<pre>';
print_r($_SESSION);
print '</pre>';

unset($_SESSION['loggedinAdmin']);

header("Location: index.php");
exit;
