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
    <div class="center"> <!-- invisible, just to center both containers -->
        <div class="sidebar">
            <div class="sidebar-top"> <!-- top part ng sidebar ksi may space ung top and bottom -->
                <div class="lofit">
                    <div class="lofit-logo"></div><p class="lofit-txt">Lofit</p>
                </div>
                <br>
                <div class="sidebar-btn">
                    <div class="icon tempicon"></div> <p>Home</p>
                    <!-- <img src="/assets/icons/home.jpg" alt="home">  -->
                    
                </div>
                <div class="sidebar-btn">
                    <div class="icon tempicon"></div> <p>Workout</p>
                    <!-- <img src="/assets/icons/home.jpg" alt="workout">  -->
                    
                </div>
                <div class="sidebar-btn">
                    <div class="icon tempicon"></div> <p>Goals</p>
                    <!-- <img src="/assets/icons/home.jpg" alt="goals">  -->
                    
                </div>
            </div>



            <div class="sidebar-bot"> <!-- bottom sidebar -->
                <div class="sidebar-btn">
                    <div class="icon tempicon"></div> <p>User</p>
                    <!-- <img src="/assets/icons/home.jpg" alt="user">  -->
                </div>

                <div class="sidebar-btn">
                    <div class="icon tempicon"></div> <p>Sign Out</p>
                    <!-- <img src="/assets/icons/home.jpg" alt="signout">  -->
                    
                </div>
            </div>
        </div>




        <div class="main-content">
                <div class="main-left">
                    <div class="main-heading">
                        <h2>Hello, User!</h2> <!-- INSERT PHP -->
                        <h1>Health Overview</h1>
                    </div>

                    <div class="main-container">
                        <h3>Quick log</h3>
                        <div class="quicklog">
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
                        </div>
                        <h3>Recommended workouts</h3>
                        <div class="reco-workouts">
                            <div class="card">
                                <div>
                                    <h2>Workout</h2>
                                </div>
                                <img src="../assets/icons/excercise.jpg" alt="">
                            </div>
                            <div class="card">
                                <div>
                                    <h2>Workout</h2>
                                </div>
                                <img src="../assets/icons/excercise.jpg" alt="">
                            </div>
                            <div class="card">
                                <div>
                                    <h2>Workout</h2>
                                </div>
                                <img src="../assets/icons/excercise.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>



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
                        <br>
                        <br>
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


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
