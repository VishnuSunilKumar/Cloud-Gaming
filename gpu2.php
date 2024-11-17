<?php 
include("php/config.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {  // Changed from if(isset($_POST['submit']))
    // Retrieve form input values
    $g_user = mysqli_real_escape_string($con, $_POST['username']);
    $g_manu = mysqli_real_escape_string($con, $_POST['manufacturer']);
    $g_model = mysqli_real_escape_string($con, $_POST['model']);
    $memory = mysqli_real_escape_string($con, $_POST['memory']);

    // Check if the username already exists in the database
    $verify_query = mysqli_query($con, "SELECT g_user FROM gpu_spec WHERE g_user='$g_user'");

    if(mysqli_num_rows($verify_query) != 0) {
        echo "<div class='message'>
            <p>This username has already submitted GPU specifications</p>
            </div><br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
    } else {
        $insert_query = "INSERT INTO gpu_spec (g_user, g_manu, g_model, memory) 
                        VALUES ('$g_user', '$g_manu', '$g_model', '$memory')";

        if(mysqli_query($con, $insert_query)) {
            header("Location: games2.html");
            exit();
        } else {
            echo "<div class='message'>
                <p>Error: Could not save GPU specifications. Please try again.</p>
                </div><br>";
        }
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud Gaming GPU Specifications</title>
    
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="logo">
                <img src="logo.png" width="220" height="30" alt="Cloud Gaming">
            </div>
            
            <h1>CPU SPECIFICATIONS</h1>
            <!-- Replace the nested forms with a single form -->
<form action="gpu.php" method="POST">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
    </div>

    <div class="form-group">
        <label for="manufacturer">Manufacturer Name</label>
        <input type="text" id="manufacturer" name="manufacturer" required>
    </div>
    
    <div class="form-group">
        <label for="model">Model</label>
        <input type="text" id="model" name="model" required>
    </div>
    
    <div class="form-group">
        <label for="cores">memory</label>
        <input type="text" id="memory" name="memory" required>
    </div>
    
    <button type="submit">Ready</button>
</form>
        </div>
    </div>
</body>
</html>