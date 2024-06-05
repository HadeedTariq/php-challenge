<?php include "./header.php" ?>;

<?php
if (!isset($_SESSION['email']) && !isset($_SESSION['id'])) {
    header("Location: http://localhost:3000");
    exit();
};
$id = $_SESSION['id'];
$successMessage = null;
$errorMessage = null;
$uploadOk = true;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $randomBytes = openssl_random_pseudo_bytes(16);
    $randomId = bin2hex($randomBytes);
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($randomId . $_FILES['productImage']['name']);
    if ($_FILES["productImage"]["size"] > 5000000) {
        $uploadOk = false;
    } else {
    }
    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO products (productTitle,productDescription,productCategory,productOwner,productImage) VALUES ('$name','$description','$category',$id,'$target_file')";
        if (mysqli_query($conn, $sql)) {
            $successMessage = "Product Created sucessfully";
            header("Location: http://localhost:3000");
            exit();
        } else {
            $errorMessage = "Something went wrong";
        }
    }
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
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

        .form {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80vh;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .product-form {
            display: flex;
            flex-direction: column;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="form">
        <div class="form-container">
            <p><?= $successMessage ?></p>
            <p><?= $errorMessage ?></p>
            <form class="product-form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                <h2>Create Product</h2>
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" required>
                        <option value="electronics">Electronics</option>
                        <option value="fashion">Fashion</option>
                        <option value="home">Home</option>
                        <option value="books">Books</option>
                        <option value="sports">Sports</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="productImage">Product Image</label>
                    <input type="file" accept="image/*" id="productImage" name="productImage" required>
                </div>

                <button type="submit">Create Product</button>
            </form>
        </div>
    </div>
</body>

</html>