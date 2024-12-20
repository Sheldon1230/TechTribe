<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materials Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style1.css">
    <script src="Sprofile.js"></script>
    
    <style>
        /* Materials Section */
        .materials-section {
            width: 90%;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .material-item {
            margin-bottom: 20px;
        }

        .material-item iframe {
            width: 100%;
            max-width: 800px;
            height: 400px;
            border-radius: 8px;
        }

        .material-item h3 {
            margin-top: 10px;
            font-size: 20px;
            color: #333;
        }

        .material-item p {
            color: #555;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="TechTribe Logo.png"  style="width:100px;height:70px;">
        </div>
        <nav class="nav-menu">
            <div class="nav-item"><i class="fas fa-user"></i><a href="S_profile_page.html"> Profile</a></div>
            <div class="nav-item"><i class="fas fa-cogs"></i><a href="S_services.html"> Services</a></div>
        </nav>
        <div class="search-section">
            <input type="text" class="search-box" placeholder="Search...">
            <a href="login form/login form/login form/login form.html" class="sign-in-btn"><i class="fas fa-sign-in-alt"></i> SIGN IN / SIGN UP</a>
        </div>      
    </header>

    <!-- Materials Section -->
    <div class="materials-section">
        <h2>Materials Provided by Lecturers</h2>

        <?php
        $servername = "localhost";
        $username = "Sheldon";
        $password = "123456";
        $database = "Library_db";
        // Danish !!!!!! Help me to create the table 'lecturer_videos' with columns: 'video_url' and 'video_title'
        $conn = new mysqli('localhost', 'username', 'password', 'database_name');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to get the video details from the database
        $sql = "SELECT video_url, video_title FROM lecturer_videos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output each video from the database
            while($row = $result->fetch_assoc()) {
                echo '<div class="material-item">';
                echo '<iframe src="' . $row["video_url"] . '" frameborder="0" allowfullscreen></iframe>';
                echo '<h3>' . $row["video_title"] . '</h3>';
                echo '<p>Video from Lecturers materials.</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No videos available.</p>';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

    <footer>
        <i class="fas fa-copyright"></i> 2024 TechTribe. All rights reserved.
    </footer>
</body>
</html>
