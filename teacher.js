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

// See More Button
function showSection(sectionId) {
  // Hide all sections
  const sections = document.querySelectorAll('section');
  sections.forEach(section => section.classList.remove('active'));

  // Show the selected section
  const activeSection = document.getElementById(sectionId);
  if (activeSection) activeSection.classList.add('active');
}

// Pie Chart
$(document).ready(function () {
  $.ajax({
      url: "pie_chart_data.php", // Correct file path
      method: "GET",
      success: function (data) {
          console.log("Data received:", data); // Check the console for the data
          
          var names = [];   // For chart labels
          var values = [];  // For chart data

          for (var i in data) {
              // Correct keys based on JSON output
              names.push(data[i]['lan_name']);
              values.push(data[i]['progress']);
          }

          var chartdata = {
              labels: names,
              datasets: [{
                  label: 'Progress',
                  backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
                  data: values
              }]
          };

          // Render Chart.js
          var graphTarget = $("#graphCanvas");
          new Chart(graphTarget, {
              type: 'pie',
              data: chartdata
          });
      },
      error: function (error) {
          console.log("Error fetching data:", error);
      }
  });
});


// Table
$(document).ready(function(){
  $('#data_table').Tabledit({
  deleteButton: false,
  editButton: false,
  columns: {
  identifier: [0, 'id'],
  editable: [[1, 'name'], [2, 'gender'], [3, 'age'], [4, 'designation'], [5, 'address']]
  },
  hideIdentifier: true,
  url: 'table_config.php'
  });
});