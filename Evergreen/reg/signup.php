<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="reg_style.css">
</head>
<body> 
    <div class="container">
        <div class="form-box">
          <h1 id="title">Sign-up</h1>
            <form action=""> 
                <div class="input-group">
                    <div class="input-field"id="nameField">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Name">
                    </div>

                    <div class="input-field">
                        <i class="fa fa-envelope"></i>
                        <input type="email" placeholder="Email">
                    </div>

                    <div class="input-field">
                        <i class="fa fa-lock"></i>
                        <input type="password" placeholder="Password">
                    </div>

                </div>

                <div class="btn-field">
                    <button type="button" id="signupBtn">SIGN UP</button>
                    <!-- <button type="button" id="signinBtn" class="disable">SIGN IN</button> -->
                </div>

            </form>
        </div>
    </div>  
</body>

<script src="https://kit.fontawesome.com/c6ed361906.js" crossorigin="anonymous"></script>
</html>