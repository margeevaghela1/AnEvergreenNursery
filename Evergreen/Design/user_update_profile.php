<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//     header('location:login.php');
// };

if(isset($_POST['update_profile'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
    $update_profile->execute([$name, $email, $user_id]);

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'img/'.$image;
    $old_image = $_POST['old_image'];

    if(!empty($image)){
        if($image_size > 2000000){
            $message[] = 'image size is to large!';
        }
        else{
            $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
            $update_image->execute([$image, $user_id]);
            if($update_image){
                move_uploaded_file($image_tmp_name, $image_folder);
                unlink('img/'.$old_image);
                $message[] = 'image updated successfully!';
            };
        };
    };

    $old_pass = $_POST['old_pass'];
    $update_pass = ($_POST['update_pass']);
    $update_pass = filter_var($update_pass, FILTER_SANITIZE_STRING);
    $new_pass = ($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $confirm_pass = ($_POST['confirm_pass']);
    $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

    if(!empty($update_pass) AND !empty($new_pass) AND !empty($confirm_pass)){
        if($update_pass != $old_pass){
            $message[] = 'old password not matched!';
        }
        elseif($new_pass != $confirm_pass){
            $message[] = 'confirm password not matched!';            
        }
        else{
            $update_pass_query = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_pass_query->execute([$confirm_pass, $user_id]);
            $message[] = 'password updated successfully!';
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update user page</title>

    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- css file link -->
    <!-- <link rel="stylesheet" href="style.css"> -->

    <!-- css file link -->
    <link rel="stylesheet" href="component.css">

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
                <label for="search-bar" class="fas fa-search"></label>
            </form>

        </div>

        <div class="header-3">

            <div id="menu_bar" class="fas fa-bars"></div>

            <nav class="navbar">
                <a href="home_page.php">home</a>
                <a href="category.php">category</a>
                <a href="home_page.php">product</a>
                <a href="order.php">order</a>
                <a href="home_page.php">contact</a>
             </nav>

            <div class="icons" id="profile-container">
                <!-- <a href="#" class="fas fa-shopping-cart"></a>
                <a href="#" class="fas fa-heart"></a>
                <a href="#" id="profileBtn" class="fas fa-user-circle"></a> -->
                
                <!-- popup login & signup -->
                <!-- <div class="popup" id="popup">
                    <div class="popup-content">
                      <ul>
                        <li><a href="login.php" id="loginBtn">Login</a></li>
                        <li><a href="signup.php" id="signupBtn">Signup</a></li>
                      </ul>
                    </div>
                </div> -->
                <!-- end popup -->

                <div class="profile">
                    <?php
                    
                        $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                        $select_profile->execute([$user_id]);
                        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

                    ?>



                    <!-- <div class="flex-btn">
                        <a href="login.php" class="option-btn">Login</a>
                        <a href="signup.php" class="option-btn">Signup</a>
                    </div> -->

                </div>

            </div>

           

        </div>

    </header>

    <!-- header section end -->

<section class="update-profile">

    <h1 class="title">update profile</h1>

    

    <form action="" method="POST" enctype="multipart/form-data">
        <img src="img/<?= $fetch_profile['image']; ?>" alt="">
        <div class="flex">
            <div class="inputBox">
                <span>username :</span>
                <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" placeholder="update username" required class="box">
                <span>email :</span>
                <input type="email" name="email" value="<?= $fetch_profile['email']; ?>" placeholder="update email" required class="box">
                <span>updare photo :</span>
                <input type="file" name="image" accept="img/jpg, img/jpeg, img/png" class="box">
                <input type="hidden" name="old_image" value="<?= $fetch_profile['image']; ?>">
            </div>
            
            <div class="inputBox">
                <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
                <span>old password :</span>
                <input type="password" name="update_pass" placeholder="enter old password" class="box">
                <span>new password :</span>
                <input type="password" name="new_pass" placeholder="enter new password" class="box">
                <span>confirm password :</span>
                <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
            </div>
        </div>

        <div class="flex-btn">
            <input type="submit" class="btn" value="update profile" name="update_profile">
            <a href="home_page.php" class="option-btn">go back</a>
        </div>

    </form>

</section>


<script src="admin_script.js"></script>

</body>
</html>