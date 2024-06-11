<?php include "./config/navbar.php" ?>
<?php
if ($isUser) {
    redirect("/");
}
$emailErr = $passwordErr = "";
$generalErr = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = sanitizer($_POST['email']);
        $password = sanitizer($_POST['password']);
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($result);
        if (empty($result)) {
            $emailErr = "Incorrect Email";
        } else {
            $isPasswordCorrect = password_verify($password, $result['password']);
            if ($isPasswordCorrect) {
                $success = "User logged in successfully";
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $result['username'];
                $_SESSION['id'] = $result['id'];
                $success = "User logged in successfully";
                redirect("/");
            } else {
                $passwordErr = "Incorrect Password";
            }
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
    <title>Login Page</title>
</head>

<body>
    <div id="login" class="form-container">
        <h2>Login</h2>
        <form class="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <p class="err"><?php echo $generalErr ?></p>
            <div class="form-group">
                <label for="login-email">Email</label>
                <p class="err"><?php echo $emailErr ?></p>
                <input type="email" id="login-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password</label>
                <p class="err"><?php echo $passwordErr  ?></p>
                <input type="password" id="login-password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>


</body>

</html>