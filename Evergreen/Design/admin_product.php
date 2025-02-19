<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_POST['add_product'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $category = $_POST['category'];
    $category = filter_var($category, FILTER_SANITIZE_STRING);
    $details = $_POST['details'];
    $details = filter_var($details, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    // $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'img/'.$image;

    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
    $select_products->execute([$name]);

    if($select_products->rowCount() > 0){
        $message[] = 'product name already exist!';
    }
    else{
        $insert_products = $conn->prepare("INSERT INTO `products`(name, category, details, price, image) VALUES (?,?,?,?,?)");
        $insert_products->execute([$name, $category, $details, $price, $image]);

        if($insert_products){
            if($image_size > 2000000){
                $message[] = 'image size is too big!';
            }else{
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'new product added!';
            }
        }
    }

};

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $select_delete_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
    $select_delete_image->execute([$delete_id]);
    $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
    unlink('img/'.$fetch_delete_image['image']);
    $delete_products = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_products->execute([$delete_id]);
    $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
    $delete_wishlist->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
    $delete_cart->execute([$delete_id]);
    header('location:admin_product.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- css link -->
    <link rel="stylesheet" href="admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>



<section class="add-products">

    <h1 class="title">add new product</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="flex">
            <div class="inputBox">
            <input type="text" name="name" class="box" required placeholder="enter product name">
            <select name="category" class="box" required>
                <option value="" selected disabled>Select category</option>
                <option value="bonsai">bonsai</option>
                <option value="fertilizer">fertilizer</option>
                <option value="flower">flower</option>
                <option value="plants">plants</option>
                <option value="seeds">seeds</option>
            </select>
            </div>

            <div class="inputBox">
            <input type="number" min="0" name="price" class="box" required placeholder="enter product price">
            <input type="file" name="image" required class="box" accept="img/jpg, img/jpeg, img/png">
            </div>

        </div>

        <textarea name="details" class="box" required placeholder="enter product details" cols="30" rows="10"></textarea>
        <input type="submit" class="btn" value="add product" name="add_product">

    </form>

</section>

<section class="show-products">
    <h1 class="title">Products Added</h1>

    <div class="card-body">

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Price</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Details</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $show_products = $conn->prepare("SELECT * FROM `products`");
            $show_products->execute();
            if ($show_products->rowCount() > 0) {
                while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <tr>
                        <td>₹<?= $fetch_products['price']; ?>/-</td>
                        <td><img src="img/<?= $fetch_products['image']; ?>" alt="<?= $fetch_products['name']; ?>" width="100"></td>
                        <td><?= $fetch_products['name']; ?></td>
                        <td><?= $fetch_products['category']; ?></td>
                        <td><?= $fetch_products['details']; ?></td>
                        <td>
                            <a href="admin_update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Update</a>
                            <a href="admin_product.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="6" class="empty">No products added yet!</td></tr>';
            }
            ?>
        </tbody>
    </table>

    </div>

</section>




<script src="admin_script.js"></script>

</body>
</html>