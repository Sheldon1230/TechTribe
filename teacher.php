<?php
// Include database connection
include("classroom_db.php");

// Success message placeholder
$success_message = "";

// Handle Resource Creation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_resource'])) {
    $classroom_id = intval($_POST['classroom_id']);
    $title = $_POST['title'];
    $resource_type = $_POST['resource_type'];
    $resource_url = $_POST['resource_url'];

    $stmt = $conn->prepare("INSERT INTO resources (classroom_id, title, resource_type, resource_url) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("isss", $classroom_id, $title, $resource_type, $resource_url);
        $stmt->execute();
        $success_message = "Resource added successfully!";
        $stmt->close();
    }
}

// Handle Resource Deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_resource_id'])) {
    $resource_id = intval($_POST['delete_resource_id']);
    $stmt = $conn->prepare("DELETE FROM resources WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $resource_id);
        $stmt->execute();
        $success_message = "Resource deleted successfully!";
        $stmt->close();
    }
}

// Fetch Classrooms for Dropdown
$classrooms_query = "SELECT id, classroom_name FROM classrooms";
$classrooms = $conn->query($classrooms_query);

// Fetch Resources for the Selected Classroom
$selected_classroom = null;
$classroom_resources = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['classroom'])) {
    $selected_classroom = intval($_POST['classroom']);
    $stmt = $conn->prepare("SELECT * FROM resources WHERE classroom_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $selected_classroom);
        $stmt->execute();
        $classroom_resources = $stmt->get_result();
        $stmt->close();
    }
}

// Handle Quiz Addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_quiz'])) {
    $classroom_id = intval($_POST['classroom_id']); // Ensure classroom_id is numeric
    $quiz_title = $_POST['quiz_title'];

    // Check if classroom_id exists in classrooms table
    $stmt = $conn->prepare("SELECT id FROM classrooms WHERE id = ?");
    $stmt->bind_param("i", $classroom_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        die("Error: Classroom ID $classroom_id does not exist.");
    }
    $stmt->close();

    // Insert quiz into quizzes table
    $stmt = $conn->prepare("INSERT INTO quizzes (classroom_id, quiz_title) VALUES (?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("is", $classroom_id, $quiz_title);
    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }

    $quiz_id = $stmt->insert_id; // Get the new quiz ID
    $stmt->close();

    echo "Quiz added successfully!";
}

    session_start();
    include('user_db.php');

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.html"); // Redirect to login if not logged in
        exit;
    }

    $user_id = $_SESSION['user_id'];

    // Fetch user data
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();


