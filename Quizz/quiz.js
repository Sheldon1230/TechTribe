// Made by Sheldon
// Timer functionality
let timeRemaining = 300;
const timerElement = document.getElementById('time');
const timerContainer = document.getElementById('timer');

const timer = setInterval(() => {
    timeRemaining--;
    timerElement.textContent = timeRemaining;

    // Add warning colors when time is running low
    if (timeRemaining <= 60) {
        timerContainer.style.backgroundColor = '#E53E3E';
        timerContainer.style.animation = 'pulse 1s infinite';
    } else if (timeRemaining <= 120) {
        timerContainer.style.backgroundColor = '#ED8936';
    }

    if (timeRemaining <= 0) {
        clearInterval(timer);
        alert("Time's up! Submitting your quiz...");
        document.getElementById('quiz-form').submit();
    }
}, 1000);

// Fetch and display questions
fetch('fetch_questions.php')
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            document.getElementById('questions').innerHTML = `
                <div class="question" style="text-align: center; color: #E53E3E;">
                    <p>${data.error}</p>
                </div>`;
        } else {
            let questionsHtml = '';
            data.forEach((question, index) => {
                questionsHtml += `
                    <div class="question">
                        <p>${index + 1}. ${question.question}</p>
                        <label class="radio-container">
                            ${question.option_a}
                            <input type="radio" name="question_${question.id}" value="A" required>
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio-container">
                            ${question.option_b}
                            <input type="radio" name="question_${question.id}" value="B">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio-container">
                            ${question.option_c}
                            <input type="radio" name="question_${question.id}" value="C">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio-container">
                            ${question.option_d}
                            <input type="radio" name="question_${question.id}" value="D">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                `;
            });
            document.getElementById('questions').innerHTML = questionsHtml;
        }
    })
    .catch(err => {
        document.getElementById('questions').innerHTML = `
            <div class="question" style="text-align: center; color: #E53E3E;">
                <p>Failed to load questions. Please try again later.</p>
            </div>`;
    });

// Handle form submission with animation
document.getElementById('quiz-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Disable submit button and show loading state
    const submitButton = this.querySelector('button[type="submit"]');
    submitButton.disabled = true;
    submitButton.innerHTML = 'Submitting...';
    
    const formData = new FormData(this);
    fetch('submit_quiz.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Show result with animation
        const resultDiv = document.getElementById('result');
        resultDiv.style.opacity = '0';
        resultDiv.innerHTML = `<h2>${data.message}</h2>`;
        
        // Fade in animation
        setTimeout(() => {
            resultDiv.style.transition = 'opacity 0.5s ease';
            resultDiv.style.opacity = '1';
        }, 100);
        
        // Reset button state
        submitButton.disabled = false;
        submitButton.innerHTML = 'Submit Quiz';
    })
    .catch(err => {
        document.getElementById('result').innerHTML = `
            <div style="color: #E53E3E;">
                <p>Submission failed. Please try again.</p>
            </div>`;
        
        // Reset button state
        submitButton.disabled = false;
        submitButton.innerHTML = 'Submit Quiz';
    });
});

       