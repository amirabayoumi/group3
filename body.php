<style>
    @import url("https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300;400;700&display=swap");

    * {
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
                padding: 0.7rem;

                position: absolute;
                right: 0;
                top: 50%;


                &::placeholder {
                    color: white;
                }

            }

            button {
                font-size: 25px;
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

                    a {
                        padding: 0.2rem 1rem;
                        text-decoration: none;
                        background-color: white;
                        border: none;
                        border-radius: 5px;
                        font-size: 20px;
                        color: #244d3b;
                    }
                }
            }
        }
    }
</style>

<section id="searchBar">
    <form action="index.php" method="post">
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
        <a href="index.php?cat=food"><img src="https://5.imimg.com/data5/SELLER/Default/2023/9/341168148/DH/HC/FG/158448362/dog-food-500x500.jpg" alt="food">
            <h5>Food</h5>
        </a>

    </div>
    <div>
        <a href="index.php?cat=toy"> <img src="https://i.etsystatic.com/38871768/r/il/76d029/6209376226/il_794xN.6209376226_1dn3.jpg" alt="toy">
            <h5>Toys</h5>
        </a>

    </div>
    <div>
        <a href="index.php?cat=care"> <img src="https://www.animalhumanesociety.org/sites/default/files/styles/scale_width_960/public/media/image/2023-04/untitled-instagram-post-square.png.jpg?itok=cBCBr_Do" alt="care">
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
                    <a href="detail.php">Buy</a>
                </div>
            </article>

        <?php endforeach; ?>

    <?php else : ?>
        <h1>Oops! Sorry, no products were found. Please try searching again or send us a request with what you're looking for, and we'll be happy to assist you </h1>
    <?php endif; ?>
</section>
<ul>
    <li><a href="#">Previous</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">Next</a></li>
</ul>