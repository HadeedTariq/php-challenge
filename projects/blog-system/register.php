<?php include "./config/navbar.php" ?>

<?php
if ($isUser) {
    redirect("/");
}
$generalErr = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $username = sanitizer($_POST['username']);
        $email = sanitizer($_POST['email']);
        $password = sanitizer($_POST['password']);
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user(username,email,password) VALUES ('$username','$email','$hashPassword')";
        if (mysqli_query($conn, $sql)) {
            $success = "User register successfully";
            redirect("/login.php");
        } else {
            $generalErr = "Something went wrong";
        }
    } else {
        $generalErr = "Please fill all the fields";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>

<body>
    <div id="register" class="form-container">
        <h2>Register</h2>
        <form class="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label for="register-username">Username</label>
                <input type="text" id="register-username" name="username" required>
            </div>
            <div class="form-group">
                <label for="register-email">Email</label>
                <input type="email" id="register-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="register-password">Password</label>
                <input type="password" id="register-password" name="password" required>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>

</body>

</html>