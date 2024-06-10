<?php
    session_start();

    include("db.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $Gender = $_POST['gender'];
        $gmail = $_POST['email'];
        $password = $_POST['pass'];

        if(!empty($gmail) && !empty($password) && !is_numeric($gmail)){

            $query = "insert into form (fname, lname, gender, email, pass) values ('$firstname', '$lastname', '$Gender', '$gmail', '$password')";

            mysqli_query($con, $query);

            echo "<script type='text/javascript'> alert('Successfully Register')</script>";
        }
        else{
            echo "<script type='text/javascript'> alert('Please Enter some Valid Information')</script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Learnify</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Sign Up for Learnify</h1>
        <form id="signup-form" action="signup.php" method="POST" onsubmit="return validateForm()">
            <!-- Other form fields -->
            <label for="first-name">First Name:</label>
            <input type="text" id="first-name" name="fname" required>

            <label for="last-name">Last Name:</label>
            <input type="text" id="last-name" name="lname" required>

            <label for="date-of-birth">Date of Birth:</label>
            <input type="date" id="date-of-birth" name="date-of-birth" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required min="0">
            <span id="age-error" class="error"></span>
            <span id="email-error" class="error"></span>
            <span id="password-error" class="error"></span>
            <span id="confirm-password-error" class="error"></span>
        
            <!-- Other form fields -->
            <label for="institution">Institution:</label>
            <input type="text" id="institution" name="institution" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="pass" required minlength="8">
            <span id="password-error" class="error"></span>
        
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required minlength="8">
            <span id="confirm-password-error" class="error"></span>
        
            <!-- Other form fields -->
            <p>By clicking the sign up button you agree to our <span style="color:blue ; text-decoration: underline;">Terms and conditions</span> and <span style="color: blue; text-decoration: underline">Privacy and policies</span></p>
        
            <button type="submit" class="btn next-btn">Sign Up</button>
        </form>
        
        <script>
        function validateForm() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const age = parseInt(document.getElementById('age').value, 10);
            const dateOfBirth = new Date(document.getElementById('date-of-birth').value);
            const today = new Date();
        // Email validation
        const email = document.getElementById('email').value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email)) {
            document.getElementById('email-error').textContent = 'Invalid email address.';
            return false;
        }
            // Password match validation
            if (password !== confirmPassword) {
                document.getElementById('confirm-password-error').textContent = 'Passwords do not match.';
                return false;
            }
        
            // Age calculation from date of birth
            let ageFromDOB = today.getFullYear() - dateOfBirth.getFullYear();
            const monthDifference = today.getMonth() - dateOfBirth.getMonth();
        
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dateOfBirth.getDate())) {
                ageFromDOB--;
            }
        
            // Age validation
            if (age !== ageFromDOB) {
                document.getElementById('age-error').textContent = 'Age does not match the date of birth.';
                return false;
            }
        
            // If validation passes, allow form submission
            return true;
        }
        </script>
</body>
</html>