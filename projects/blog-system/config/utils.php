<?php include "./config/db.php"
?>

<?php
session_start();
$isUser;
function checkUser()
{
    global $isUser;
    if (isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['id'])) {
        $isUser = true;
    } else {
        $isUser = false;
    }
};
function sanitizer($userInput)
{
    global $conn;
    return mysqli_real_escape_string($conn, $userInput);
}
function redirect($url)
{
    header("Location: " . $url);
    exit();
}
function logoutUser()
{
    session_unset();
    session_destroy();
    redirect("/login.php");
    exit();
}
?>