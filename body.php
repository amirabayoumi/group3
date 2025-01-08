<?php
require_once("./function.inc.php");
// Number of items per page
$rowsPerPage = 6;

// Determine the current page
if (isset($_GET['page'])) {
    $currentPage = (int)$_GET['page'];
    if ($currentPage < 1) {
        $currentPage = 1;
    }
} else {
    $currentPage = 1;
}

// Calculate the starting index for the database query
$start = ($currentPage - 1) * $rowsPerPage;

// Fetch total number of products to calculate total pages
$totalItems = count(getItems()); // Using getItems() to get all products
$pages = ceil($totalItems / $rowsPerPage);




// print '<pre>';
// print_r($items);
// print '</pre>';


// print '<pre>';
// print_r($_POST);
// print '</pre>';
// print '<pre>';
// print_r($_SESSION);
// print '</pre>';

if (isset($_POST["addWishItem"])) {
    if (($_POST["addWishItem"]) > 0) {
        if (isset($_SESSION["uid"])) {
            $userId = $_SESSION["uid"];
            $productId = $_POST["addWishItem"];
            addProductToWishlist($productId,  $userId);
        } else {
        }
    }
}

if (isset($_POST["takeOffWishItem"])) {
    if (($_POST["takeOffWishItem"]) > 0) {
        if (isset($_SESSION["uid"])) {
            $userId = $_SESSION["uid"];
            $productId = $_POST["takeOffWishItem"];
            deleteProductFromWishlist($productId,  $userId);
        }
    }
}

// Fetch the products for the current page (implement function getProductPerPage)
$items = getProductPerPage($start, $rowsPerPage);

?>


<style>
    @import url(https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css);
    @import url("https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300;400;700&display=swap");




    :root {
        --header-bg: #244d3b;
        --header-title-color: #ffffff;
        --header-signin-color: #96e7c5;

        --font-header-title: "Puppybellies", sans-serif;
        --font-body: "Comic Neue", sans-serif;
    }

    * {
        font-size: 62.5%;
        box-sizing: border-box;
    }

    #searchBar {
        min-height: 50px;
        margin: 1rem;

        form {

            position: relative;
            height: 100%;

            input {
                width: 400px;
                background-color: #6ec5aa;
                border: none;
                border-radius: 5px;
                padding: 1rem;

                position: absolute;
                right: 0;
                top: 50%;
                color: white;
                font-size: 1rem;
                font-weight: 500;

                &::placeholder {
                    color: white;
                    font-size: 1rem;
                }

            }

            button {
                font-size: 2rem;
                border: none;
                background-color: transparent;
                position: absolute;
                color: white;
                right: 0;
                top: 7.5px;
                /* outline for input field still black  */
                cursor: pointer;


            }
        }


    }

    #aboutUs {
        height: 20vh;
        width: 100%;
        background-color: #6ec5aa;
        text-align: center;
        padding: 1rem 0.5rem;
        display: grid;
        place-self: center;

        h2 {
            font-size: 30px;
            font-weight: bold;
            place-self: center;
        }

        p {

            font-size: 20px;

        }
    }

    #categories {

        margin: 2rem;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        width: 100%;


        div {
            overflow: hidden;

            a {
                position: relative;

                display: flex;
                justify-content: center;

                &:hover {
                    img {
                        transform: scaleX(-1);
                        border: 2px solid #96e7c5;
                    }

                    h5 {
                        text-shadow: 5px 5px 10px black;
                    }
                }

                img {
                    width: 60%;
                    aspect-ratio: 1/1;
                    border-radius: 10px;


                }

                h5 {
                    color: white;
                    font-size: 50px;
                    font-weight: 800;
                    position: absolute;
                    left: 50%;
                    top: 50%;
                    transform: translate(-50%, -50%);
                    text-shadow: 5px 5px 5px #244d3b;


                }
            }
        }



    }

    #itemsCards {
        margin: 4rem 2rem;
        display: grid;
        place-self: center;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;

        article {
            padding: 1.5rem;
            border-radius: 5px;
            background-color: #6ec5aa;

            >div {
                &:nth-child(1) {


                    img {
                        width: 100%;
                        aspect-ratio: 1/1;
                        display: grid;
                        place-self: center;
                    }

                    >div {
                        font-size: 20px;
                        font-weight: 600;
                        display: flex;
                        padding: 1rem 0;
                        justify-content: space-between;

                        p {}

                        h4 {}
                    }

                    >p {
                        min-height: 5vh;
                        font-size: 15px;
                    }

                }

                &:nth-child(2) {
                    margin-top: 1rem;
                    padding-top: 2rem;
                    display: flex;
                    justify-content: space-between;
                    border-top: 1px solid white;


                    p {
                        font-size: 14px;
                        color: darkslategrey;
                        white-space: nowrap;
                    }

                    button {
                        padding: 0.2rem 1rem;
                        text-decoration: none;
                        background-color: white;
                        border: none;
                        border-radius: 5px;
                        font-size: 20px;
                        color: #244d3b;

                        &:hover {
                            background-color: #244d3b;
                            color: #ffffff;
                        }
                    }
                }
            }
        }
    }
