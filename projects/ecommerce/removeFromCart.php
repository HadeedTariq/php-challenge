<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "./config/utils.php";
    startSession();
    if (isset($_SESSION['id'])) {
        $productId = $_POST['cartBtn'];
        $userId = $_SESSION['id'];
        $sql = "DELETE  FROM cart WHERE cart.product_id=$productId";
        if (mysqli_query($conn, $sql)) {
            redirect("/cart.php/?message=" . urlencode("Deleted from cart successfully"));
            exit();
        }
    }
    $cartError = "Please authenticate to do this work";
    redirect("/?message=" . urlencode($cartError));
    exit();
}
