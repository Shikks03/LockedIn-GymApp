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
        <div class="flex-row main-content center-align padrad index">
            <div class="flex-col signup ">
                <div>
                    <h1>Are you ready to lock in?</h1>
                    <p>Enter only a few more details so we can help you to your goals!</p>
                </div>
                <div class="signup-child">
                    <div class="flex-row">
                        <div><p>Age: </p><input type="text" class="txt-input smol"></div>
                        <div><p>Sex: </p><select name="sex" class="txt-input"><option value="female">Female</option><option value="male">Male</option></select></div>
                        <div><p>Weight: </p><input type="text" class="txt-input smol"></div>
                        <div><p>Height: </p><input type="text" class="txt-input smol"></div>
                    </div>
                    <div >
                        <p>My primary goal is:</p>
                        <select name="goal" class="txt-input full">
                            <option value="losefat">Lose fat</option>
                            <option value="muscle">Build muscle</option>
                            <option value="maintain">Maintain</option>
                        </select>
                    </div>
                    <div class="flex-row">
                        <div>
                            <p>Carbohydrates preference:</p>
                            <select name="cabs" class="txt-input full">
                                <option value="highercarbs">Higher Carbs, Lower Fats</option>
                                <option value="lowercarbs">Lower Carbs, Higher Fats</option>
                            </select>
                        </div>
                        <div>
                            <p>Resistance Training?</p>
                            <select name="resistance" class="txt-input smol"><option value="yes">Yes</option><option value="no">No</option></select>
                        </div>
                        <div><p>Ideal Weight:</p><input type="text" class="txt-input smol"></div>

                    </div>
                    <div>
                        <p>Activity:</p>
                        <select name="activity" class="txt-input full">
                            <option value="sednoact">Sedentary, no activity</option>
                            <option value="sed2">Sedentary, 2-3 times a week training</option>
                            <option value="sed4">Sedentary, 4-6 times a week training</option>
                            <option value="active">Active, 2-6 times a week training</option>
                        </select>
                    </div>
        
                    <br>
                    <button onclick="document.location='calculator.php'" class="log" id="login-btn">Lock in</button>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
