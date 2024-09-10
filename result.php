<?php
    // Include the database connection
    include 'db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the form data
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $height = $_POST['height'] / 100;  // Convert cm to meters
        $weight = $_POST['weight'];
        $age = $_POST['age'];

        // Calculate BMI
        $bmi = $weight / ($height * $height);
        $bmi = round($bmi, 1);

        // Determine BMI category
        if ($bmi < 18.5) {
            $status = "Underweight";
        } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
            $status = "Normal";
        } elseif ($bmi >= 25 && $bmi <= 29.9) {
            $status = "Overweight";
        } else {
            $status = "Obese";
        }

        // Step 1: Insert the user into the users table
        $stmt = $conn->prepare("INSERT INTO users (name) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        // Get the last inserted user ID
        $user_id = $conn->lastInsertId();

        // Step 2: Insert the BMI data into the bmi_records table
        $stmt = $conn->prepare("INSERT INTO bmi_records (user_id, gender, height, weight, age, bmi, bmi_status) 
                                VALUES (:user_id, :gender, :height, :weight, :age, :bmi, :bmi_status)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':height', $height);
        $stmt->bindParam(':weight', $weight);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':bmi', $bmi);
        $stmt->bindParam(':bmi_status', $status);
        $stmt->execute();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">BMI RESULT</div>

        <div class="result-box">
            <p class="bmi-status"><?php echo $status; ?></p>
            <p class="bmi-value"><?php echo $bmi; ?></p>
            <p>Normal BMI range: 18.5 - 24.9 kg/m<sup>2</sup></p>
            <p><?php echo "You have a " . strtolower($status) . " body weight."; ?></p>
        </div>

        <form action="index.php" method="GET">
            <button class="recalculate-btn" type="submit">Re - Calculate</button>
        </form>
    </div>
</body>
</html>
