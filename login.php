<?php
session_start();
$host = 'localhost';
$db = 'project-4';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        // Registration logic
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $email = $_POST['email'];

        $stmt = $pdo->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)');
        if ($stmt->execute([$username, $password, $email])) {
            echo '<script>alert("User registered successfully");</script>';
        } else {
            echo '<script>alert("Error registering user");</script>';
        }
    } elseif (isset($_POST['login'])) {
        // Login logic
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            echo '<script>alert("Login successful");</script>';
        } else {
            echo '<script>alert("Invalid username or password");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="stylesheet" href="style.css">
    <script src="server.js"></script>
</head>
<style>
    #register-page {
        background-color: black;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100vh;
        padding: 20px;
    }

    .account {
        color: white;
        font-size: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .back {
        font-size: 30px;
    }

    .back a {
        color: white;
        text-decoration: none;
    }

    .register,
    .login {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
    }

    .register form,
    .login form {
        background-color: #333;
        padding: 20px;
        border-radius: 10px;
        color: white;
        width: 300px;
    }

    .register label,
    .login label {
        font-size: 20px;
        margin-top: 10px;
    }

    .register input,
    .login input {
        font-size: 20px;
        margin-top: 10px;
        margin-bottom: 20px;
        padding: 10px;
        width: 100%;
        box-sizing: border-box;
    }

    .register button,
    .login button {
        font-size: 20px;
        padding: 10px 20px;
        background-color: #555;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

<body id="register-page">
    <main>
        <div class="back">
            <a href="#" onclick="window.history.go(-1); return false;">
                < Go Back</a>
        </div>
        <div class="account">
            Register an Account
        </div>
        <div class="register">
            <form action="login.php" method="post">
                <h2>Register</h2>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <button type="submit" name="register">Register</button>
            </form>
        </div>
        <div class="account">
            Login to your Account
        </div>
        <div class="login">
            <form action="login.php" method="post">
                <h2>Login</h2>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </main>
</body>

</html>