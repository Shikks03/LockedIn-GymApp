<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
  	<meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" />
    <link rel="stylesheet" href="css/style.css">

    <title>Dashboard</title>
</head>
<body>
    <div class="flex-child center">
        <div class="flex-row main-content padrad index">
            <div class="flex-child index-img"> &nbsp </div>
            <div class="flex-child index-child">
                <div class="flex-col login">
                    <div>
                        <h1>Welcome back!</h1>
                        <p>subheading</p>
                    </div>
                    
                    <div>
                        <div class="flex-row"><p>User: </p><input type="text" class="txt-input"></div>
                        <div class="flex-row"><p>Password: </p><input type="text" class="txt-input"></div>
                        <br>
                        <button onclick="document.location='/pages/signup.php'" class="log" id="login-btn">Login</button>
                    </div>

                    

                    <p>New here? <a href="pages/signup.php">Sign up!</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
