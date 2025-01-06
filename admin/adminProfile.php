<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require('../function.inc.php');
requiredLoggedInAdmin();

// print '<pre>';
// print_r($_SESSION);
// print '</pre>';



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {

            background-color: rgb(255, 255, 255);
            min-height: 100vh;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: rgb(88, 87, 87);

            header {


                a {
                    margin: 1rem;
                    text-decoration: none;
                    background-color: #244d3b;
                    color: white;
                    padding: 1rem;
                    border-radius: 5px;

                }

                div {
                    text-align: center;
                }
            }

            main {
                margin-top: 4rem;
                width: 50%;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
                place-self: center;

                a {
                    text-decoration: none;
                    background-color: #244d3b;
                    color: white;
                    padding: 0.5rem 1rem;
                    text-align: center;
                    border-radius: 10px;

                }

            }
        }
    </style>



</head>

<body>
    <header>
        <a href="./logoutAdmin.php"><i>Logout</i> </a>
        <div>
            <h1>Welcome Back, Admin!</h1>
            </p>You have now access to the main dashboard</p>
        </div>

    </header>
    <main>
        <a href="./adminUserCrud.php" title="Create, update, and manage user accounts .">
            <p>User Management</p>
        </a>
        <a href="./adminaddproduct.php" title="Oversee products, Add product, Delete product and keep inventory organized.">
            <p> Product Management </p>
        </a>
    </main>

</body>

</html>