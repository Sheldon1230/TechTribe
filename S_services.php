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
    
            /* New sections as buttons */
            .section {
                width: 90%;
                max-width: 900px;
                margin: 20px auto;
                padding: 20px;
                background-color: #79c6fa;
                border-radius: 10px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                text-align: center;
                font-size: 20px;
                color: white;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
    
            .section i {
                font-size: 40px;
                margin-bottom: 15px;
            }
    
            .section:hover {
                background-color: #2980b9;
            }
    
            .section a {
                color: white;
                text-decoration: none;
                display: block;
                width: 100%;
                height: 100%;
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

    <div class="section">
        <a href="coding-tutorial.php">
            <i class="fas fa-laptop-code"></i>
            <h3>Coding Tutorial</h3>
            <p>Explore our tutorials to sharpen your coding skills.</p>
        </a>
    </div>

    <div class="section">
        <a href="mentorship-program.php">
            <i class="fas fa-chalkboard-teacher"></i>
            <h3>Mentorship Program</h3>
            <p>Get guidance from experts in the programming world.</p>
        </a>
    </div>

    <div class="section">
        <a href="workshop.php">
            <i class="fas fa-briefcase"></i>
            <h3>Workshop</h3>
            <p>Join hands-on workshops to apply your skills in real-world scenarios.</p>
        </a>
    </div>

    <div class="section">
        <a href="resource-library.php">
            <i class="fas fa-book"></i>
            <h3>Resource Library</h3>
            <p>Access a library of resources to enhance your learning.</p>
        </a>
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