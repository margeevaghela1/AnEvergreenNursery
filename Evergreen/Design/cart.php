<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_cart_item->execute([$delete_id]);
    header('location:cart.php');
}

if(isset($_GET['delete_all'])){

    $delete_all = $_GET['delete_all'];
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart_item->execute([$user_id]);
    header('location:cart.php');
}

if(isset($_POST['update_qty'])){

    $cart_id = $_POST['cart_id'];
    $p_qty = $_POST['p_qty'];
    $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);
    $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
    $update_qty->execute([$p_qty, $cart_id]);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping cart</title>

    <!-- font awesome cdn start-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- font awesome cdn end-->

    <!-- css file link -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'header.php'; ?>

<section class="cart">
    <h1 class="heading">Cart</h1>
    <table class="cart-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $grand_total = 0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if ($select_cart->rowCount() > 0) {
                while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                    $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                    $grand_total += $sub_total;
            ?>
                    <tr>
                        <td>
                            <div class="product-info">
                                <img src="img/<?= $fetch_cart['image']; ?>">
                                <div class="name"><?= $fetch_cart['name']; ?></div>
                            </div>
                        </td>
                        <td>
                            <!-- Add id attribute to the form -->
                            <form class="box" method="post" enctype="multipart/form-data" id="update_form_<?= $fetch_cart['id']; ?>">
                                <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                                <input type="number" min="1" max="50" value="<?= $fetch_cart['quantity'] ?>" name="p_qty" class="qty" onchange="updateSubtotal(<?= $fetch_cart['id']; ?>)">
                                
                            
                        </td>
                        <td class="total">₹<?= $fetch_cart['price']; ?>/-</td>
                        <td class="sub-total">₹<?= $sub_total; ?>/-</td>
                        <td>
                            <div class="action-buttons">
                            <input type="submit" value="Update" class="button update-button" name="update_qty">
                                <a href="cart.php?delete=<?= $fetch_cart['id']; ?>" class="button delete-button" onclick="return confirm('Delete product from cart?');">Delete</a>
                            </div>
                            </form>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="5" class="empty">Your cart is empty!</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <div class="cart-total">
        <p>Grand Total: <span class="grand-total">₹<?= $grand_total; ?>/-</span></p>
        <a href="product.php" class="option-btn">Continue Shopping</a>
        <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 0) ? '' : 'disabled'; ?>">Delete All Cart</a>
        <a href="checkout.php" class="btn <?= ($grand_total > 0) ? '' : 'disabled'; ?>">Checkout</a>
    </div>
</section>

<?php include 'footer.php'; ?>

<script>
    function updateSubtotal(cartId) {
        var form = document.getElementById('update_form_' + cartId);
        var qtyInput = form.querySelector('.qty');
        var subTotalElement = form.parentNode.nextElementSibling;
        var price = parseFloat(subTotalElement.previousElementSibling.innerText.replace('₹', '').replace('/-', ''));
        var quantity = parseFloat(qtyInput.value);
        var subTotal = price * quantity;
        subTotalElement.innerText = '₹' + subTotal.toFixed(2) + '/-';

        var grandTotalElements = document.querySelectorAll('.sub-total');
        var grandTotal = 0;
        grandTotalElements.forEach(function(subTotalElement) {
            grandTotal += parseFloat(subTotalElement.innerText.replace('₹', '').replace('/-', ''));
        });

        document.querySelector('.grand-total').innerText = '₹' + grandTotal.toFixed(2) + '/-';
    }
</script>

<script src="script.js"></script>

</body>
</html>
