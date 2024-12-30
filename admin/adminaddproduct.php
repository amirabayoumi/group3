<?php
require('../function.inc.php');
requiredLoggedInAdmin();
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);



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
        }

        // check if URL is valid
        if (!preg_match("/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/", $inputUrl)) {
            $errors[] = "URL is not valid";
        }
        if (!isset($_POST['category'])) {
            $errors[] = "Product category is required ";
        } else {
            $cat =  $_POST['category'];
        }
    }
    //validation for category 


    if (!count($errors)) {


        // haal og title, descrr,.... op via api
        $ogData = getOgViaApi($inputUrl);

        $ogtitle = @$ogData->hybridGraph->title ?? '';
        $ogdescription = @$ogData->hybridGraph->description ?? '';
        $ogimage = @$ogData->hybridGraph->image ?? '';;



        // insert into db
        $id = insertOgLink($inputUrl, $ogtitle, $ogdescription, $ogimage, $cat);

        if (!$id) {
            $errors[] = "Something unexplainable happened...";
        }
    }
    print '<pre>';
    print_r($ogData);
    print '</pre>';
}
print '<pre>';
print_r($_POST);
print '</pre>';
// $items = getOgLinks();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>

<body>
    <header>
        <h1>Administration Panel - Products</h1>
        <h2>Add New Link</h2>

        <?php if (count($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="./adminaddproduct.php">
            <fieldset>
                <label for="inputUrl">URL: *</label>
                <input type="text" id="inputUrl" name="inputUrl" placeholder="https://..." value="<?= $inputUrl; ?>" required>
            </fieldset>

            <fieldset>
                <label for="category">Choose a product category:</label>
                <select name="category" id="category" required>
                    <option value="1">Food</option>
                    <option value="2">Toy</option>
                </select>
            </fieldset>
            <aside>
                <button type="button">Add Product</button>
                <button type="button">Delete Product</button>
            </aside>
    </header>
    <main>
        <h2>List of Products</h2>
        <section>
            <table>
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Price</th>
                        <th scope="col">Weight</th>
                        <th scope="col">URL</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 
                        <?php foreach ($items as $item): ?>

                            <tr>
                                <td><?= $item['id']; ?></td>
                                <td><?= ($item['ogimage'] !== null && strlen($item['ogimage']) > 0) ? '<img src="' . $item['ogimage'] . '" class="thumb"/>' : 'no image'; ?></td>
                                <td><?= mb_strimwidth(($item['ogtitle'] ?? 'no title'), 0, 50, "..."); ?></td>
                                <td><?= mb_strimwidth(($item['ogdescription'] ?? 'no description'), 0, 50, "..."); ?></td>
                                <td><?= mb_strimwidth($item['url'], 0, 50, "..."); ?></td>
                                <td><?= $item['weight']; ?></td>

                            </tr>

                        <?php endforeach; ?> -->
                    <!-- Example row, replace this with dynamic content -->
                    <tr>
                        <td><input type="checkbox" name="productSelection[]"></td>
                        <td><img src="product-image.jpg" alt="Product Image" height="50"></td>
                        <td>Example Product</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                        <td>Available</td>
                        <td>50</td>
                        <td>$19.99</td>
                        <td>1.5kg</td>
                        <td>https://example.com/product-link</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <nav aria-label="Overview navigation">
            <ul>
                <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </main>
</body>

</html>