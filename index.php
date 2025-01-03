<?php
include_once "includes/css_js.inc.php";
require("./header.php")

?>



<main>
    <section>
        <form action="index.php" method="post">
            <input style='width:400px' type="text" id='searchname' name='searchname' placeholder="Search... ">
            <button type="submit" id='search' name="search" class="btn btn-primary"><i class="icon-search">#TOSTYLE#</i></button>
        </form>
    </section>

    <section>
        <h2>About us</h2>
        <p>
            Welcome to our webshop! We are a small pet shop where you can find the
            purr-fect supplies for your furry friends!
        </p>
    </section>

    <section>
        <div id="categories">
            <article class="card mb-3" style="max-width: 90vh; display:grid; place-self:center;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <a href="index.php?cat=food"><img src="https://post.healthline.com/wp-content/uploads/2020/06/dog-food-1296x728-header.jpg" class="img-fluid rounded-start" alt="..."></a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Food</h5>

                        </div>
                    </div>
                </div>
            </article>
            <article class="card mb-3" style="max-width: 90vh; display:grid; place-self:center;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <a href="index.php?cat=toy"> <img src="https://i.etsystatic.com/38871768/r/il/76d029/6209376226/il_794xN.6209376226_1dn3.jpg" class="img-fluid rounded-start" alt="..."></a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Toy</h5>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <?php if (count($items) > 0): ?>

        <?php foreach ($items as $item): ?>
            <article class="card mb-3" style="max-width: 90vh; display:grid; place-self:center;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= $item['image']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title"><?= $item['title']; ?></h3>
                            <h3 class="card-price"><?= $item['price']; ?></h3>
                            <p class="card-text"><?= $item['description']; ?></p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>

    <?php else : ?>
        <h1>Oops! Sorry, no products were found. Please try searching again or send us a request with what you're looking for, and we'll be happy to assist you </h1>
    <?php endif; ?>
</main>