</style>

<section id="searchBar">
    <form action="<?= $pageName; ?>" method="post">
        <input type="text" id='searchname' name='searchname' placeholder="Search... ">
        <button type="submit" id='search' name="search" class="btn btn-primary"><i class="icon-search"></i></button>
    </form>
</section>

<section id="aboutUs">
    <h2>About us</h2>
    <p>
        Welcome to our webshop! We are a small pet shop where you can find the
        purr-fect supplies for your furry friends!
    </p>
</section>

<section id="categories">

    <div>
        <a href="<?php $pageName; ?>?cat=food"><img src="https://5.imimg.com/data5/SELLER/Default/2023/9/341168148/DH/HC/FG/158448362/dog-food-500x500.jpg" alt="food">
            <h5>Food</h5>
        </a>

    </div>
    <div>
        <a href="<?php $pageName; ?>?cat=toy"> <img src="https://i.etsystatic.com/38871768/r/il/76d029/6209376226/il_794xN.6209376226_1dn3.jpg" alt="toy">
            <h5>Toys</h5>
        </a>

    </div>
    <div>
        <a href="<?php $pageName; ?>?cat=care"> <img src="https://www.animalhumanesociety.org/sites/default/files/styles/scale_width_960/public/media/image/2023-04/untitled-instagram-post-square.png.jpg?itok=cBCBr_Do" alt="care">
            <h5>Care</h5>
        </a>

    </div>

</section>
<section id="itemsCards"><?php if (count($items) > 0): ?>



        <?php foreach ($items as $item): ?>
            <article>

                <div>
                    <img src="<?= $item['image']; ?>" alt="" />
                    <div>
                        <p><?= $item['title']; ?></p>
                        <h4><?= $item['price']; ?> &#8364;</h4>
                    </div>

                    <p>
                        <?= $item['description']; ?>
                    </p>
                </div>
                <div>

                    <p><?= $item['stock']; ?> left in stock</p>
                    <form action="<?= $pageName; ?>" method="post">
                        <button type="submit" id="<?php if ($item['user_id'] == $_SESSION['uid']) {
                                                        print "takeOffWishItem";
                                                    } else {
                                                        print "addWishItem";
                                                    }
                                                    ?>" name="<?php if ($item['user_id'] == $_SESSION['uid']) {
                                                                    print "takeOffWishItem";
                                                                } else {
                                                                    print "addWishItem";
                                                                }
                                                                ?>" value=" <?= $item['id']; ?>"> <?php if (isset($_SESSION['uid']) && $item['user_id'] == $_SESSION['uid']) {
                                                                                                        print "&#x2665;";
                                                                                                    } elseif (isset($_SESSION['uid']) && $item['user_id'] != $_SESSION['uid']) {
                                                                                                        print " Add &#x2665;";
                                                                                                    } else {
                                                                                                        print "register to add to your wishlist ";
                                                                                                    }


                                                                                                    ?> </button>
                    </form>

                </div>
            </article>

        <?php endforeach; ?>

    <?php else : ?>
        <h1>Oops! Sorry, no products were found. Please try searching again or send us a request with what you're looking for, and we'll be happy to assist you </h1>
    <?php endif; ?>
</section>
<ul class="pagination">
    <?php
    // This shows a "Previous" link only if the current page is greater than 1.
    if ($currentPage > 1): ?>
        <li><a href="<?= $pageName; ?>?page=<?= $currentPage - 1; ?>">Previous</a></li>
    <?php endif; ?>

    <?php
    // Loop through all pages to display page numbers.
    for ($i = 1; $i <= $pages; $i++): ?>
        <li <?= $i == $currentPage ? 'class="active"' : ''; ?>>
            <!-- Display page number as a link. "active" class added for the current page. -->
            <a href="<?= $pageName; ?>?page=<?= $i; ?>"><?= $i; ?></a>
        </li>
    <?php endfor; ?>

    <?php
    // Show "Next" link only if the current page is less than the total number of pages.
    if ($currentPage < $pages): ?>
        <li><a href="<?= $pageName; ?>?page=<?= $currentPage + 1; ?>">Next</a></li>
    <?php endif; ?>
</ul>