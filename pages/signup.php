<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {
        // Store values in session to be used in page 2
        $_SESSION['reg_username'] = $username;
        $_SESSION['reg_email'] = $email;
        $_SESSION['reg_password'] = $password;

        // Redirect to calculator page (page 2)
        header("Location: calculator.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1, width=device-width">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" />
  <link rel="stylesheet" href="../css/style.css">
  <title>Register</title>
</head>
<body>
  <div class="flex-child center">
    <div class="flex-row main-content padrad index">
      <div class="flex-child index-img"> &nbsp; </div>
      <div class="flex-child index-child">
        <div class="flex-col login">
          <div>
            <h1>Welcome!</h1>
            <p>Enter your details to sign up</p>
          </div>

          <!-- Registration Form -->
          <form method="POST" action="">
            <div class="flex-row">
              <p>Username: </p>
              <input type="text" class="txt-input" name="username" required>
            </div>
            <div class="flex-row">
              <p>Email: </p>
              <input type="email" class="txt-input" name="email" required>
            </div>
            <div class="flex-row">
              <p>Password: </p>
              <input type="password" class="txt-input" name="password" required>
            </div>
            <div class="flex-row">
              <p>Confirm Password: </p>
              <input type="password" class="txt-input" name="confirm" required>
            </div>
            <br>
            <input type="submit" class="log" value="Next">
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
