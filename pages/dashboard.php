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
    <div class="center"> <!-- invisible, just to center both containers -->
        <div class="sidebar">
            <div class="sidebar-top"> <!-- top part ng sidebar ksi may space ung top and bottom -->
                <div class="sidebar-lofit">
                    *insert image here*
                </div>
                <br><br>
                <div class="sidebar-home">
                    <img src="assets/icons/home.jpg" alt="home"> <p>Home</p>
                </div>
                <div class="sidebar-workout">
                    <img src="assets/icons/home.jpg" alt="workout"> <p>Workout</p>
                </div>
                <div class="sidebar-goals">
                    <img src="assets/icons/home.jpg" alt="goals"> <p>Goals</p>
                </div>
            </div>



            <div class="sidebar-bot"> <!-- bottom sidebar -->
                <div class="sidebar-user">
                    <img src="assets/icons/home.jpg" alt="user"> <p>User</p>
                </div>
                <div class="sidebar-signout">
                    <img src="assets/icons/home.jpg" alt="signout"> <p>Sign Out</p>
                </div>
            </div>
        </div>




        <div class="main-content">
            <div class="main-margins">
                <div class="main-left">
                    <div class="main-left-container1">
                        <h2>Hello, User!</h2> <!-- INSERT PHP -->
                        <h1>Health Overview</h1>
                    </div>

                    <div class="main-left-container2">
                        <h3>Quick log</h3>
                        <div class="quicklog">
                            <div class="card">
                                <p>Update</p><!-- INSERT PHP -->
                                <p><input type="text" class="txt-input" placeholder="some php shi"></p>
                                <input type="submit" class="log">
                            </div>
                        </div>
                        <h3>Recommended workouts</h3>
                        <div class="reco-workouts">
                            <div class="card">
                                <div class="card">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>




                <div class="main-right">
                    <div class="main-right-container">
                        <div class="card">
                            <img src="" alt=""><h2>User</h2>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>