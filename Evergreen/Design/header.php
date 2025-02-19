<?php

if(isset($message)){
    foreach($message as $message){
      echo '  
    <div class="message">
        <span>'.$message.'</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
      ';  
    }
}

?>
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
                <a href="home_page.php"> <img src="img\logo2.png"> </a>
            </div>

            <form action="" class="search-bar-container" method="post">
                <input type="text" name="search_box" id="search-bar" placeholder="Search something...">
                <input type="submit" name="search_btn" value="search" class="btn">
            </form>

        </div>

        <div class="header-3">

            <div id="menu-bar" class="fas fa-bars"></div>

            <nav class="navbar">
                <a href="home_page.php">home</a>
                <a href="#category">category</a>
                <a href="product.php">product</a>
                <a href="order.php">order</a>
                <a href="home_page.php">contact</a>
                
            </nav>

            <div class="icons" id="profile-container">

                <?php
                    $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                    $count_cart_items->execute([$user_id]);
                    $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                    $count_wishlist_items->execute([$user_id]);
                ?>
                <a href="cart.php" class="fas fa-shopping-cart"><span>(<?= $count_cart_items->rowCount(); ?>)</span></a>
                <a href="wishlist.php" class="fas fa-heart"><span>(<?= $count_wishlist_items->rowCount(); ?>)</span></a>
                <a href="#" id="profileBtn" class="fas fa-user-circle"></a>
                
                <!-- popup login & signup -->
                <div class="popup" id="popup">
                    <div class="popup-content">
                      <ul>
                        <li><a href="user_update_profile.php">View profile</a></li>
                        <li><a href="logout.php">Logout</a></li>
                      </ul>
                    </div>
                </div>
                <!-- end popup -->

            </div>

           

        </div>

    </header>

    <!-- header section end -->