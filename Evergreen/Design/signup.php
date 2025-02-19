<?php

include 'config.php';

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = ($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'img/'.$image;

    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select->execute([$email]);

    if($select->rowCount() > 0){
        $message[] = 'user email already exist!!';
    }
    else{
        $insert = $conn->prepare("INSERT INTO `users`(name, email, password, image) VALUE(?,?,?,?)");
        $insert->execute([$name, $email, $pass, $image]);
            
        if($insert){
            if($image_size > 2000000){
                $message[] = 'image size is too large';
            }
            else{
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'signup successfully';
                header('location:login.php');
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="reg_style.css">
</head>

<body>

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

    <div class="container">
        <div class="form-box">
          <h1 id="title">Sign-up</h1>
            <form action="" enctype="multipart/form-data" method="post"> 
                <div class="input-group">

                    <div class="input-field"id="nameField">
                        <!-- <i class="fas fa-user"></i> -->
                        <input type="text" name="name" placeholder="Name" required>
                    </div>

                    <div class="input-field">
                        <!-- <i class="fa fa-envelope"></i> -->
                        <input type="email" name="email" placeholder="Email" required>
                    </div>

                    <div class="input-field">
                        <!-- <i class="fa fa-lock"></i> -->
                        <input type="password" name="pass" placeholder="Password" required>
                    </div>

                    <div class="input-field">
                        <!-- <i class="fa fa-lock"></i> -->
                        <input type="file" name="image"  required accept="img/jpg, img/jpeg, img/png">
                    </div>

                </div>
                
                <p>already have account? <a href="login.php">click here!</a></p>

                <div class="btn-field">
                    <button type="submit" id="signupBtn" name="submit">SIGN UP</button>
                    <!-- <button type="button" id="signinBtn" class="disable">SIGN IN</button> -->
                </div>

            </form>
        </div>
    </div>  
</body>

<script src="https://kit.fontawesome.com/c6ed361906.js" crossorigin="anonymous"></script>
</html>