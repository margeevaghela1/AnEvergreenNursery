<?php

include 'config.php';

session_start();

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = ($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select->execute([$email, $pass]);
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if($select->rowCount() > 0){
        
        if($row['user_type'] == 'admin'){

            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
        
        }
        elseif($row['user_type'] == 'user'){
            
            $_SESSION['user_id'] = $row['id'];
            header('location:home_page.php');
        
        }
        else{
            $message[] = 'No user found!';
        }
    }
    else{
        $message[] = 'incorrect email or password!';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-in</title>
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
          <h1 id="title">Log-in</h1>
            <form action="" enctype="multipart/form-data" method="post"> 
                <div class="input-group">

                    <div class="input-field">
                        <!-- <i class="fa fa-envelope"></i> -->
                        <input type="email" name="email" placeholder="Email">
                    </div>

                    <div class="input-field">
                        <!-- <i class="fa fa-lock"></i> -->
                        <input type="password" name="pass" placeholder="Password">
                    </div>

                        <p>dont't have account <a href="signup.php">click here!</a></p>
                </div>

                <div class="btn-field">
                    <!-- <button type="button" id="signupBtn">SIGN UP</button> -->
                    <button type="submit" name="submit" id="loginBtn">LOG IN</button>
                </div>

            </form>
        </div>
    </div>  
</body>


<script src="https://kit.fontawesome.com/c6ed361906.js" crossorigin="anonymous"></script>
</html>