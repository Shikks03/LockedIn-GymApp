<?php
    // Load the PHP file responsible for retrieving and grouping workout card data
    include_once '../php/workoutCards.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Page metadata and responsiveness -->
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">

    <!-- External fonts and custom styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" />
    <link rel="stylesheet" href="../css/style.css">

    <!-- Title displayed on browser tab -->
    <title>Workout Dashboard - Lofit</title>
</head>
<body>

    <div class="flex-row flex-child center">

        <!-- ========== SIDEBAR SECTION ========== -->
        <div class="flex-col flex-child center-align padrad sidebar">

            <!-- Sidebar Top: Logo and Navigation Buttons -->
            <div class="flex-col sidebar-top">
                <div class="center-align lofit">
                    <div class="lofit-logo"></div>
                    <p class="lofit-txt">Lofit</p>
                </div>

                <!-- Navigation Buttons -->
                <button onclick="document.location='../index.php'" class="sidebar-btn">
                    <div class="icon tempicon"></div> <p>Home</p>
                </button>
                <button onclick="document.location='../pages/workout.php'" class="sidebar-btn active" id="workout-btn">
                    <div class="icon tempicon"></div> <p>Workout</p>
                </button>
                <button onclick="document.location='../pages/goals.php'" class="sidebar-btn" id="goals-btn">
                    <div class="icon tempicon"></div> <p>Goals</p>
                </button>
            </div>

            <!-- Sidebar Bottom: User and Logout -->
            <div class="flex-col sidebar-bot">
                <button type="button" class="sidebar-btn" onclick="document.location='../pages/settings.php'">
                    <div class="icon tempicon"></div> <p>User</p>
                </button>
                <button type="button" class="sidebar-btn" onclick="confirmSignOut()">
                    <div class="icon tempicon"></div> <p>Sign Out</p>
                </button>
            </div>
        </div>

        <!-- ========== MAIN CONTENT AREA ========== -->
        <div class="flex-col flex-child padrad main-content">

            <!-- Page Heading and Filters -->
            <div class="main-heading">
                <h1>Workouts</h1>

                <!-- Search input and category filter -->
                <div class="search-filter-container">
                    <input type="text" id="workoutSearch" placeholder="Search workouts..." onkeyup="searchWorkouts()">
                    <select id="categoryFilter" onchange="filterByCategory()">
                        <option value="">All Categories</option>
                        <!-- Dynamically populate filter options based on available categories -->
                        <?php foreach(array_keys($groupedWorks) as $category): ?>
                            <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="main-container">
                <div class="content-wrapper">

                    <!-- ========== LEFT COLUMN: Workout Cards ========== -->
                    <div class="main-left">
                        <div class="section-header">
                            <h3>Recommended Workouts</h3>
                        </div>

                        <div class="workouts-container">
                            <?php
                                // Loop through each workout category and render its section
                                foreach ($groupedWorks as $category => $group) {
                                    echo "<div class='category-section' data-category='{$category}'>";
                                    echo "<h2 class='category-title'>{$category}</h2>";
                                    
                                    // Container for horizontal scroll of workout cards
                                    echo "<div class='workout-row-container'>";
                                    echo "<div class='workout-row'>";
                                    
                                    // Render each workout card using its DisplayWorkout method
                                    foreach ($group as $workout) {
                                        $workout->DisplayWorkout();
                                    }

                                    echo "</div>"; // .workout-row
                                    echo "</div>"; // .workout-row-container
                                    echo "</div>"; // .category-section
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========== RIGHT SIDEBAR: Workout Details Panel ========== -->
            <div class="right-sidebar">
                <div class="main-right">
                    <div id="workoutDetailsPanel" class="workout-details-panel">
                        <!-- Default message when no workout is selected -->
                        <div class="default-message">
                            <div class="default-icon"></div>
                            <h3>Select a Workout</h3>
                            <p>Click on any workout card to view detailed instructions and start your exercise routine.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ========== JAVASCRIPT SECTION ========== -->
    <script>
        // Serialized workout data made available to JavaScript
        const workoutData = <?php echo json_encode($workouts); ?>;

        /**
         * Display detailed view of selected workout in the right panel
         * @param {number} workoutId - ID of the selected workout
         */
        function viewWorkoutDetails(workoutId) {
            const workout = workoutData.find(w => w.id == workoutId);
            if (!workout) return;

            // Clear previous highlights
            document.querySelectorAll('.workout-card').forEach(card => {
                card.classList.remove('active-card');
            });

            // Highlight selected workout
            document.querySelector(`[data-workout-id="${workoutId}"]`).classList.add('active-card');

            // Render workout detail panel
            const detailsPanel = document.getElementById('workoutDetailsPanel');
            detailsPanel.innerHTML = `
                <div class="workout-detail-content">
                    <div class="workout-detail-header">
                        <img src="${workout.image}" alt="${workout.name}" class="workout-detail-image">
                        <div class="workout-detail-info">
                            <h2 class="workout-detail-title">${workout.name}</h2>
                            <div class="workout-detail-meta">
                                <span class="workout-category-badge">${workout.category}</span>
                                <span class="workout-duration-badge">15-20 min</span>
                            </div>
                        </div>
                    </div>

                    <div class="workout-muscles-section">
                        <h4>Target Muscles</h4>
                        <div class="muscle-tags-detail">
                            ${workout.targetMuscle.map(muscle => `<span class="muscle-tag-detail">${muscle}</span>`).join('')}
                        </div>
                    </div>

                    <div class="workout-instructions-section">
                        <h4>Instructions</h4>
                        <ol class="workout-steps-detail">
                            ${workout.steps.map(step => `<li>${step}</li>`).join('')}
                        </ol>
                    </div>

                    <div class="workout-actions">
                        <button class="btn-start-workout" onclick="startWorkout(${workoutId})">
                            <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="5,3 19,12 5,21"></polygon>
                            </svg>
                            Start Workout
                        </button>
                    </div>
                </div>
            `;
        }

        /**
         * Placeholder for starting a workout routine
         * @param {number} workoutId - ID of workout to start
         */
        function startWorkout(workoutId) {
            alert('Starting workout! This would integrate with your workout tracking system.');
        }

        /**
         * Filter workouts in real-time based on search input
         */
        function searchWorkouts() {
            const searchTerm = document.getElementById('workoutSearch').value.toLowerCase();
            const workoutCards = document.querySelectorAll('.workout-card');

            workoutCards.forEach(card => {
                const workoutName = card.querySelector('.workout-title').textContent.toLowerCase();
                const targetMuscles = card.querySelector('.muscle-tags-container').textContent.toLowerCase();

                // Show/hide based on matching text
                if (workoutName.includes(searchTerm) || targetMuscles.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        /**
         * Filter workout categories shown based on dropdown selection
         */
        function filterByCategory() {
            const selectedCategory = document.getElementById('categoryFilter').value;
            const categorySections = document.querySelectorAll('.category-section');

            categorySections.forEach(section => {
                if (selectedCategory === '' || section.dataset.category === selectedCategory) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        }

        /**
         * Confirm sign-out and redirect if confirmed
         */
        function confirmSignOut() {
            if (confirm('Are you sure you want to sign out?')) {
                document.location = '../php/logout.php';
            }
        }

        /**
         * Highlight the current page in sidebar on load
         */
        document.addEventListener('DOMContentLoaded', function() {
            const workoutBtn = document.getElementById('workout-btn');
            if (workoutBtn) {
                workoutBtn.classList.add('active');
            }
        });
    </script>

    <style>
        /* ===========================
        Main Container Styling
        =========================== */
        .main-content .main-container {
            background: linear-gradient(180deg, #e6e9f1, #cad4df) !important; /* Soft gradient background */
            border-radius: 2vw !important; /* Rounded corners responsive to viewport */
            padding: 2em 2em 2em 2em !important; /* General padding */
            padding-top: 1.2em !important; /* Slightly smaller top padding */
            height: 100% !important; /* Full height occupation */
            display: flex !important; /* Flex layout for children */
            flex-direction: column !important; /* Stack children vertically */
            overflow: hidden !important; /* Prevent scrollbars from appearing */
        }

        /* ===========================
        Section Header
        =========================== */
        .section-header {
            position: sticky; /* Remains visible when scrolling */
            top: 0;
            z-index: 100; /* Positioned above other elements */
            background: rgba(255, 255, 255, 0.1); /* Transparent background */
            backdrop-filter: blur(10px); /* Glassmorphism effect */
            -webkit-backdrop-filter: blur(10px); /* Safari support */
            width: 900px;
            padding: 1rem 1.5rem;
            border-radius: 1rem;
            margin-bottom: 1.5rem;
            color: #f0f0f0;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15); /* Drop shadow */
            border: 1px solid rgba(255, 255, 255, 0.2); /* Border for contrast */
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease-in-out;
        }

        /* Decorative icon or visual content inside section header */
        .section-header::before {
            font-size: 1.5rem;
            line-height: 1;
            opacity: 0.8;
        }

        /* Section title text */
        .section-header h3 {
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: 0.4px;
            color: #ffffff;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25); /* Adds text clarity */
        }

        /* ===========================
        Layout Fixes for Specific DOM Nodes (Selectors for Nested Containers)
        =========================== */
        html > body:nth-child(2) > div:nth-child(1) > div:nth-child(2) > div:nth-child(2) > div:nth-child(1),
        html > body:nth-child(2) > div:nth-child(1) > div:nth-child(2) > div:nth-child(2),
        html > body:nth-child(2) > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(2),
        html > body:nth-child(2) > div:nth-child(1) > div:nth-child(2) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) {
            width: 970px;
            max-width: 975px; /* Applied based on hierarchy, to limit container size */
        }

        /* ===========================
        Right Sidebar Styles
        =========================== */
        .right-sidebar {
            position: absolute;
            right: 0;
            top: 70px;
            width: 250px;
        }

        /* ===========================
        Right Side Nav Container (used for workout details sidebar)
        =========================== */
        html > body:nth-child(2) > div:nth-child(1) > div:nth-child(2) > div:nth-child(3) {
            width: 400px;
            max-width: 400px;
            margin-right: 25px;
            height: 800px;
            max-height: 800px;
        }

        /* ===========================
        Workout Details Panel + Adjustments
        =========================== */
        #workoutDetailsPanel {
            padding-right: 400px;
            height: 1000px;
            max-height: 1000px;
        }

        /* Internal content of workout details */
        #workoutDetailsPanel > div:nth-child(1) {
            width: 350px;
            max-width: 350px;
            height: 800px;
            max-height: 800px;
        }

        /* Adjusted layout for nested workout detail block */
        html > body:nth-child(2) > div:nth-child(1) > div:nth-child(2) > div:nth-child(3) > div:nth-child(1) {
            width: 400px;
            max-width: 400px;
            height: 840px;
            max-height: 840px;
            margin-left: -15px;
        }

        /* ===========================
        Search Filter Styling
        =========================== */
        .search-filter-container {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1rem 1.25rem;
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.15); /* Light transparent background */
            border-radius: 1.25rem;
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            align-items: center;
        }

        /* Responsive width tweak */
        .center .padrad .main-heading .search-filter-container {
            width: 72% !important;
        }

        /* Input and Select (Dropdown) Styling */
        .search-filter-container input,
        .search-filter-container select {
            padding: 0.65rem 1rem;
            border: none;
            border-radius: 0.8rem;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.3); /* Semi-transparent fields */
            color: #2c3e50;
            backdrop-filter: blur(8px);
            box-shadow: inset 0 1px 3px rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        /* Field focus states */
        .search-filter-container input:focus,
        .search-filter-container select:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.6);
            background: rgba(255, 255, 255, 0.5);
        }

        /* Specific search input field */
        #workoutSearch {
            width: 800px;
            max-width: 800px;
        }

        /* ===========================
        Content and Layout Panels
        =========================== */
        .content-wrapper {
            display: flex !important;
            gap: 2em !important;
            height: 100% !important;
            flex: 1 !important;
            overflow: hidden !important;
        }

        .main-left {
            flex: 1 !important;
            overflow-y: auto !important;
            min-height: 0 !important;
        }

        /* Right column for workout details */
        .main-right {
            width: 450px !important;
            flex-shrink: 0 !important;
            height: 100% !important;
            overflow: hidden !important;
        }

        /* Workout details panel layout and design */
        .workout-details-panel {
            background: #ffffff;
            border-radius: 20px;
            height: 100%;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* ===========================
        Default state when no workout is selected
        =========================== */
        .default-message {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            text-align: center;
            padding: 2rem;
            color: #7f8c8d; /* Muted text colour */
        }

        /* Icon displayed in default message */
        .default-icon {
            display: inline-block;
            width: 64px;
            height: 64px;
            background-image: url('../assets/icons/tredmill.png'); /* Icon path */
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Default message heading */
        .default-message h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }

        /* Default message paragraph */
        .default-message p {
            font-size: 1rem;
            line-height: 1.5;
            max-width: 280px;
        }

        /* ===========================
        Workout Detail Content Area
        =========================== */
        .workout-detail-content {
            padding: 24px;
            height: 100%;
            overflow-y: auto; /* Scroll when content exceeds height */
            display: flex;
            flex-direction: column;
        }

        /* Header section inside detail panel */
        .workout-detail-header {
            margin-bottom: 24px;
        }

        /* Image of the workout in detail view */
        .workout-detail-image {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 16px;
            margin-bottom: 16px;
        }

        /* Workout title in detail view */
        .workout-detail-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 12px 0;
            line-height: 1.3;
        }

        /* Meta container for category and duration */
        .workout-detail-meta {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        /* Category badge (blue gradient) */
        .workout-category-badge {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Duration badge (light grey) */
        .workout-duration-badge {
            background: #ecf0f1;
            color: #7f8c8d;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* ===========================
        Muscle Tags Section
        =========================== */
        .workout-muscles-section {
            margin-bottom: 24px;
        }

        .workout-muscles-section h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0 0 12px 0;
        }

        .muscle-tags-detail {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        /* Individual muscle tag style */
        .muscle-tag-detail {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: capitalize;
            letter-spacing: 0.3px;
        }

        /* ===========================
        Instructions / Steps Section
        =========================== */
        .workout-instructions-section {
            margin-bottom: 24px;
            flex-grow: 1; /* Expand to fill available vertical space */
        }

        .workout-instructions-section h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0 0 12px 0;
        }

        /* Step list for instructions */
        .workout-steps-detail {
            margin: 0;
            padding-left: 20px;
            list-style: none;
            counter-reset: step-counter;
        }

        /* Individual step item */
        .workout-steps-detail li {
            counter-increment: step-counter;
            margin-bottom: 12px;
            padding-left: 12px;
            position: relative;
            line-height: 1.4;
            font-size: 0.9rem;
            color: #4a5568;
        }

        /* Step number in a circle */
        .workout-steps-detail li::before {
            content: counter(step-counter);
            position: absolute;
            left: -28px;
            top: 0;
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
        }

        /* ===========================
        Start Workout Button & Footer Actions
        =========================== */
        .workout-actions {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid #ecf0f1;
        }

        /* Call-to-action button */
        .btn-start-workout {
            width: 100%;
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
            color: white;
            border: none;
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
        }

        .btn-start-workout:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(39, 174, 96, 0.4);
        }

        /* Optional icon inside button */
        .btn-icon {
            width: 16px;
            height: 16px;
        }

        /* ===========================
        Active Card Styling
        =========================== */
        .workout-card.active-card .card-modern {
            transform: scale(0.98); /* Slight zoom-in effect */
            box-shadow: 0 8px 32px rgba(52, 152, 219, 0.3); /* Emphasised blue glow */
            border: 2px solid #3498db;
        }

        /* ===========================
        Workouts Container
        =========================== */
        .main-content .workouts-container {
            width: 100% !important;
            padding: 20px 0 !important;
            background: none !important;
            border-radius: 0 !important;
            height: auto !important;
        }

        /* Section title styling */
        .main-content .main-container h3,
        .main-content .category-title {
            color: #2c3e50 !important;
            font-size: 1.5rem !important;
            font-weight: 600 !important;
            margin-bottom: 20px !important;
            line-height: 1.2 !important;
        }

        .main-content .category-section {
            margin-bottom: 40px !important;
        }

        .main-content .category-title {
            padding-left: 10px !important;
        }

        /* ===========================
        Horizontal Scrollable Workout Row
        =========================== */
        .main-content .workout-row-container {
            position: relative !important;
            overflow: hidden !important;
            padding: 10px 0 !important;
        }

        /* Flex row with scroll */
        .main-content .workout-row {
            display: flex !important;
            gap: 20px !important;
            overflow-x: auto !important;
            padding: 10px !important;
            scroll-behavior: smooth !important;
            -webkit-overflow-scrolling: touch !important;
            scrollbar-width: none !important;
        }

        .main-content .workout-row::-webkit-scrollbar {
            display: none !important;
        }

        /* ===========================
        Modern Workout Card Design
        =========================== */
        .workout-card {
            min-width: 280px;
            max-width: 280px;
            cursor: pointer;
            flex-shrink: 0;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .workout-card:hover {
            transform: translateY(-8px);
        }

        /* Card container style */
        .card-modern {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            height: 340px;
            display: flex;
            flex-direction: column;
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .workout-card:hover .card-modern {
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.12);
        }

        /* Workout Image Handling */
        .card-image-container {
            position: relative;
            height: 180px;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center center;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: block;
            background-color: #f8f9fa;
        }

        .workout-card:hover .card-image {
            transform: scale(1.08);
        }

        /* Overlay Gradient on Hover */
        .card-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(45deg, rgba(52, 152, 219, 0.8), rgba(155, 89, 182, 0.8));
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 20px;
        }

        .workout-card:hover .card-overlay {
            opacity: 1;
        }

        /* Category badge inside overlay */
        .card-category {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .workout-card:hover .card-category {
            transform: translateY(0);
        }

        /* Card Content Area */
        .card-content-modern {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Workout title inside card */
        .workout-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 12px 0;
            line-height: 1.3;
            min-height: 2.6rem;
            display: flex;
            align-items: center;
        }

        /* Tags for muscle groups */
        .muscle-tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 20px;
        }

        .muscle-tag {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: capitalize;
            letter-spacing: 0.3px;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }

        .muscle-tag:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        /* Card Footer: Duration and Action */
        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .workout-duration {
            font-size: 0.85rem;
            color: #7f8c8d;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        /* Action Button inside card */
        .card-action {
            width: 44px;
            height: 44px;
            background: rgba(0, 0, 139, 0.24);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(8px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .workout-card:hover .card-action {
            transform: scale(1.08);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            background: rgba(0, 0, 139, 0.48);
        }

        /* Play Icon inside action button */
        .action-icon {
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-left: 16px solid white;
            transition: transform 0.2s ease;
        }

        .card-action:hover .action-icon {
            transform: rotate(10deg) scale(1.05);
        }

        /* ===========================
        Modal & Utility Styles
        =========================== */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border-radius: 1rem;
            width: 80%;
            max-width: 600px;
            position: relative;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        /* Reuse workout image inside modal */
        .workout-detail-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .workout-steps {
            margin: 1rem 0;
            padding-left: 1.5rem;
        }

        .workout-steps li {
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        /* Primary button */
        .btn-primary {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 1rem;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        /* ===========================
        Statistics Panel
        =========================== */
        .stats {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        .stat-value {
            font-weight: 600;
            color: #2c3e50;
        }

        /* ===========================
        Sidebar Button (Active State)
        =========================== */
        .sidebar-btn.active {
            background-color: #08102b54;
            color: white;
        }

        /* ===========================
        Responsive Design
        =========================== */
        @media (max-width: 768px) {
            .content-wrapper {
                flex-direction: column !important;
            }

            .main-right {
                flex: none !important;
                width: 100% !important;
            }

            .search-filter-container {
                flex-direction: column;
            }

            .workout-card {
                min-width: 260px;
                max-width: 260px;
            }

            .card-modern {
                height: 320px;
            }

            .card-content-modern {
                padding: 20px;
            }
        }

    </style>
</body>
</html>
