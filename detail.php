<?php require("./header.php") ?>

<main>
    <form>
        <label for="search">Search</label>
        <input type="search" id="search" name="search" placeholder="What are you searching for?">
        <button type="submit" title="Search" class="action search" aria-label="Search">Search
        </button>
    </form>
    <section>
        <article>
            <figure>
                <img src="https://i.etsystatic.com/38871768/r/il/76d029/6209376226/il_794xN.6209376226_1dn3.jpg" alt="Product Image" width="300">
                <figcaption>Product Image</figcaption>
            </figure>
        </article>
        <aside>
            <h2>Product name</h2>
            <p>$$$</p>
            <input type="hidden" name="action" value="add_to_wishlist">
            <button type="submit" title="Add to Wishlist" class="action wishlist" aria-label="Add to Wishlist">
                Add to Wishlist
            </button>
            <input type="hidden" name="action" value="add_to_cart">
            <button type="submit" title="Add to Cart" class="action cart" aria-label="Add to Cart">
                Add to Cart
            </button>
            <section>
                <h3>Description</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Dolorem itaque ipsum nesciunt ex? Itaque cum minus similique
                    cumque libero, quidem voluptatum at? Illo commodi magnam
                    tempora! Quae repellendus aperiam illum?</p>
            </section>
        </aside>
        <a href="index.php" title="Back to Home">
            <button type="button">Back to Home</button>
        </a>
    </section>
</main>


<!-- <?php require('footer.inc.php'); ?>  - TODO-->