<?php
require('../function.inc.php');
requiredLoggedInAdmin();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);



$errors = [];
$inputUrl = '';
$cat;

if (isset($_POST['formSubmit'])) {

    // validation for URL
    if (!isset($_POST['inputUrl'])) {
        $errors[] = "URL is required";
    } else {
        $inputUrl = $_POST['inputUrl'];

        // check if URL is no longer than 255 characters
        if (strlen($inputUrl) == 0) {
            $errors[] = "URL is required";
        } elseif (!preg_match("/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/", $inputUrl)) {
            $errors[] = "URL is not valid";
        } elseif (strlen($inputUrl) > 255) {
            $errors[] = "URL is too long";
        }
        if (!isset($_POST['category']) || $_POST['category'] < 1) {
            $errors[] = "Product category is required ";
        } else {
            $cat =  $_POST['category'];
        }
    }
    //validation for category 

    print '<pre>';
    print_r($_POST);
    print '</pre>';
    // print '<pre>';
    // print_r($errors);
    // print '</pre>';
    if (!count($errors)) {


        // haal og title, descrr,.... op via api
        $ogData = getOgViaApi($inputUrl);

        $ogtitle = @$ogData->hybridGraph->title ?? '';
        $ogdescription = @$ogData->hybridGraph->description ?? '';
        $ogimage = @$ogData->hybridGraph->image ?? '';
        $ogprice =  @$ogData->hybridGraph->products[0]->offers[0]->price ?? '';

        // var_dump($ogprice);

        // insert into db
        $id = insertOgLink($inputUrl, $ogtitle, $ogdescription, $ogimage, $ogprice, $cat);
        unset($_POST);
        $AddMessage = "Product added successfully";
        if (!$id) {
            $errors[] = "Something unexplainable happened...";
        }
    }
    print '<pre>';
    print_r($ogData);
    print '</pre>';
}

// $items = getOgLinks();


// print '<pre>';
// print_r($items);
// print '</pre>';



//--------------- pagination products in Admin zone 
$items = getItems();

$start = 0;
$rowsPerPage = 8;
$pages = ceil(count($items) / $rowsPerPage);
// print $pages;

$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($currentPage < 1) {
    $currentPage = 1;
} elseif ($currentPage > $pages) {
    $currentPage = $pages;
}
$start = ($currentPage - 1) * $rowsPerPage;
$dataPerPage = getProductPerPage($start, $rowsPerPage);

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


</head>

<body>
    <header>
        <h1>Administration Panel - Products</h1>
        <a href="./adminProfile.php">Back to Main Admin Page</a>
    </header>
    <main>
        <section>
            <h2> Add New Product </h2>
            <?php if (count($errors)) : ?>
                <div>
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="./adminaddproduct.php">
                <div> <label for="inputUrl">URL: *</label>
                    <input type="text" id="inputUrl" name="inputUrl" placeholder="https://..." value="<?php if (isset($_POST['inputUrl'])) {
                                                                                                            print $_POST['inputUrl'];
                                                                                                        } else {
                                                                                                            print '';
                                                                                                        } ?>">
                </div>
                <div> <label for="category">Choose a product category:</label>
                    <select name="category" id="category">
                        <option value="0" selected> Select</option>
                        <option value="1">Toy</option>
                        <option value="2">Food</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="formSubmit">+</button>
            </form>
        </section>

        <?php if (isset($_GET["message"])): // msg from get 
        ?>

            <div class="alert alert-warning" role="alert" style="margin:1rem; width:60%; display:grid; place-self:center;">
                <?= $_GET["message"]; ?>
            </div>

        <?php endif; ?>
        <div class="container">

            <div class="table-responsive">
                <div class="table-wrapper">

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>ProductName</th>
                                <th>Description</th>
                                <th>URL</th>
                                <th>Price</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($dataPerPage as $item): ?> <tr>

                                    <td><?= $item['id']; ?></td>
                                    <td><?= ($item['image'] !== null && strlen($item['image']) > 0) ? '<img style="width:50px; " src="' . $item['image'] . '" class="thumb"/>' : 'no image'; ?></td>
                                    <td><?= mb_strimwidth(($item['title'] ?? 'no title'), 0, 25, "..."); ?></td>
                                    <td><?= mb_strimwidth(($item['description'] ?? 'no description'), 0, 50, "..."); ?></td>
                                    <td><?= mb_strimwidth($item['url'], 0, 50, "..."); ?></td>
                                    <td><?= $item['price']; ?></td>

                                    <td><span class="status text-<?= ($item['status']) == 0 ? "warning" : "success"; ?>">&bull;</span> <?php if (!$item['status']) {
                                                                                                                                            print "not-available";
                                                                                                                                        } else {
                                                                                                                                            print "available";
                                                                                                                                        }; ?></td>
                                    <td>
                                        <!-- <a href="#?id=<?= $item['id']; ?>" class="settings" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a> -->
                                        <a href="./deleteProduct.php?delete=<?= $item['id']; ?>" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <ul class="pagination" style="display:flex; place-self:center;">


            <li class="page-item <?php if ($currentPage == 1) {
                                        print "hidden";
                                    } ?> "><a href="./adminaddproduct.php?page=<?php echo $currentPage - 1; ?>">Previous</a></li>
            <li class="page-item"><a href="./adminaddproduct.php?page=<?= 1 ?>">First</a></li>
            <li> <?php for ($i = 1; $i <= $pages; $i++) : ?>
                    <a href="adminaddproduct.php?page=<?= $i; ?>"><?= $i; ?></a>
                <?php endfor; ?>
            </li>
            <li class="page-item"><a href="./adminaddproduct.php?page=<?= $pages ?>">Last</a></li>
            <li class="page-item <?php if ($currentPage >= $pages) {
                                        print "hidden";
                                    } ?> "><a href="./adminaddproduct.php?page=<?= $currentPage  + 1; ?>" class="page-link">Next</a></li>

        </ul>

    </footer>
</body>

</html>