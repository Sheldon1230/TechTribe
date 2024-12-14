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

//The Student Dropdown
document.addEventListener("DOMContentLoaded", function () {
  // Fetch students and populate the dropdown
  fetch("get_students.php")
      .then(response => response.json())
      .then(data => {
          const studentDropdown = document.getElementById("student-list");
          data.forEach(student => {
              const option = document.createElement("option");
              option.value = student.id; // Use student ID as the value
              option.textContent = student.name; // Display student name
              studentDropdown.appendChild(option);
          });
      })
      .catch(error => {
          console.error("Error fetching students:", error);
      });

  // Add event listener to the dropdown
  const studentDropdown = document.getElementById("student-list");
  studentDropdown.addEventListener("change", function () {
      const selectedStudentId = this.value;
      if (selectedStudentId) {
          // Fetch data for the selected student
          fetch(`get_student_data.php?student_id=${selectedStudentId}`)
              .then(response => response.json())
              .then(data => {
                  if (data.error) {
                      console.error(data.error);
                      alert(data.error);
                      return;
                  }

                  // Update the content of the four boxes
                  document.querySelector(".details-info-1 h1").textContent = `${data.time_spent} hrs`;
                  document.querySelector(".details-info-2 .text-answer").textContent = data.questions_answered;
                  document.querySelector(".details-info-3 .completed-list").textContent = data.lessons_completed;
                  document.querySelector(".details-info-4 h1").textContent = `${data.challenges_solved} solved`;
              })
              .catch(error => {
                  console.error("Error fetching student data:", error);
              });
      }
  });
});

//The Classroom Dropdown
function loadClassroom() {
  const classroom = document.getElementById('classroom-dropdown').value;

  if (classroom) {
      fetch('fecth_classroom.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: `classroom=${encodeURIComponent(classroom)}`
      })
      .then(response => response.json())
      .then(data => {
          if (data.status === 'success') {
              document.getElementById('content').innerHTML = `<h2>${classroom}</h2><p>${data.content}</p>`;
          } else {
              document.getElementById('content').innerHTML = `<p style="color: red;">${data.message}</p>`;
          }
      })
      .catch(error => {
          console.error('Error:', error);
          document.getElementById('content').innerHTML = `<p style="color: red;">An error occurred. Please try again later.</p>`;
      });
  } else {
      alert('Please select a classroom!');
  }
}
