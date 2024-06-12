<?php include "./config/navbar.php" ?>
<?php
if (!$isUser) {
    redirect("/");
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['blogId'])) {
        $userId = $_SESSION['id'];
        $blogId = $_GET['blogId'];
        $sql = "DELETE FROM blogpost WHERE blog_id=$blogId AND creator=$userId";
        if (mysqli_query($conn, $sql)) {
            redirect('/myBlogs.php?message=' . urlencode("Blog deleted successfully"));
        } else {
            echo "Something went wrong";
        }
    } else {
        redirect("/");
    }
}
?>