<?php
require_once(__DIR__ . '/../includes/session.php');
requireLogin();
$user = getCurrentUser(); //gets current user
?>

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
    <div class="flex-row flex-child center">
        <!-- SIDEBAR -->
        <div class="flex-col flex-child center-align padrad sidebar">

            <div class="flex-col sidebar-top">
                <div class="center-align lofit">
                    <div class="lofit-logo"></div>
                    <p class="lofit-txt">Lofit</p>
                </div>
                    <button onclick="document.location='../index.php'" class="sidebar-btn" id="home-btn"><div class="icon tempicon"></div> <p>Home</p></button>
                    <button onclick="document.location='../pages/workout.php'" class="sidebar-btn" id="workout-btn"><div class="icon tempicon"></div> <p>Workout</p></button>
                    <button onclick="document.location='../pages/goals.php'" class="sidebar-btn" id="goals-btn"><div class="icon tempicon"></div> <p>Goals</p></button>
            </div>

            <div class="flex-col sidebar-bot">
                <button type="button" class="flex-row sidebar-btn"><div class="icon tempicon"></div> <p>User</p></button>
                <button onclick="document.location='../php/logout.php'" class="sidebar-btn"><div class="icon tempicon"></div> <p>Sign Out</p></button>
            </div>
        </div>



        <!-- MAIN CONTENT -->
        <div class="flex-row flex-child padrad main-content">
                <!-- LEFT COLUMN -->
                <div class="flex-col main-left">
                    <div class="main-heading">
                        <h2>Hello, <?php echo htmlspecialchars($user['username']); ?>!</h2> <!-- INSERT PHP -->
                        <h1>Health Overview</h1>
                    </div>

                    <div class="main-container">
                        <h3>Quick log</h3>
                        <div class="flex-row center-align quicklog">
                            <?php include('../php/quickLogCards.php'); ?>
                            <!-- ADD MORE LOGS HERE, DIRECTLY PROPORTIONAL TO AMT OF GOALS -->
                        </div>

                        <h3>Recommended workouts</h3>
                        <div class="flex-row padrad reco-workouts">
                            <?php include('../php/recommendedWorkouts.php'); ?>
                        </div>
                    </div>
                </div>


                <!-- RIGHT COLUMN -->
                <div class="flex-child main-right">
                    <div class="flex-col flex-child main-container">
                        <div class="card user" >
                            <div class="inline">
                                <div class="icon icon-user"></div>
                                <div>
                                    <h2><?php echo htmlspecialchars($user['username']); ?></h2>
                                    <!-- pakiindent to the left side ung h2 and h3 kasi i think nasa right side sila nakaindent
                                    or sa middle since pag 2 digits na ung level, nagmomove ung h2 sa right side. -->
                                    <h3>Lvl <?php include('../php/levelCompute.php')?></h3>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h3>Goals</h3>
                        <div class="card goal">
                            <div class="goals">
                                <?php include('../php/goalTracker.php'); ?>
                            </div>
                        </div>

                        <h3>Quick add</h3>
                        <div class="card quick-add">
                            <div class="flex-child flex-col">
                                <form id="quickAddForm">
                                    <div class="center-align">
                                        <p>Goal name:</p>
                                        <input type="text" class="txt-input" name="goalName" id="goalName" size="20">
                                    </div>
                                    <div class="flex-row center-align">
                                        <div>
                                            <p>From: </p>
                                            <input type="text" class="txt-input" name="fromValue" id="fromValue" size="2">
                                        </div>
                                        <div>
                                            <p>To: </p>
                                            <input type="text" class="txt-input" name="toValue" id="toValue" size="2">
                                        </div>
                                    </div>
                                    <button type="submit" class="log" id="addgoal">Add Goal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.getElementById('quickAddForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('../php/quickAdd.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Show response from PHP
            location.reload(); // Clear the form

            // Fetch updated quick log cards
            fetch('../php/quickLogCards.php')
                .then(response => response.text())
                .then(cards => {
                    document.querySelector('.quicklog').innerHTML = cards;
                });
        });
    });
    </script>
</body>
</html>
