<?php
require_once("./function.inc.php");
// Number of items per page
$rowsPerPage = 10;

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
// $items = getItems();



if (isset($_POST['search'])) {
    $items =  getItemsBySearch($_POST['searchname']);
} elseif (isset($_GET['cat'])) {
    $items = getItemsByCat($_GET['cat']);
    // print "<pre>";
    // print_r($items);
    // print "</pre>";
} else {
    $items = getProductPerPage($start, $rowsPerPage);

    // $items = getItems();
}
// print "<pre>";
// print_r($items);
// print "</pre>";

// $cat = getCategory();

// print "<pre>";
// print_r($cat);
// print "</pre>";

// Fetch the products for the current page (implement function getProductPerPage)

// print "<pre>";
// print_r($items);
// print "</pre>";
$lang = "";



$languages = [
    'aboutUsTitle' => [
        'en' => 'About Us',
        'nl' => 'Over ons',
        'ar' => 'من نحن',
        'ua' => 'Про нас'
    ],
    'aboutUs' => [
        'en' => 'Welcome to our pet e-paradise! 🐾 We are not a traditional pet shop; we are a carefully curated collection of the best products from top suppliers. In our webshop, you’ll find the purr-fect supplies for your furry friends! Our team works hard to select only high-quality, trusted items so you can spend less time searching and more time spoiling your beloved pets. Because your furry friends deserve nothing but the best!',
        'nl' => 'Welkom in ons huisdieren e-paradijs! 🐾 Wij zijn geen traditionele dierenwinkel; we zijn een zorgvuldig samengestelde collectie van de beste producten van top leveranciers. In onze webshop vind je alles wat je nodig hebt voor je harige vrienden! Ons team werkt hard om alleen hoogwaardige en vertrouwde producten te selecteren, zodat jij minder tijd kwijt bent aan zoeken en meer tijd hebt om je huisdieren te verwennen. Want jouw huisdieren verdienen alleen het allerbeste!',
        'ar' => 'مرحبًا بكم في جنة الحيوانات الأليفة الإلكترونية! 🐾 نحن لسنا متجر حيوانات أليف تقليدي؛ بل نحن مجموعة مختارة بعناية من أفضل المنتجات من الموردين الموثوقين. في متجرنا الإلكتروني، ستجدون كل ما تحتاجونه لرعاية أصدقائكم الفرويين! يعمل فريقنا بجد لاختيار منتجات عالية الجودة وموثوقة، لتقضوا وقتًا أقل في البحث ووقتًا أطول في تدليل حيواناتكم الأليفة. لأن أصدقائكم الفرويين يستحقون الأفضل دائمًا!',
        'ua' => 'Ласкаво просимо до нашого е-парадайсу для домашніх улюбленців! 🐾 Ми не звичайний зоомагазин; ми ретельно підібрана колекція найкращих продуктів від провідних постачальників. У нашому інтернет-магазині ви знайдете все необхідне для ваших пухнастих друзів! Наша команда наполегливо працює, щоб обирати лише якісні та перевірені товари, щоб ви витрачали менше часу на пошуки і більше – на піклування та ласку для ваших улюбленців. Адже ваші домашні друзі заслуговують лише найкращого!'
    ]

];
if (isset($_GET["lang"])) {
    if (in_array($_GET["lang"], array("en", "nl", "ar", "ua"))) {
        $lang = $_GET["lang"];
    }
} else {
    $lang = "en";
}
?>



<?php if (!isset($_GET['detail'])): ?>
    <section id="searchBar">
        <form id="searchForm" action="<?= $pageName; ?>" method="post">
            <input type="text" id='searchname' name='searchname' placeholder="Search... ">
            <button type="submit" id='search' name="search" class="btn btn-primary"><i class="icon-search"></i></button>
        </form>
    </section>


    <section id="aboutUs">
        <div id="languagesBar"><a href="<?php $pageName; ?>?lang=en">EN</a> | <a href="<?php $pageName; ?>?lang=nl">NL</a> | <a href="<?php $pageName; ?>?lang=ar">عربي</a> | <a href="<?php $pageName; ?>?lang=ua">UA</a></a></div>
        <h2><?= $languages['aboutUsTitle'][$lang]; ?></h2>
        <p>
            <?= $languages['aboutUs'][$lang]; ?>
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
                <article style="background-color: <?= !$item['status'] ? '#88a197e0' : ''  ?>">

                    <div id="item">
                        <img src="<?= $item['image']; ?>" alt="" />
                        <div>
                            <a href="<?= $pageName; ?>?detail=<?= $item['id']; ?>"><?= htmlspecialchars($item['title']); ?></a>
                            <h4><?= $item['price']; ?> &#8364;</h4>
                        </div>

                        <p>
                            <?= $item['description']; ?>
                        </p>
                    </div>
                    <div>

                        <p style="color: <?= !$item['status'] ? '#914f3b' : 'black'  ?>"> <?= !$item['status'] ? 'Not Available' : 'Available'  ?> </p>
                        <form action="<?= $pageName; ?>" method="post">
                            <button type="submit" style="visibility: <?php if (!isset($_SESSION['uid'])) {
                                                                            print "hidden;";
                                                                        } ?>" id=" <?php if ($item['user_id'] == $_SESSION['uid']) {
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
                                                                                                                                        }


                                                                                                                                        ?> </button>
                        </form>

                    </div>
                </article>

            <?php endforeach; ?>

        <?php else : ?>
            <h1 id="productNotFound">Oops! Sorry, no products were found. Please try searching again or send us a request with what you're looking for, and we'll be happy to assist you </h1>
        <?php endif; ?>
    </section>
    <section id="pagination">
        <ul>
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
    </section>
<?php elseif (isset($_GET['detail'])): ?>
    <?php require("./detail.php"); ?>
<?php endif; ?>