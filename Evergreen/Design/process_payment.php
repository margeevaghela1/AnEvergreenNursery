<?php
$pdo = new PDO("mysql:host=localhost;dbname=evergreen", "root", "");

// Prepare the SQL statement to insert the transaction
$stmt = $pdo->prepare("INSERT INTO transactions (name, card_number, expiration_date, cvv, amount) VALUES (:name, :card_number, :expiration_date, :cvv, :amount)");

// Bind the values to the parameters
$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':card_number', $_POST['card_number']);
$stmt->bindParam(':expiration_date', $_POST['expiration_date']);
$stmt->bindParam(':cvv', $_POST['cvv']);
$stmt->bindParam(':amount', $_POST['amount']);

// Execute the statement
$stmt->execute();

// Redirect the user to a success page
header("Location: checkout.php");
?>