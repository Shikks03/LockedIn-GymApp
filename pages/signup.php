<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
  	<meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" />
    <link rel="stylesheet" href="../css/style.css">

    <title>Dashboard</title>
</head>
<body>
    <div class="flex-child center">
        <div class="flex-row main-content padrad index">
            <div class="flex-child index-img"> &nbsp </div>
            <div class="flex-child index-child">
                <div class="flex-col login">
                    <div>
                        <h1>Welcome!</h1>
                        <p>Enter your details</p>
                    </div>
                    
                    <div>
                        <div class="flex-row"><p>Username: </p><input type="text" class="txt-input"></div>
                        <div class="flex-row"><p>Password: </p><input type="text" class="txt-input"></div>
                        <div class="flex-row"><p>Confirm password: </p><input type="text" class="txt-input"></div>
                        <br>
                        <button onclick="document.location='calculator.php'" class="log" id="login-btn">Sign up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
