<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style1.css">
    <script src="Sprofile.js"></script>

    <style>
        /* Slogan Section */
        .slogan-container {
            background-color: #e0e0e0;
            padding: 30px;
            margin: 20px auto;
            text-align: left;
            border-radius: 10px;
            width: 90%;
            max-width: 900px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .slogan {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }

        .slogan-description {
            font-size: 16px;
            margin-top: 10px;
            color: #555;
        }

        /* Background Section */
        .background-section {
            width: 90%;
            max-width: 900px;
            margin: 20px auto;
            height: 300px;
            background-color: #dcdcdc;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #888;
            font-size: 18px;
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

    <div class="slogan-container">
        <div class="slogan">Empowering Minds, Shaping Futures!!</div>
        <div class="slogan-description">Unlock your full potential with our interactive learning platform. 
            From hands-on programming challenges to tailored assessments, 
            we connect students and educators to achieve academic excellence and build the skills of tomorrow.
        </div>
    </div>

    <div class="background-section">
        Background Picture
    </div>

    <footer>
        <i class="fas fa-copyright"></i> 2024 TechTribe. All rights reserved.
    </footer>
</body>
</html>
