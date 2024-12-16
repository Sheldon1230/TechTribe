<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style1.css">
    <script src="Sprofile.js"></script>
    
    <style>
        .profile-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            display: flex;
            gap: 30px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
        }

        .profile-photo {
            width: 180px;
            height: 180px;
            background: linear-gradient(135deg, #e0e0e0, #f5f5f5);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2em;
            color: var(--accent-color);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-info {
            background: var(--secondary-color);
            padding: 20px;
            border-radius: 12px;
            flex-grow: 1;
        }

        .profile-info div {
            margin: 10px 0;
            padding: 8px;
            border-bottom: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .profile-info div:hover {
            background: rgba(74, 144, 226, 0.1);
            padding-left: 15px;
        }

        .about-section {
            background: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .about-section > div:first-child {
            font-size: 1.4em;
            color: var(--accent-color);
            margin-bottom: 20px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
        }

        .about-content {
            display: grid;
            gap: 20px;
        }

        .about-content div {
            padding: 15px;
            background: var(--secondary-color);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .about-content div:hover {
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateX(10px);
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

    <div class="profile-card">
        <div class="profile-photo">
            <i class="fas fa-user-circle fa-4x"></i>
        </div>
        <div class="profile-info" id="profile-info">
            <div><i class="fas fa-user"></i> Name: <span id="profile-name"></span></div>
            <div><i class="fas fa-envelope"></i> Email: <span id="profile-email"></span></div>
            <div><i class="fas fa-map-marker-alt"></i> Address: <span id="profile-address"></span></div>
            <div><i class="fas fa-phone"></i> Contact Number: <span id="profile-phone"></span></div>
        </div>        
    </div>

    <div class="about-section">
        <div><i class="fas fa-info-circle"></i> About Me</div>
        <div class="about-content">
            <div><i class="fas fa-book"></i> Short Bio: Passionate student pursuing Computer Science</div>
            <div><i class="fas fa-code"></i> Skills: Programming, Problem Solving, Team Leadership</div>
            <div><i class="fas fa-university"></i> Education: Bachelor of Science in Computer Science</div>
        </div>
    </div>

    <footer>
        <i class="fas fa-copyright"></i> 2024 TechTribe. All rights reserved.
    </footer>

    <script>
        // Fetch profile and about section data from the backend
        async function fetchData() {
            try {
                const response = await fetch('fetch_profile.php');
                const data = await response.json();

                // Populate profile info
                const profile = document.getElementById('profile');
                profile.innerHTML = `
                    <div class="profile-photo">
                        <i class="fas fa-user-circle fa-4x"></i>
                    </div>
                    <div class="profile-info">
                        <div><i class="fas fa-user"></i> Name: ${data.name}</div>
                        <div><i class="fas fa-envelope"></i> Email: ${data.email}</div>
                        <div><i class="fas fa-map-marker-alt"></i> Address: ${data.address}</div>
                        <div><i class="fas fa-phone"></i> Contact Number: ${data.phone}</div>
                    </div>`;

                // Populate about section
                const aboutContent = document.querySelector('.about-content');
                aboutContent.innerHTML = `
                    <div><i class="fas fa-book"></i> Short Bio: ${data.bio}</div>
                    <div><i class="fas fa-code"></i> Skills: ${data.skills}</div>
                    <div><i class="fas fa-university"></i> Education: ${data.education}</div>`;

            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        // Implement search functionality
        function searchProfile() {
            const searchValue = document.getElementById('searchBox').value.toLowerCase();
            const profileInfo = document.querySelectorAll('.profile-info div, .about-content div');

            profileInfo.forEach(info => {
                if (info.textContent.toLowerCase().includes(searchValue)) {
                    info.style.display = '';
                } else {
                    info.style.display = 'none';
                }
            });
        }

        // Initial data fetch
        fetchData();
    </script>
</body>
</html>