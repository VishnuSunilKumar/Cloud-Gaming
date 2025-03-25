<?php 
include("php/config.php");

if(isset($_POST['submit'])) {
    // Retrieve form input values
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if the email already exists in the database
    $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");

    if(mysqli_num_rows($verify_query) != 0) {
        echo "<div class='message'>
            <p>The email is already used. Please try another one!</p>
            </div><br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
    } else {
        // Hash the password securely
        // Store the plain text password
        $hashed_password = $password;

        // Insert data into the 'users' table in the database
        $insert_query = "INSERT INTO users (Username, Email, Password) VALUES ('$username', '$email', '$hashed_password')";

        if(mysqli_query($con, $insert_query)) {
            // Redirect to login page immediately after successful signup
            header("Location: login.html");
            exit();
        } else {
            echo "<div class='message'>
                <p>Error: Could not register. Please try again.</p>
                </div><br>";
        }
    }
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Cloud Gaming</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="index.html">
                    <img src="logo.png" width="220" height="30" alt="Cloud Gaming">
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="index.html#features">Features</a></li>
                    <li><a href="purchase.html">Purchase</a></li>
                    <li><a href="index.html#community">About</a></li>
                </ul>
            </nav>
            <a href="signup.php" class="login-btn">SIGNUP</a>
        </div>
    </header>

    <div class="auth-container">
        <div class="auth-form">
            <h2>Get Started Now</h2>
            <form action="signup.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" placeholder="Email address" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I agree to the terms & policies</label>
                </div>
                <button type="submit" name="submit" class="cta-btn">Sign up</button>
            </form>

            <div class="social-login">
                <button class="google-btn">Sign in with Google</button>
                <button class="apple-btn">Sign in with Apple</button>
            </div>
            <p>Have an account? <a href="login.html">Sign in</a></p>

        </div>

        <div class="auth-image">
            <img src="8.jpg" width="1200" height="750" alt="Sign up image">
        </div>
    </div>
</body>
</html>

<?php } ?>
