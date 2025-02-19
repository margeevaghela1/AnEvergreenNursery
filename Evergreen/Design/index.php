<?php

@include 'config.php';

session_start();

// $user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//     header('location:login.php');
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EverGreen Nursery</title>
    <link rel="icon" type="image/x-icon" href="img\logo1.png">
    <!-- swipper cdn link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!-- end swipeer link -->

    <!-- font awesome cdn start-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- font awesome cdn end-->

    <!-- css file link -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
    
    <!-- header section start -->

    <header>

        <div class="header-1">

            <div class="share">
                <span>Follow us : </span>
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>

            <div class="call">
                <span>Call us : </span>
                <a href="#">+917990761662</a>
            </div>

        </div>

        <div class="header-2">

            <div>
                <a href="#"> <img src="img\logo2.png"> </a>
            </div>

            <form action="" class="search-bar-container">
                <input type="search" id="search-bar" placeholder="Search something...">
                <input type="submit" name="search_btn" value="search" class="btn">
            </form>

        </div>

        <div class="header-3">

            <div id="menu-bar" class="fas fa-bars"></div>

            <nav class="navbar">
                <a href="#home">home</a>
                <a href="#category">category</a>
                <a href="#product">product</a>
                <a href="order.php">order</a>
                <a href="#contact">contact</a>
                
            </nav>

            <div class="icons" id="profile-container">
                <a href="#" class="fas fa-shopping-cart"></a>
                <a href="#" class="fas fa-heart"></a>
                <a href="#" id="profileBtn" class="fas fa-user-circle"></a>
                
                <!-- popup login & signup -->
                <div class="popup" id="popup">
                    <div class="popup-content">
                      <ul>
                        <li><a href="login.php" id="loginBtn">Login</a></li>
                        <li><a href="signup.php" id="signupBtn">Signup</a></li>
                      </ul>
                    </div>
                </div>
                <!-- end popup -->

            </div>

           

        </div>

    </header>

    <!-- header section end -->


    <!-- Home section start -->

    <section class="home" id="home">

        <div class="swiper home-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div class="box" style="background: url(img/slider1.jpg);">
                        <div class="content">
                            <span>upto 70% less price</span>
                            <h3>Plant at special price</h3>
                            <a href="#" class="btn">shop now!</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box" style="background: url(img/slider2.jpg);">
                        <div class="content">
                            <span>upto 40% less price</span>
                            <h3>Buy your dream plants</h3>
                            <a href="#" class="btn">shop now!</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box" style="background: url(img/slider3.jpg);">
                        <div class="content">
                            <span>upto 65% less price</span>
                            <h3>decore your home now</h3>
                            <a href="#" class="btn">shop now!</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="swiper-pagination"></div>

        </div>

    </section>

    <!-- Home section end -->



    <!-- banner section start -->

    <!-- <section class="banner-container">

        <div class="banner">
            <img src="img/banner1.jpg">
            <div class="content">
                <span>new arrivals</span>
                <h3>House plant</h3>
                <a href="#" class="btn">Shop now!</a>
            </div>
        </div>
        <div class="banner">
            <img src="img/banner2.jpg">
            <div class="content">
                <span>new arrivals</span>
                <h3>office plant</h3>
                <a href="#" class="btn">Shop now!</a>
            </div>
        </div>

    </section> -->

    <!-- banner section end -->



    <!-- category section start -->

    <section class="category" id="category">

        <h1 class="heading"> Shop by category </h1>

        <div class="box-container">

            <div class="box">
                <img src="img/bonsai.jpg">
                <div class="content">
                    <h3>Bonsai</h3>
                    <a href="category.php?category=bonsai" class="btn">Explore!</a>
                </div>
            </div>
            <div class="box">
                <img src="img/fertilizer.jpg">
                <div class="content">
                    <h3>fertilizer</h3>
                    <a href="category.php?category=fertilizer" class="btn">Explore!</a>
                </div>
            </div>
            <div class="box">
                <img src="img/flower.jpg">
                <div class="content">
                    <h3>Flower</h3>
                    <a href="category.php?category=flower" class="btn">Explore!</a>
                </div>
            </div>
            <div class="box">
                <img src="img/plant.jpg">
                <div class="content">
                    <h3>plants</h3>
                    <a href="category.php?category=plants" class="btn">Explore!</a>
                </div>
            </div>
            <div class="box">
                <img src="img/seed.jpg">
                <div class="content">
                    <h3>seeds</h3>
                    <a href="category.php?category=seeds" class="btn">Explore!</a>
                </div>
            </div>

        </div>

    </section>

    <!-- category section end -->



    <!-- product section start -->

    <section class="product" id="product">

        <h1 class="heading"> new products </h1>

        <div class="box-container">

            <?php
                $select_products =$conn->prepare("SELECT * FROM `products` LIMIT 6");
                $select_products->execute();
                if($select_products->rowCount() > 0){
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>

            <form class="box" method="post" enctype="multipart/form-data">
                <div class="icon">
                    <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                </div>
                <img src="img/<?= $fetch_products['image']; ?>">
                <div class="name"><?= $fetch_products['name']; ?></div>
                <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
                <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
                <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <div class="quantity">
                    <span>quantity : </span>
                    <input type="number" min="1" value="1" name="p_qty" class="qty">
                </div>
                <div class="price">₹<?= $fetch_products['price']; ?>/-</div>
                <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
                <input type="submit" value="add to cart" class="btn" name="add_to_cart">
            </form>

            <?php
                    }
                }
                else{
                    echo '<p class="empty">no products added yet</p>';
                }
            ?>

        </div>

    </section>

    <!-- product section end -->



    <!-- icons section start -->

    <section class="icons-container">

        <div class="icon">
            <img src="img/shipping.png" alt="">
            <div class="content">
                <h3>free shipping</h3>
                <p>get free shipping on order</p>
            </div>
        </div>
        <div class="icon">
            <img src="img/cashback.png" alt="">
            <div class="content">
                <h3>100% money back</h3>
                <p>have 15 days to return</p>
            </div>
        </div>
        <div class="icon">
            <img src="img/secure.png" alt="">
            <div class="content">
                <h3>payment secure</h3>
                <p>100% secure payment</p>
            </div>
        </div>
        <div class="icon">
            <img src="img/24_7.png" alt="">
            <div class="content">
                <h3>24/7 support</h3>
                <p>contact us anytime</p>
            </div>
        </div>

    </section>

    <!-- icons section end -->



    <!-- contact us section start -->

    <section class="contact" id="contact">

        <h1 class="heading">get in touch</h1>

        <div class="row">

            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d917.8095211986612!2d72.54225537135702!3d23.051731409647164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e851c0926ecab%3A0xc08bfe621d2551ac!2sSHRADDHA%20NURSERY!5e0!3m2!1sen!2sin!4v1705949362893!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            
            <form action="https://wa.me/+917990761662">

                <div class="inputbox">
                    <input type="text" required>
                    <label>name</label>
                </div>
                <div class="inputbox">
                    <input type="email" required>
                    <label>email</label>
                </div>
                <div class="inputbox">
                    <input type="number" required>
                    <label>number</label>
                </div>
                <div class="inputbox">
                    <textarea required name="" id="" cols="30" rows="10"></textarea>
                    <label>message</label>
                </div>

                <input type="submit" value="send message" class="btn">

            </form>

        </div>

    </section>

    <!-- contact us section end -->



    <!-- footer section start -->

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h1>About us</h1>
                <p>We are providing different varietie of plants, seeds, fertilizers & many more to come…</p>
            </div>
            <div class="box">
                <h1>Extra links</h1>
                <a href="cart.php"> <i class="fas fa-angle-right"></i> cart</a>
                <a href="wishlist.php"> <i class="fas fa-angle-right"></i> wishlist</a>
                <a href="login.php"> <i class="fas fa-angle-right"></i> login</a>
                <a href="signup.php"> <i class="fas fa-angle-right"></i> signup</a>
            </div>
            <div class="box">
                <h1>quick links</h1>
                <a href="#home"> <i class="fas fa-angle-right"></i> home</a>
                <a href="#category"> <i class="fas fa-angle-right"></i> category</a>
                <a href="#product"> <i class="fas fa-angle-right"></i> product</a>
                <a href="#contact"> <i class="fas fa-angle-right"></i> contact</a>
            </div>
            <div class="box">
                <h1>follow us!</h1>
                <a href="#">facebook</a>
                <a href="#">instagram</a>
                <a href="#">twitter</a>
                <a href="#">linkedin</a>
            </div>

        </div>

        <h1 class="credit"> created by <span> EverGreen Nursery </span> <br> &copy; copyright @<?= date('Y'); ?> | all rights reserved! </h1>

    </section>

    <!-- footer section end -->

    <!-- scroll top button -->

    <a href="#home" class="scroll-top fas fa-angle-up"></a>

    <!-- scroll top button end -->







    

    <!-- swipper js cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- swipper cdn end -->


    <!-- javascript file link -->
    <script src="script.js"></script>

    

</body>
</html>