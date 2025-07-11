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
                <button type="button" class="sidebar-btn"><div class="icon tempicon"></div> <p>Settings</p></button>
                <button type="button" class="sidebar-btn"><div class="icon tempicon"></div> <p>Sign Out</p></button>
            </div>
        </div>



        <!-- MAIN CONTENT -->
        <div class="flex-row flex-child padrad main-content">
                <!-- LEFT COLUMN -->
                <div class="flex-col main-left">
                    <div class="main-heading">
                        <h2>Hello, User!</h2> <!-- INSERT PHP -->
                        <h1>Health Overview</h1>
                    </div>

                    <div class="main-container">
                        <h3>Quick log</h3>
                        <div class="flex-row center-align quicklog">
                            <div class="card">
                                <p>Update</p><!-- INSERT PHP -->
                                <p><input type="text" class="txt-input" placeholder="some php shi"></p>
                                <input type="submit" class="log">
                            </div>
                            <div class="card">
                                <p>Update</p><!-- INSERT PHP -->
                                <p><input type="text" class="txt-input" placeholder="some php shi"></p>
                                <input type="submit" class="log">
                            </div>
                            <div class="card">
                                <p>Update</p><!-- INSERT PHP -->
                                <p><input type="text" class="txt-input" placeholder="some php shi"></p>
                                <input type="submit" class="log">
                            </div>
                            <!-- ADD MORE LOGS HERE, DIRECTLY PROPORTIONAL TO AMT OF GOALS -->
                        </div>

                        <h3>Recommended workouts</h3>
                        <div class="flex-row padrad reco-workouts">
                            <div class="card">
                                <div><h2>Workout</h2></div>
                                <img src="../assets/icons/excercise.jpg" alt="">
                            </div>
                            <div class="card">
                                <div><h2>Workout</h2></div>
                                <img src="../assets/icons/excercise.jpg" alt="">
                            </div>
                            <div class="card">
                                <div><h2>Workout</h2></div>
                                <img src="../assets/icons/excercise.jpg" alt="">
                            </div>
                            <!-- ADD MORE WORKOUT HERE -->
                        </div>
                    </div>
                </div>


                <!-- RIGHT COLUMN -->
                <div class="main-right">
                    <div class="main-container">
                        <div class="card">
                            <div class="inline">
                                <div class="icon icon-user"></div>
                                <div>
                                    <h2>User</h2>
                                    <h3>Lvl 1</h3> <!-- INSERT PHP FOR LVL -->
                                </div>
                            </div>
                        </div>

                        <br><br>
                        
                        <h3>Goals</h3>
                        <div class="card">
                            <div class="goals">
                                <div>
                                    <p><strong>Weight</strong></p>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 60%;"></div>
                                    </div>
                                    <div>
                                        <p>From</p>
                                        <p>To</p>
                                    </div>
                                </div>
                            <!-- ADD MORE GOALS HERE -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
