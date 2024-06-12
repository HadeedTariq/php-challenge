<?php include "./config/utils.php" ?>

<?php
checkUser();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogify</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .err {
            color: red;
        }

        .success {
            color: green;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar .logo {
            float: left;
            color: white;
            font-size: 24px;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar .nav-links {
            list-style: none;
            margin: 0;
            padding: 0;
            float: right;
        }

        .navbar .nav-links li {
            float: left;
        }

        .navbar .nav-links li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar .nav-links li a:hover {
            background-color: #575757;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
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
    <nav class="navbar">
        <a href="/">
            <div class="logo">Blogify</div>
        </a>
        <ul class="nav-links">
            <?php if ($isUser) { ?>
                <li><a href="myBlogs.php">My Blogs</a></li>
                <li><a href="createBlog.php">Create Blog</a></li>
                <form action="logout.php" method="get" class="form">
                    <button style="background-color: red; margin: 3px;" type="submit">Logout</button>
                </form>
            <?php } ?>
            <?php if (!$isUser) { ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php } ?>

        </ul>
    </nav>

</body>

</html>