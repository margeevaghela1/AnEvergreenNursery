<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="ex.css">
</head>
<body>

<section class="credit">
    
    <form action="process_payment.php" method="post" class="card">
    <h1>credit card detail</h1>
        <label class="enter" for="name">account holder name:</label><br>
        <input class="take" type="text" id="name" name="name"><br>
        <label class="enter" for="card_number">Card Number:</label><br>
        <input class="take" type="text" id="card_number" name="card_number"><br>
        <label class="enter" for="expiration_date">Expiration Date:</label><br>
        <input class="take" type="text" id="expiration_date" name="expiration_date"><br>
        <label class="enter" for="cvv">CVV:</label><br>
        <input class="take" type="text" id="cvv" name="cvv"><br>
        <input class="buton" type="submit" value="Submit">
    </form>
</section>
</body>
</html>