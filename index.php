<?php
include_once "includes/css_js.inc.php";
require("./header.php")

?>



<hr>
<main>

    <form action="index.php" method="post">


        <input style='width:400px' type="text" id='searchname' name='searchname' placeholder="Search by product ">
        <button type="submit" id='search' name="search" class="btn btn-primary"><i class="fa fa-search"> Search</i></button>
    </form>
    <hr>

    <div class="card mb-3" style="max-width: 90vh; display:grid; place-self:center;">
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
    </div>

    <div class="card mb-3" style="max-width: 90vh; display:grid; place-self:center;">
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
    </div>
    <hr>
    <hr>
    <?php foreach ($items as $item): ?>
        <div class="card mb-3" style="max-width: 90vh; display:grid; place-self:center;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?= $item['ogimage']; ?>" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item['ogtitle']; ?></h5>
                        <p class="card-text"><?= $item['ogdescription']; ?></p>
                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</main>