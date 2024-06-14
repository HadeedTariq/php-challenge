<?php include "./config/navbar.php" ?>

<?php
$blogId;
$blogPost;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['blogId'])) {
        $blogId = $_GET['blogId'];
        $sql = "SELECT * FROM blogpost WHERE blog_id=$blogId";
        $result = mysqli_query($conn, $sql);
        if ($blogPost = mysqli_fetch_assoc($result)) {
            $blogPost = $blogPost;
        } else {
            redirect("/");
        }
    } else {
        redirect("/");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogify: <?= $blogPost['title'] ?></title>
    <style>
        article {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .meta {
            font-style: italic;
            margin-bottom: 10px;
        }

        .content pre {
            background-color: black;
            color: yellow;
            padding: 12px;
            font-size: 19px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>

</head>

<body>
    <article>
        <h2><?= $blogPost['title'] ?></h2>
        <p class="meta">
            <?= $blogPost['created_at'] ?>
        </p>
        <div class="content">
            <?= $blogPost['content'] ?>

        </div>
    </article>


</body>

</html>