// Close the database connection at the end
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teacher.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <title>Teacher Page</title>
</head>
<body>
    <nav class="SideBar close">
        <header>
            <div class="logo">
                <span class="image">
                    <img src="TechTribe Logo.png" alt="TechTribe Logo">
                </span>

                <div class="text text_logo">
                    <span class="Logo">TechTribe</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-link">
                    <li class="search-box">
                        <i class='bx bx-search icon'></i>
                        <input type="text" placeholder="Search...">
                    </li>

                    <li class="nav-bar">
                        <a href="#Dashboard">
                            <i class='bx bx-home-alt icon' title="Dashboard"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-bar">
                        <a href="#Classroom">
                            <i class='bx bxs-chalkboard icon' title="Classroom"></i>
                            <span class="text nav-text">Classroom</span>
                        </a>
                    </li>

                    <li class="nav-bar">
                        <a href="#Plan">
                            <i class='bx bxs-book-content icon' title="Plan / e-Resource Editor"></i>
                            <span class="text nav-text">Plan / Online Resource Editor</span>
                        </a>
                    </li>
                    
                    <li class="nav-bar">
                        <a href="#Insight">
                            <i class='bx bx-hdd' title="Insights"></i>
                            <span class="text nav-text">Insights</span>
                        </a>
                    </li>

                    <li class="nav-bar">
                        <a href="#user-page">
                            <i class='bx bxs-user-rectangle' title="User Profile"></i>
                            <span class="text nav-text">User Profile</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <ul>
                    <li>
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </li>

                    <li class="mode">
                        <div class="sun-moon">
                            <i class='bx bx-moon icon moon'></i>
                            <i class='bx bx-sun icon sun'></i>
                        </div>
                        <span class="mode-text text">Dark mode</span>

                        <div class="toggle-switch">
                            <span class="switch"></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-page-button">
        <button class="button" onclick="myButtonDashboard()">Start</button>
    </div>

    <div class="container">
        <section id="Dashboard" class="active">
            <div class="Dashboard-Container">
                <div class="Dashboard-Container-Design">
                    <div class="code_text">HTML</div>
                    <div class="code_text">CSS</div>
                    <div class="code_text">JavaScript</div>
                    <div class="code_text">PHP</div>
                    <div class="code_text">Java</div>
                    <div class="code_text">C++</div>
                    <div class="code_text">Ruby</div>
                    <div class="code_text">Python</div>
                    <div class="code_text">Node.js</div>
                    <div class="code_text">React.js</div>
                    <div class="code_text">React</div>
                    <div class="code_text">Kotlin</div>
                    <div class="code_text">Swift</div>
                    <div class="code_text">Go</div>
                    <div class="code_text">Rust</div>
                    <div class="code_text">SQL</div>
                    <div class="code_text">TypeScript</div>
                    <div class="code_text">Perl</div>
                    <div class="code_text">Angular</div>
                    <div class="code_text">Vue.js</div>
                    <div class="code_text">MongoDB</div>
                </div>
                <h1>
                    Welcome To The Teacher'S Dashboard
                </h1>
            </div>
    
            <div class="Classroom-Intro">
                <h2>Classroom Introduction</h2>
                <div class="Intro-Design-Classroom">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut optio facilis ex. Officiis cum error consequatur animi ratione corrupti quia incidunt magni nostrum, adipisci impedit mollitia sint quae commodi saepe.
                    </p>
                    <div class="button-to-Classroom">
                        <button onclick="myButtonClassroom()">
                            Go to <i class='bx bx-right-arrow-alt'></i>
                        </button>
                    </div>
                </div>
            </div>
    
            <div class="Plan-Intro">
                <h2>Plan Introduction</h2>
                <div class="Intro-Design-Plan">
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed consequatur vero veritatis, accusantium natus aut quas nobis aliquam sunt assumenda, nesciunt beatae numquam harum maiores voluptate, perferendis magni quis porro.
                    </p>
                    <div class="button-to-Plan">
                        <button onclick="myButtonPlan()">
                            Go to <i class='bx bx-right-arrow-alt'></i>
                        </button>
                    </div>
                </div>
            </div>
    
            <div class="Insight-Intro">
                <h2>Insight Introduction</h2>
                <div class="Intro-Design-Insight">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio qui quidem quisquam ab necessitatibus repudiandae. Qui impedit atque non numquam ipsa facilis ullam culpa inventore distinctio, itaque voluptatum laudantium ex?
                    </p>
                    <div class="button-to-Insight">
                        <button onclick="myButtonInsight()">
                            Go to <i class='bx bx-right-arrow-alt'></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section id="Classroom" onclick="myButtonClassroom()">
            <div class="classroom-background">
                <div class="classroom-header">
                    <h2>
                        Teacher Classroom
                    </h2>
                </div>
                <div class="classroom-cantainer">
                    <h3>
                        Classroom Course
                    </h3>
                    <div class="classroom-container-box-1">
                    <form method="POST" action="" class="Classroom_Drp">
                            <label for="classroom" style="color: white;">Choose a classroom:</label>
                            <select name="classroom" id="classroom-dropdown-classroom" onchange="this.form.submit()">
                                <option value="">-- Select Classroom --</option>
                                <?php while ($row = $classrooms->fetch_assoc()): ?>
                                    <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $selected_classroom) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($row['classroom_name']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                    </form>
                    </div>
                </div>

                <div class="student-hour-selection">
                    <div class="hour-selection-container">
                        <form method="#">
                        <label for="student-list">Student Name:</label>
                        <select name="student-list" id="student-list" class="student-list">
                            <option value="">Select a student</option>
                        </select>
                        </form>
                        <div class="detail-info-container">
                            <div class="details-info-1">
                                <p>
                                    Time Spent
                                </p>
                                <h1>
                                    <i class='bx bxs-time'></i>
                                    Time
                                </h1>
                                <p>Learn</p>
                            </div>
                            <div class="details-info-2">
                                <p>
                                    Answered
                                </p>
                                <h1>
                                    <i class='bx bx-list-check' ></i>
                                    <div class="text-answer">Number</div>
                                </h1>
                                <p class="question-list">Questions</p>
                            </div>
                            <div class="details-info-3">
                                <p>
                                    Completed
                                </p>
                                <h1>
                                    <i class='bx bxs-book' ></i>
                                    <div class="completed-list">Number</div>
                                </h1>
                                <p class="lesson-list">Lesson</p>
                            </div>
                            <div class="details-info-4">
                                <p>
                                    Solve
                                </p>
                                <h1>
                                    <i class='bx bx-desktop' ></i>
                                    Time
                                </h1>
                                <p>Challenges</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="classroom-piechart-container">
                    <div class="classroom-piechart-background">
                        <h2>
                            Class Overall Progress
                        </h2>
                        <div class="card" id="chart-container">
                            <canvas id="graphCanvas"></canvas>
                        </div>
                    </div>
                </div>

                <div class="table">
                    <table>
                        <tr>
                            <tbody><!--Add the live table here cause i gave up--></tbody>
                        </tr>
                    </table>
                </div>
            </div>
        </section>

        <section id="Plan" onclick="myButtonPlan()">
            <div class="plan_background">
                <header class="classroom_selection" style="position: relative;left: 7em;">
                    <?php echo $selected_classroom ? "Classroom ID: " . htmlspecialchars($selected_classroom) : "Select a Classroom"; ?>
                </header>

                <!-- Success Message -->
                <?php if (isset($success_message)): ?>
                    <p style="color: green; text-align: center;"><?php echo $success_message; ?></p>
                <?php endif; ?>

                <!-- Classroom Dropdown -->
                <form method="POST" action="" class="Classroom_Drp">
                    <label for="classroom">Choose a classroom:</label>
                    <select name="classroom" id="classroom-dropdown" onchange="this.form.submit()">
                        <option value="">-- Select Classroom --</option>
                        <?php while ($row = $classrooms->fetch_assoc()): ?>
                            <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $selected_classroom) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($row['classroom_name']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </form>


                <!-- Manage Resources -->
                 <div class="content">
                    <h2>Manage Resources</h2>
                    <table border="1">
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>URL</th>
                            <th>Actions</th>
                        </tr>
                        <?php if ($classroom_resources && $classroom_resources->num_rows > 0): ?>
                            <?php while ($resource = $classroom_resources->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($resource['title']); ?></td>
                                    <td><?php echo htmlspecialchars($resource['resource_type']); ?></td>
                                    <td><?php echo htmlspecialchars($resource['resource_url']); ?></td>
                                    <td>
                                        <form method="POST" action="" style="display:inline;">
                                            <input type="hidden" name="delete_resource_id" value="<?php echo $resource['id']; ?>">
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="4">No resources found for this classroom.</td></tr>
                        <?php endif; ?>
                    </table>

                    <!-- Add Resource Form -->
                    <h3>Add New Resource</h3>
                    <form method="POST" action="" class="question_test">
                        <input type="hidden" name="classroom_id" value="<?php echo $selected_classroom; ?>">
                        <label>Title:</label>
                        <input type="text" name="title" required>
                        <label>Type:</label>
                        <select name="resource_type">
                            <option value="link">Link</option>
                            <option value="video">Video</option>
                            <option value="document">Document</option>
                        </select>
                        <label>URL:</label>
                        <input type="text" name="resource_url" required>
                        <button type="submit" name="add_resource">Add Resource</button>
                    </form>

                    <form method="POST" action="" class="question_test">
                        <input type="hidden" name="classroom_id" value="<?php echo $selected_classroom; ?>">
                        <label>Quiz Title:</label>
                        <input type="text" name="quiz_title" required>
                        <h3>Questions</h3>
                        <div id="questions">
                            <div>
                                <label>Question:</label>
                                <input type="text" name="questions[]" required>
                                <label>Option A:</label>
                                <input type="text" name="options_a[]" required>
                                <label>Option B:</label>
                                <input type="text" name="options_b[]" required>
                                <label>Option C:</label>
                                <input type="text" name="options_c[]" required>
                                <label>Option D:</label>
                                <input type="text" name="options_d[]" required>
                                <label>Correct Option:</label>
                                <select name="correct_options[]">
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                    <option value="d">D</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" name="add_quiz">Add Quiz</button>
                    </form>
                </div>
            </div>
        </section>

        <section id="Insight" onclick="myButtonInsight()">
            <div class="insight_background">
                <h1>Student Performance Dashboard</h1>
                <table id="performanceTable">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Task Name</th>
                            <th>Completion Rate (%)</th>
                            <th>Time Spent (Seconds)</th>
                            <th>Core Concept Understanding (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be inserted here dynamically -->
                    </tbody>
                </table>

                <div id="charts">
                    <canvas id="completionRateChart"></canvas>
                    <canvas id="timeSpentChart"></canvas>
                    <canvas id="coreUnderstandingChart"></canvas>
                </div>
            </div>
        </section>

        <section id="user-page">
            <div class="user-background">
                <div class="code_text">HTML</div>
                <div class="code_text">CSS</div>
                <div class="code_text">JavaScript</div>
                <div class="code_text">PHP</div>
                <div class="code_text">Java</div>
                <div class="code_text">C++</div>
                <div class="code_text">Ruby</div>
                <div class="code_text">Python</div>
                <div class="code_text">Node.js</div>
                <div class="code_text">React.js</div>
                <div class="code_text">React</div>
                <div class="code_text">Kotlin</div>
                <div class="code_text">Swift</div>
                <div class="code_text">Go</div>
                <div class="code_text">Rust</div>
                <div class="code_text">SQL</div>
                <div class="code_text">TypeScript</div>
                <div class="code_text">Perl</div>
                <div class="code_text">Angular</div>
                <div class="code_text">Vue.js</div>
                <div class="code_text">MongoDB</div>
    
                <div class="user-profile">
                    <div class="user-profile-container">
                        <h1>Welcome, <?php echo $user['username']; ?></h1>
                        <p class="email-text">Email: <?php echo $user['email']; ?></p>
                        <p class="bio-text">Bio: <?php echo $user['bio'] ?: 'No bio added yet'; ?></p>
                        <img src="user2.jpg" class="user-image">

                        <form action="update_user.php" method="POST">
                            <textarea name="bio" placeholder="Update your bio" class="textfield"><?php echo $user['bio']; ?></textarea>
                            <button type="submit" class="updates-button">Update</button>
                        </form>

                        <a href="logout.php" class="logout-link">Logout</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajax({
                url: "pie_chart_data.php",
                method: "GET",
                success: function(data){
                    console.log(data);
                    var name = [];
                    var progress = [];

                    for (var i in data){
                        name.push(data[i].lan_name);

                        progress.puch(data[i].progress);
                    }
                    var chardata = {
                        labels: name,
                        datasets: [{
                            label: "Progress",
                            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                            hoverBackgroundColor: 'rgba(230, 236, 235, 0.75)',
                            hoverBorderColor: 'rgba(230, 236, 235, 0.75)',
                            data: progress


                        }]
                    };
                    var graphProg = $("graphCanvas");
                    var Graph = new Chart(graphProg, {
                        type: "pie",
                        data: chardata,


                    })
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="teacher.js"></script>



</body>
<footer>
    <div class="content3">
    <div class="top">
        <div class="logo-details">
            <i class="fa-solid fa-memory"></i>
        <span class="logo_name">TechTribe</span>
        </div>
        <div class="media-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
    <div class="link-boxes">
        <ul class="box">
        <li class="link_name">Communities</li>
        <li><a href="#">Home</a></li>
        <li><a href="#">Contact us</a></li>
        </ul>
        <ul class="box">
        <li class="link_name">Services</li>
        <li><a href="#">Coding Tutorial</a></li>
        <li><a href="#">Workshop</a></li>
        <li><a href="#">Mentorship Program</a></li>
        <li><a href="#">Resource Library</a></li>
        </ul>
        <ul class="box">
        <li class="link_name">Account</li>
        <li><a href="#">Profile</a></li>
        </ul>
        <ul class="box input-box">
        <li class="link_name">Subscribe</li>
        <li><input type="text" placeholder="Enter your email"></li>
        <li><input type="button" value="Subscribe"></li>
        </ul>
    </div>
    </div>
    <div class="bottom-details">
    <div class="bottom_text">
        <span class="copyright_text">Copyright © 2024 <a href="#">TechTribe </a>All rights reserved</span>
        <span class="policy_terms">
        <a href="#">Privacy policy</a>
        <a href="#">Terms & condition</a>
        </span>
    </div>
    </div>
</footer>
</html>
