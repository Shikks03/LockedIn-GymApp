<?php
require_once(__DIR__ . '/sqlConnection/database.php');
require_once(__DIR__ . '/includes/session.php');

// Check if already logged in
if (isLoggedIn()) {
    header('Location: pages/dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = 'Username and password are required';
    } else {
        try {
            // Find user by username or email
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $username]);  // Allow login via username or email
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                loginUser($user);
                header('Location: pages/dashboard.php');
                exit;
            } else {
                $error = 'Invalid username or password';
            }
        } catch (PDOException $e) {
            $error = 'Login failed: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" />
    <link rel="stylesheet" href="css/style.css">

    <title>Login</title>
</head>

<body>
    <div class="flex-child center">
        <div class="flex-row main-content padrad index">
            <div class="flex-child index-img"> &nbsp; </div>

            <div class="flex-child index-child">
                <div class="flex-col login">

                    <div>
                        <h1>Welcome back!</h1>
                        <p>Enter your log-in info</p>
                    </div>

                    <!-- Show error if login fails -->
                    <?php if (!empty($error)) : ?>
                        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
                    <?php endif; ?>

                    <!--  Login Form -->
                    <form method="POST">
                        <div class="flex-row">
                            <p>User: </p>
                            <input type="text" class="txt-input" name="username" required>
                        </div>
                        <div class="flex-row">
                            <p>Password: </p>
                            <input type="password" class="txt-input" name="password" required>
                        </div>
                        <br>
                        <input type="submit" class="log" id="login-btn" value="Login">
                    </form>

                    <!--  Signup Link -->
                    <p>New here? <a href="pages/signup.php">Sign up!</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
