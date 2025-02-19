<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
                <a href="index.php"> <img src="img\logo2.png"> </a>
            </div>
    
            <form action="" class="search-bar-container">
                <input type="search" id="search-bar" placeholder="Search something...">
                <label for="search-bar" class="fas fa-search"></label>
            </form>
    
        </div>
    
        <div class="header-3">
    
            <div id="menu-bar" class="fas fa-bars"></div>
    
            <nav class="navbar">
                <a href="index.php">home</a>
                <a href="index.php">category</a>
                <a href="index.php">product</a>
                <a href="index.php">contact</a>
                
            </nav>
    
            <div class="icons">
                <a href="#" class="fas fa-shopping-cart"></a>
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-user-circle"></a>
            </div>
    
        </div>
    
    </header>

    <!-- header section end -->
    
    <!-- content of flower -->

    <section class="product" id="product">

        <h1 class="heading"> plants </h1>

        <div class="box-container">

            <div class="box">
                <span class="discount">-20%</span>
                <div class="icon">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <img src="img/English Red Rose Plant.jpg">
                <h3>English Red Rose Plant</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <div class="quantity">
                    <span>quantity : </span>
                    <input type="number" min="1" max="100" value="1">
                </div>
                <div class="price">₹150 <span>₹155</span></div>
                <a href="#" class="btn">add to cart</a>
            </div>

            <div class="box">
                <span class="discount">-10%</span>
                <div class="icon">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <img src="img/English Rose Light-Pink Plant.jpg">
                <h3>English Rose Light-Pink Plant</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <div class="quantity">
                    <span>quantity : </span>
                    <input type="number" min="1" max="100" value="1">
                </div>
                <div class="price">₹150 <span>₹155</span></div>
                <a href="#" class="btn">add to cart</a>
            </div>

            <div class="box">
                <span class="discount">-15%</span>
                <div class="icon">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <img src="img/Allamanda Yellow Vine.jpg">
                <h3>Allamanda Yellow Vine</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <div class="quantity">
                    <span>quantity : </span>
                    <input type="number" min="1" max="100" value="1">
                </div>
                <div class="price">₹150 <span>₹155</span></div>
                <a href="#" class="btn">add to cart</a>
            </div>

        </div>

    </section>

    <!-- end of content -->

    <!-- pagination section -->

    <ul class="pagination">
        <li class="pagination-item"> <a href="plant.php"> &laquo; </a> </li>
        <li class="pagination-item"> <a href="plant.php"> 1 </a> </li>
        <li class="pagination-item active">2</li>
    </ul>

    <!-- pagination end -->

    <!-- footer section start -->

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h1>About us</h1>
                <p>We are providing different varietie of plants, seeds, fertilizers & many more to come…</p>
            </div>
            <div class="box">
                <h1>Branch locations</h1>
                <a href="#">Ahmedabad</a>
                <a href="#">Gandhinagar</a>
                <a href="#">Rajkot</a>
            </div>
            <div class="box">
                <h1>quick links</h1>
                <a href="index.php">home</a>
                <a href="index.php">category</a>
                <a href="index.php">product</a>
                <a href="index.php">contact</a>
            </div>
            <div class="box">
                <h1>follow us!</h1>
                <a href="#">facebook</a>
                <a href="#">instagram</a>
                <a href="#">twitter</a>
                <a href="#">linkedin</a>
            </div>

        </div>

        <h1 class="credit"> created by <span> EverGreen Nursery </span> | all rights reserved! </h1>

    </section>

    <!-- footer section end -->


    <a href="#product" class="scroll-top fas fa-angle-up"></a>

    <!-- cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="script.js"></script>

</body>
</html>