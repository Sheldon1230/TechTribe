const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");

// Toggle Sidebar
toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});

// Expand Sidebar on Search Click
if (searchBtn) {
    searchBtn.addEventListener("click", () => {
        sidebar.classList.remove("close");
    });
}

// Toggle Dark Mode
if (modeSwitch) {
    modeSwitch.addEventListener("click", () => {
        body.classList.toggle("dark");
        
        if(body.classList.contains("dark")){
            modeText.innerText = "Light mode";
        } else {
            modeText.innerText = "Dark mode";
        }
    });
}

//Button functions
function myButtonClassroom() {
    window.location.href = '#Classroom';
}

function myButtonPlan() {
    window.location.href = '#Plan';
}

function myButtonInsight() {
    window.location.href = '#Insight';
}

//Show the dashboard section by default
function myButtonDashboard() {
    window.location.href = '#Dashboard';
}


function showSection(sectionId) {
    // Hide all sections
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
        section.classList.remove('active');
    });

    // Show the selected section
    const activeSection = document.getElementById(sectionId);
    if (activeSection) {
        activeSection.classList.add('active');
    }
}

//Progress Bar 
$(".animated-progress span").each(function () {
    $(this).animate(
      {
        width: $(this).attr("data-progress") + "%",
      },
      1000
    );
    $(this).text($(this).attr("data-progress") + "%");
  });

//See More Button
function on() {
    document.getElementById("overlay").style.display = "block";
  }
  
  function off() {
    document.getElementById("overlay").style.display = "none";
  }