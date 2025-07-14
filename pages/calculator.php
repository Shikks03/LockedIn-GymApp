<?php
session_start();
require_once(__DIR__ . '/../sqlConnection/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $age = $_POST['age'];
    $sex = $_POST['sex']; // Must be 'M' or 'F'
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $goal = $_POST['goal']; // Must be 'lose', 'maintain', or 'gain'
    $activity = $_POST['activity']; // Must be enum values
    $carbs = $_POST['carbs']; // Not stored in DB, optional
    $resistance = $_POST['resistance']; // Not stored in DB, optional
    $ideal_weight = $_POST['ideal_weight']; // Not stored in DB, optional

    // Retrieve session data from Page 1
    $username = $_SESSION['reg_username'] ?? null;
    $email = $_SESSION['reg_email'] ?? null;
    $password = $_SESSION['reg_password'] ?? null;

    if ($username && $email && $password) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO users 
                (username, email, password, age, sex, height, weight, activity_level, goal, level, xp) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 0)");

            $stmt->execute([
                $username,
                $email,
                $hashedPassword,
                $age,
                $sex,
                $height,
                $weight,
                $activity,
                $goal
            ]);
            
            //DELETE THIS KUNG AYAW NG INITIAL GOAL BASED SA IDEAL WEIGHT
            require_once(__DIR__ . '/../includes/session.php');

            // Get the ID of the user we just inserted
            $newUserId = $pdo->lastInsertId();

            try {
                $query = "INSERT INTO goals (user_id, goal_name, base, current, target, active) VALUES (?, ?, ?, ?, ?, ?);";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$newUserId, "Weight", $weight, $weight, $ideal_weight, 1]);
            } catch (PDOException $e) {
                die("Insertion Error! : " . $e->getMessage());
            }
            //DELETE UNTIL HERE
            
            // Clear session
            unset($_SESSION['reg_username'], $_SESSION['reg_email'], $_SESSION['reg_password']);

            // Redirect on success
            header("Location: ../index.php?registered=1");
            exit;

        } catch (PDOException $e) {
            echo "<script>alert('Database error: " . $e->getMessage() . "');</script>";
        }
    } else {
        echo "<script>alert('Session expired. Please register again.'); window.location.href = '../pages/signup.php';</script>";
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

    <title>Additional Info</title>
</head>

<body>


    <div class="flex-child center">
        <div class="flex-row main-content center-align padrad index">
            <div class="flex-col signup ">
                <div>
                    <h1>Are you ready to lock in?</h1>
                    <p>Enter only a few more details so we can help you to your goals!</p>
                </div>

                <form method="POST" class="signup-child">
                    <div class="flex-row">
                        <div>
                            <p>Age: </p><input type="number" name="age" class="txt-input smol" required>
                        </div>
                        <div>
                            <p>Sex: </p>
                            <select name="sex" class="txt-input" required>
                                <option value="F">Female</option>
                                <option value="M">Male</option>
                            </select>
                        </div>
                        <div>
                            <p>Weight: </p><input type="number" name="weight" class="txt-input smol" required>
                        </div>
                        <div>
                            <p>Height: </p><input type="number" name="height" class="txt-input smol" required>
                        </div>
                    </div>

                    <div>
                        <p>My primary goal is:</p>
                        <select name="goal" class="txt-input full" required>
                            <option value="lose">Lose weight</option>
                            <option value="gain">Gain muscle</option>
                            <option value="maintain">Maintain</option>
                        </select>
                    </div>

                    <div class="flex-row">
                        <div>
                            <p>Carbohydrates preference:</p>
                            <select name="carbs" class="txt-input full" required>
                                <option value="highercarbs">Higher Carbs, Lower Fats</option>
                                <option value="lowercarbs">Lower Carbs, Higher Fats</option>
                            </select>
                        </div>
                        <div>
                            <p>Resistance Training?</p>
                            <select name="resistance" class="txt-input smol" required>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div>
                            <p>Ideal Weight:</p><input type="number" name="ideal_weight" class="txt-input smol"
                                required>
                        </div>
                    </div>

                    <div>
                        <p>Activity:</p>
                        <select name="activity" class="txt-input full" required>
                            <option value="sedentary">Sedentary, no activity</option>
                            <option value="light">Light, 2-3 times a week training</option>
                            <option value="moderate">Moderate, 4-6 times a week training</option>
                            <option value="active">Active, daily training</option>
                        </select>
                    </div>

                    <br>
                    <input type="submit" value="Lock in" class="log" id="login-btn">
                </form>
            </div>
        </div>
    </div>
</body>

</html>