<?php include "./header.php" ?>
<?php
if (isset($_SESSION['email']) && isset($_SESSION['id'])) {
    header("Location: http://localhost:3000");
    exit();
};
$username = $password = $email = $role = "";
$usernameError = $passwordError = $emailError = $roleError = "";
$registerSuccess = "";
$registerErr = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['username'])) {
        $usernameError = "Uername is required";
    }
    if (empty($_POST['email'])) {
        $emailError = "Email is required";
    }
    if (empty($_POST['password'])) {
        $passwordError = "Password is required";
    }
    if (empty($_POST['role'])) {
        $roleError = "Role is required";
    }
    if (empty($usernameError) && empty($passwordError) && empty($emailError) && empty($roleError)) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (username,email,password,role) VALUES ('$username','$email','$hashPassword','$role')";
        if (mysqli_query($conn, $sql)) {
            $registerSuccess = "User registered successfully";
            sleep(2);
            header("Location: http://localhost:3000");
            exit();
        } else {
            $registerErr = "Something went wrong";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
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

        .form {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80vh;
        }
    </style>
</head>

<body>
    <div class="form">

        <div class="form-container">
            <form class="register-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <p class="err"><?= $registerErr; ?></p>
                <p class="success"><?= $registerSuccess; ?></p>
                <h2>Register</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>
    </div>

</body>

</html>