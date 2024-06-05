<?php include "./header.php" ?>
<?php
if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    header("Location: http://localhost:3000");
    exit();
};
$password = $email = "";
$passwordError = $emailError  = "";
$loginSuccess = "";
$loginErr = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['email'])) {
        $emailError = "Email is required";
    }
    if (empty($_POST['password'])) {
        $passwordError = "Password is required";
    }
    if (empty($passwordError) && empty($emailError)) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $getUserSql = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($conn, $getUserSql);
        $result = mysqli_fetch_array($result);
        if (empty($result)) {
            $loginErr = "Incorrect Credentials";
        } else {
            if (password_verify($password, $result['password'])) {
                $loginSuccess = "User logged in successfully";
                $_SESSION['email'] = $email;;
                $_SESSION['id'] = $result['id'];
                $_SESSION['role'] = $result['role'];
                sleep(2);
                header("Location: http://localhost:3000");
                exit();
            } else {
                $loginErr = "Incorrect Password";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80vh;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .register-form {
            display: flex;
            flex-direction: column;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="form">
        <div class="form-container">
            <form class="register-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <p class="err"><?= $loginErr; ?></p>
                <p class="success"><?= $loginSuccess; ?></p>
                <h2>Login</h2>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
    </div>
</body>

</html>