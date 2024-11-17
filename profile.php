<?php 
// Start session to check if user is logged in
session_start();
include("php/config.php");

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}

// Get the logged-in user's ID from the session
$user_id = $_SESSION['id'];

// Fetch the user's information from the database
$query = "SELECT Username, email , created_at FROM users WHERE id = '$id'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    // Fetch user data
    $user_data = mysqli_fetch_assoc($result);
} else {
    echo "Error retrieving user data.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Styles from your original code */
        :root {
            --primary-green: #4CAF50;
            --light-green: #E8F5E9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        header {
            background: #fff;
            border-bottom: 1px solid #e1e1e1;
            padding: 20px 0;
            width: 100%;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .logo {
            margin-right: auto;
        }

        nav {
            margin-left: auto;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 50px;
        }

        nav ul li a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }

        .login-btn {
            background-color: #2cb742;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 50px;
        }

        .login-btn:hover {
            background-color: #28a232;
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 2rem auto;
            text-align: center;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #eee;
        }

        .large-profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary-green);
        }

        .profile-info h1 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .profile-info p {
            color: #666;
        }

        .section {
            background: var(--light-green);
            padding: 1.5rem;
            border-radius: 10px;
            transition: transform 0.3s ease;
            margin-top: 1rem;
        }

        .section h2 {
            color: var(--primary-green);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .edit-profile-btn {
            background: var(--primary-green);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .edit-profile-btn:hover {
            background-color: #388E3C;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="logo.png" width="220" height="30" alt="Cloud Gaming">
            </div>
            <nav>
                <ul>
                    <li><a href="index2.html">Features</a></li>
                    <li><a href="purchase.html">Purchase</a></li>
                    <li><a href="profile.html">Profile</a></li>
                    <li><a href="#community">About</a></li>
                </ul>
            </nav>
            <a href="logout.php" class="login-btn">LOGOUT</a>
        </div>
    </header>

    <div class="main-container">
        <div class="profile-card">
            <div class="profile-header">
                <img src="man.png" alt="Profile Picture" class="large-profile-pic">
                <div class="profile-info">
                    <h1><?php echo htmlspecialchars($user_data['Username']); ?></h1>
                    <p>Member</p>
                    <button class="edit-profile-btn">Edit Profile</button>
                </div>
            </div>

            <div class="section">
                <h2><i class="fas fa-user"></i> Username</h2>
                <p>Email: <?php echo htmlspecialchars($user_data['Email']); ?></p>
                <p>Joined: <?php echo htmlspecialchars($user_data['JoinDate']); ?></p>
            </div>
        </div>
    </div>
</body>
</html>
