<?php
    session_start();

    include("db.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $gmail = $_POST['email'];
        $password = $_POST['pass'];

        if(!empty($gmail) && !empty($password) && !is_numeric($gmail)){

            $query = "select * from form where email = '$gmail' limit 1";

            $result = mysqli_query($con, $query);

            if($result){
                if($result && mysqli_num_rows($result) > 0){

                    $user_data = mysqli_fetch_assoc($result);

                    if($user_data['pass'] == $password){

                        $_SESSION['user_id'] = $user_data['user_id'];
                        header("Location: help_options.html");
                        die;
                    }
                }
            }
            echo "<script type='text/javascript'> alert('Invalid Information')</script>";
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
    <title>Login | Learnify</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .logo {
            width: 150px; /* Adjust the size as needed */
            height: auto; /* Maintain aspect ratio */
        }
        .header {
            display: flex;
            align-items: center;
            padding: 10px;
            background: linear-gradient(to right, #6a11cb, #2575fc); /* Optional: background color for the header */
        }
    </style>
</head>
<body>
    <header class="header">
        <img src="logo3.png" alt="My Logo" class="logo" style="width: 200px; height: auto;">
        <header ></header>
        <!-- Other header content like navigation can go here -->
    </header>
    <div class="container">
        <h1>Login to Learnify</h1>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="pass" required>

            <button type="submit" class="btn next-btn">Login</button>
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </div>
        </form>
        
    </div>
</body>
</html>
