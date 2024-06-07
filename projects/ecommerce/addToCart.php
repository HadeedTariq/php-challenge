<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "./config/utils.php";
    startSession();
    if (isset($_SESSION['id'])) {
        $productId = $_POST['cartBtn'];
        $userId = $_SESSION['id'];
        $cartCheckingSql = "SELECT * FROM cart WHERE product_id=$productId AND user_id=$userId";
        $result = mysqli_query($conn, $cartCheckingSql);
        if (mysqli_fetch_assoc($result)) {
            redirect("/?message=" . urlencode("Already added to cart"));
            exit();
        }
        $sql = "INSERT INTO cart (product_id,user_id) VALUES ($productId,$userId)";
        if (mysqli_query($conn, $sql)) {
            redirect("/?message=" . urlencode("Added to cart successfully"));
            exit();
        }
    }
    $cartError = "Please authenticate to do this work";
    redirect("/?message=" . urlencode($cartError));
    exit();
}
