<?php 
session_start();
include("php/config.php");

if(isset($_POST['submit'])) {
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        if (!$con) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        
        $verify_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1");

        if(!$verify_query) {
            die("Query failed: " . mysqli_error($con));
        }

        if(mysqli_num_rows($verify_query) > 0) {
            $user = mysqli_fetch_assoc($verify_query);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index2.html");
            exit();
        } else {
            $error_message = "Incorrect username or password";
        }
    } else {
        $error_message = "Please fill in all fields";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cloud Gaming</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .auth-container {
            display: flex;
            min-height: 100vh;
            align-items: stretch;
        }

        .auth-form {
            flex: 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 500px;
            background: white;
        }

        .auth-image {
            flex: 1;
            position: relative;
            overflow: hidden;
            min-width: 50%;
        }

        .auth-image img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .error-message {
            color: #ff0000;
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
            font-weight: bold;
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .cta-btn {
            width: 100%;
            padding: 1rem;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .cta-btn:hover {
            background: #218838;
        }
    </style>
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
            <a href="signup.html" class="login-btn">SIGNUP</a>
        </div>
    </header>
    
    <div class="auth-container">
        <div class="auth-form">
            <h2>WELCOME BACK</h2>
            <?php if(isset($error_message)): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="submit" class="cta-btn">Login</button>
            </form>
            <p>Don't have an account? <a href="signup.html">Sign up</a></p>
        </div>
        <div class="auth-image">
            <img src="8.jpg" alt="Background image">
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>