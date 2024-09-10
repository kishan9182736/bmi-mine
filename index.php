<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">BMI CALCULATOR</div>

        <!-- Form submission to result.php -->
        <form action="result.php" method="POST">
            <div class="input-section">
                <p>Name:</p>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="gender-selector">
                <div class="gender male" onclick="selectGender('male')">
                    <label>
                        <input type="radio" name="gender" value="male" id="male">
                        <div class="gender-icon" id="maleIcon">
                            <span>Male</span>
                        </div>
                    </label>
                </div>
                <div class="gender female" onclick="selectGender('female')">
                    <label>
                        <input type="radio" name="gender" value="female" id="female">
                        <div class="gender-icon" id="femaleIcon">
                            <span>Female</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="input-section">
                <p>HEIGHT: <span id="height-value">175</span> cm</p>
                <input type="range" id="height" name="height" min="100" max="220" value="175">
            </div>
            
            <div class="input-section">
                <p>Weight:</p>
                <input type="number" id="weight" name="weight" min="30" max="200" required>
            </div>

            <div class="input-section">
                <p>Age:</p>
                <input type="number" id="age" name="age" min="10" max="100" required>
            </div>

            <button class="calculate-btn" type="submit">Calculate</button>
        </form>
    </div>

    <script>
        // Gender selection function
        function selectGender(gender) {
            const maleIcon = document.getElementById('maleIcon');
            const femaleIcon = document.getElementById('femaleIcon');
            
            if (gender === 'male') {
                maleIcon.style.backgroundColor = '#007bff'; 
                femaleIcon.style.backgroundColor = '#1e1e1e'; 
                document.getElementById('male').checked = true;
            } else {
                femaleIcon.style.backgroundColor = '#007bff'; 
                maleIcon.style.backgroundColor = '#1e1e1e'; 
                document.getElementById('female').checked = true;
            }
        }

        // Update height display
        const heightSlider = document.getElementById('height');
        const heightValue = document.getElementById('height-value');
        heightSlider.oninput = () => heightValue.innerText = heightSlider.value;
    </script>
</body>
</html>
