<?php include "./header.php" ?>
<?php include "./addToCart.php" ?>

<?php
$userId = -1;
$cartResponse = "";
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
} else {
    redirect("/");
    exit();
}
if (isset($_GET['message'])) {
    $cartResponse = $_GET['message'];
}
$products = [];
$sql = "SELECT *,cart.id FROM cart JOIN products ON cart.product_id=products.product_id";
$response = mysqli_query($conn, $sql);
while ($product =  mysqli_fetch_assoc($response)) {
    array_push($products, $product);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .products {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            padding: 8px;
        }

        .product-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-2px);
        }

        .product-image img {
            width: 100%;
            height: auto;
        }

        .product-info {
            padding: 20px;
            text-align: center;
        }

        .product-name {
            font-size: 1.5em;
            margin: 10px 0;
        }

        .product-description {
            color: #555;
            font-size: 0.9em;
            margin-bottom: 20px;
        }

        .product-price {
            font-size: 1.2em;
            color: #333;
            margin-bottom: 20px;
        }

        .remove-from-cart {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .remove-from-cart:hover {
            background-color: pink;
        }
    </style>
</head>

<body>
    <p>
        <?php
        echo   $cartResponse;
        ?>
    </p>
    <div class="products">
        <?php foreach ($products as $product) { ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="<?php echo $product['productImage']; ?>" alt="Product Image">
                </div>
                <div class="product-info">
                    <h2 class="product-name"><?php echo $product['productTitle']; ?></h2>
                    <p class="product-description"><?php echo $product['productDescription']; ?></p>
                    <div class="product-price">$<?php echo $product['productPrice']; ?></div>
                    <form action="removeFromCart.php" method="post">
                        <button class="remove-from-cart" type="submit" name="cartBtn" value="<?php echo $product['product_id']; ?>">Remove From Cart</button>
                    </form>
                </div>
            </div>
        <?php }; ?>
    </div>
</body>

</html>