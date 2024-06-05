<?php include "./header.php" ?>

<?php
session_unset();
session_destroy();
header("Location: http://localhost:3000/login.php");
exit();
?>