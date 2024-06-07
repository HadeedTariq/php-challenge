<?php include "./config/db.php" ?>
<?php
function redirect($url)
{
    header("Location: " . $url);
    exit;
}
function startSession()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}
?>