<?php include "./config/navbar.php" ?>
<?php
if (!$isUser) {
    redirect("/");
}
$userId = $_SESSION['id'];
$blogPosts = [];
$sql = "SELECT blogpost.*,user.username AS creator_name FROM blogpost JOIN user ON  user.id=blogpost.creator WHERE blogpost.creator=$userId";
$result = mysqli_query($conn, $sql);
while ($blogPost = mysqli_fetch_assoc($result)) {
    array_push($blogPosts, $blogPost);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Card</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .main {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .blog-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 350px;
            margin: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .blog-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .blog-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .blog-card-content {
            padding: 20px;
        }

        .blog-card-title {
            font-size: 1.5em;
            margin: 0;
            color: #333;
        }

        .blog-card-description {
            color: #555;
            margin: 15px 0;
            font-size: 0.9em;
            line-height: 1.6;
        }

        .blog-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
        }

        .blog-card-author {
            font-weight: bold;
            color: #4CAF50;
        }

        .blog-card-date {
            color: #888;
            font-size: 0.8em;
        }

        .read-more {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .read-more:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="main">
        <?php
        foreach ($blogPosts as $blogPost) {
        ?>
            <div class="blog-card">
                <img src="<?= $blogPost['blogImage'] ?>" alt="Blog Image">
                <div class="blog-card-content">
                    <h2 class="blog-card-title"><?= $blogPost['title'] ?></h2>
                    <p class="blog-card-description">
                        <?= $blogPost['description'] ?>
                    </p>
                    <div class="blog-card-footer">
                        <span class="blog-card-author"><?= $blogPost['creator_name'] ?></span>
                        <span class="blog-card-date">
                            <?= $blogPost['created_at'] ?>
                        </span>
                    </div>
                    <a href="deleteBlog.php?blogId=<?php echo urlencode($blogPost['blog_id']) ?>" class="err">Delete Blog</a>
                    <a href="editBlog.php?blogId=<?php echo urlencode($blogPost['blog_id']) ?>" class="success">Edit Blog</a>
                </div>
            </div>
        <?php }
        ?>
    </div>
</body>

</html>