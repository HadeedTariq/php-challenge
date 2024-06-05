<?php include "./config/db.php" ?>

<?php
session_start();
$isAuthenticate = false;
if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    $isAuthenticate = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce </title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        button {
            margin: 2px;
        }

        .success {
            color: green;
        }

        .err {
            color: red;
        }

        .main {
            display: flex;
            flex-direction: column;
            width: 100vw;
            min-height: 100vh;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .logo a {
            text-decoration: none;
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }

        .nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .nav li {
            margin-left: 20px;
        }

        .nav a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
        }

        .search-bar {
            display: flex;
        }

        .search-bar input {
            padding: 5px;
            border: none;
            border-radius: 3px 0 0 3px;
        }

        .search-bar button {
            padding: 5px 10px;
            border: none;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 0 3px 3px 0;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #45a049;
        }

        .icons {
            display: flex;
            align-items: center;
        }

        .icon {
            text-decoration: none;
            color: #fff;
            margin-left: 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .icon:hover {
            color: #ddd;
        }
    </style>
</head>

<body>
    <div class="main">
        <header class="header">
            <div class="container">
                <div class="logo">
                    <a href="/">MyStore</a>
                </div>
                <nav class="nav">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Shop</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
                <div class="search-bar">
                    <input type="text" placeholder="Search for products...">
                    <button type="button">Search</button>
                </div>
                <div class="icons">
                    <?php if (!$isAuthenticate) { ?>
                        <a href="./login.php" class="icon">Login</a>
                        <a href="./register.php" class="icon">Register</a>
                    <?php } else { ?>
                        <form action="logout.php" method="get">
                            <button type="submit">Logout</button>
                        </form>
                        <a href="/createProduct.php"><button>Create Product</button></a>
                    <?php } ?>
                </div>
            </div>
        </header>