<?php
    /**
     * --------------------------------------------------------------
     * Workout Module
     * --------------------------------------------------------------
     * Defines the Workout class and generates grouped workout data.
     * This module is intended to be included in frontend files like
     * workout.php to render workout cards dynamically.
     *
     * Author: Russel Rome Nadales
     * Date: July 14, 2025
     */

    // Avoid including workout.php inside this logic file to prevent recursive loading
    // require_once '../pages/workout.php'; // ❌ Remove this to avoid circular include

    /**
     * --------------------------------------------------------------
     * Workout Class
     * --------------------------------------------------------------
     * Represents a single workout entry with attributes and a method
     * to render its details as a stylised HTML card.
     */
    class Workout {
        // Workout attributes
        public $id;             // Unique ID for the workout
        public $name;           // Name/title of the workout
        public $category;       // Muscle group category
        public $steps;          // Step-by-step instructions
        public $targetMuscle;   // Targeted muscles (array)
        public $image;          // Optional image path or URL

        /**
         * Constructor to initialise the workout properties.
         *
         * @param int $id
         * @param string $name
         * @param string $category
         * @param array $steps
         * @param array $targetMuscle
         * @param string|null $image
         */
        public function __construct($id, $name, $category, $steps, $targetMuscle, $image = null) {
            $this->id = $id;
            $this->name = $name;
            $this->category = $category;
            $this->steps = $steps;
            $this->targetMuscle = $targetMuscle;

            // Handle image path (use default if not provided)
            if (!empty($image)) {
                // Ensure relative or absolute path is respected
                if (!preg_match('/^(\/|\.\.\/|https?:\/\/)/', $image)) {
                    $this->image = "../" . $image;
                } else {
                    $this->image = $image;
                }
            } else {
                // Fallback placeholder image
                $this->image = "https://via.placeholder.co/300x200/3498db/ffffff?text=Workout+Image";
            }
        }

        /**
         * Renders the workout card in HTML format with styling.
         */
        public function DisplayWorkout() {
            $muscleTags = '';
            foreach ($this->targetMuscle as $muscle) {
                $muscleTags .= "<span class='muscle-tag'>" . htmlspecialchars($muscle) . "</span>";
            }

            echo "
                <div class='workout-card' data-workout-id='{$this->id}' onclick='viewWorkoutDetails({$this->id})'>
                    <div class='card-modern'>
                        <div class='card-image-container'>
                            <img src='{$this->image}' alt='" . htmlspecialchars($this->name) . "' class='card-image' loading='lazy'
                            onerror=\"this.onerror=null;this.src='https://via.placeholder.co/300x200/3498db/ffffff?text=Workout+Image';\">
                            <div class='card-overlay'>
                                <div class='card-category'>{$this->category}</div>
                            </div>
                        </div>
                        <div class='card-content-modern'>
                            <h3 class='workout-title'>" . htmlspecialchars($this->name) . "</h3>
                            <div class='muscle-tags-container'>{$muscleTags}</div>
                            <div class='card-footer'>
                                <span class='workout-duration'>15-20 min</span>
                                <div class='card-action'>
                                    <svg class='action-icon' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2'>
                                        <path d='M9 18l6-6-6-6'/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ";
        }
    }

    /**
     * --------------------------------------------------------------
     * Predefined Workouts
     * --------------------------------------------------------------
     * Collection of workout objects to be rendered.
     */
    $workouts = [
        // Traps
        new Workout(1, "Barbell Shrugs", "Traps", [
            "Stand upright with your feet shoulder-width apart, holding a barbell in front of your thighs using an overhand grip.",
            "Keep your arms fully extended and your back straight.",
            "Slowly raise your shoulders as high as possible, as if trying to touch your ears.",
            "Pause and contract your traps at the top for 1-2 seconds.",
            "Slowly lower your shoulders back to the starting position in a controlled manner.",
        ], ["Upper Trapezius"], "assets/workouts/barbell_shrugs.jpg"),

        new Workout(2, "Dumbbell Shrugs", "Traps", [
            "Stand tall with a dumbbell in each hand, arms relaxed at your sides and palms facing your body.",
            "Keep your head and chest up, and avoid bending the elbows.",
            "Raise your shoulders as high as you can while keeping your arms straight.",
            "Hold the shrug for a second to maximise contraction.",
            "Lower the weights slowly to the starting position.",
        ], ["Upper Trapezius"], "assets/workouts/dumbbell_shrugs.jpg"),

        // Shoulders
        new Workout(3, "Dumbbell Shoulder Press", "Shoulders", [
            "Sit on a bench with back support, holding a dumbbell in each hand at shoulder height with your palms facing forward.",
            "Brace your core and press both dumbbells upward until your arms are fully extended overhead.",
            "Avoid locking your elbows at the top; pause briefly.",
            "Lower the dumbbells back down to shoulder height in a controlled manner.",
            "Repeat for the desired number of repetitions.",
        ], ["Deltoid Muscles"], "assets/workouts/dumbbell_shoulder_press.jpg"),

        new Workout(4, "Lateral Raises", "Shoulders", [
            "Stand with a dumbbell in each hand, arms at your sides, palms facing inward.",
            "Keep a slight bend in your elbows and engage your core.",
            "Lift both arms out to the sides until they reach shoulder level.",
            "Avoid swinging or using momentum; raise the weights using shoulder strength.",
            "Pause at the top, then slowly lower the dumbbells back to your sides.",
        ], ["Lateral Deltoids"], "assets/workouts/lateral_raises.jpg"),

        // Biceps
        new Workout(5, "Barbell Bicep Curl", "Biceps", [
            "Stand with feet shoulder-width apart, holding a barbell with an underhand grip (palms facing up).",
            "Start with the bar at arm's length, resting against your thighs.",
            "Keeping elbows close to your torso, curl the barbell up toward your chest.",
            "Squeeze your biceps at the top of the movement.",
            "Slowly lower the bar back to the starting position without letting your elbows drift forward.",
        ], ["Biceps Brachii"], "assets/workouts/barbell_bicep_curl.jpg"),

        new Workout(6, "Hammer Curl", "Biceps", [
            "Stand with your feet hip-width apart, holding a dumbbell in each hand with a neutral grip (palms facing in).",
            "Keep your elbows tight to your body and curl the weights upward.",
            "Do not rotate your wrists; keep palms facing in throughout the movement.",
            "Contract your biceps at the top of the curl, then slowly lower the weights back down.",
        ], ["Biceps", "Brachialis", "Forearms"], "assets/workouts/hammer_curl.webp"),

        // Triceps
        new Workout(7, "Overhead Tricep Extension", "Triceps", [
            "Hold a dumbbell with both hands and lift it over your head, arms extended upward.",
            "Keep your elbows close to your ears and pointed forward.",
            "Lower the dumbbell behind your head by bending at the elbows.",
            "Stop when your forearms are parallel to the floor or slightly below.",
            "Engage your triceps to extend your arms back to the starting position.",
        ], ["Triceps Brachii"], "assets/workouts/overhead_tricep_extension.jpg"),

        new Workout(8, "Tricep Dips", "Triceps", [
            "Position your hands shoulder-width apart on a sturdy bench or chair behind you.",
            "Extend your legs out in front and slide your hips off the bench.",
            "Lower your body by bending your elbows to about a 90-degree angle.",
            "Push through your palms to raise yourself back to the starting position.",
            "Keep your back close to the bench throughout the movement.",
        ], ["Triceps"], "assets/workouts/tricep_dips.jpg"),
    ];

    /**
     * --------------------------------------------------------------
     * Group Workouts by Category
     * --------------------------------------------------------------
     * Prepares an associative array for category-based rendering.
     */
    $groupedWorks = [];
    foreach ($workouts as $w) {
        $groupedWorks[$w->category][] = $w;
    }
?>
