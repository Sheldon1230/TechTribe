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
                        <h1>
                            Class <!----Later Need to put how many class the student have attend----->
                        </h1>
                    </div>
                </div>

                <div class="student-hour-selection">
                    <div class="hour-selection-container">
                        <form method="#">
                            <label for="Student-List">Student Name:</label>
                            <select name="Student-List-Container" id="" class="student-list">
                                <option value="">Select a specific student</option>
                                <option value="Student 1">Student 1</option>
                                <option value="Student 2">Student 2</option>
                                <option value="Student 3">Student 3</option>
                                <option value="Student 4">Student 4</option>
                                <option value="Student 5">Student 5</option>
                            </select><br>
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

        </section>

        <section id="Insight" onclick="myButtonInsight()">

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
    
                <div class="user-profile_container">
                    <div class="user-profile-ring">
                        <img src="/user.jpg" class="user-profile-image">
                    </div>
    
                    <div class="user-name">
                        <h1><u>User Name</u></h1>
                        <h3><u>Profession</u></h3>
                    </div>
    
                    <div class="button-design">
                        <button>Massage</button>
                        <button>Notification</button>
                    </div>
    
                    <div class="bottom-skill">
                        <h2>Skill</h2>
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
    
<!-- jQuery (latest version) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Custom Script -->
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
