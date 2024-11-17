<?php 
include("php/config.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {  // Changed from if(isset($_POST['submit']))
    // Retrieve form input values
    $c_user = mysqli_real_escape_string($con, $_POST['username']);
    $c_manu = mysqli_real_escape_string($con, $_POST['manufacturer']);
    $c_model = mysqli_real_escape_string($con, $_POST['model']);
    $cores = mysqli_real_escape_string($con, $_POST['cores']);

    // Check if the username already exists in the database
    $verify_query = mysqli_query($con, "SELECT c_user FROM cpu_spec WHERE c_user='$c_user'");

    if(mysqli_num_rows($verify_query) != 0) {
        echo "<div class='message'>
            <p>This username has already submitted CPU specifications</p>
            </div><br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
    } else {
        $insert_query = "INSERT INTO cpu_spec (c_user, c_manu, c_model, cores) 
                        VALUES ('$c_user', '$c_manu', '$c_model', '$cores')";

        if(mysqli_query($con, $insert_query)) {
            header("Location: gpu1.html");
            exit();
        } else {
            echo "<div class='message'>
                <p>Error: Could not save CPU specifications. Please try again.</p>
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
    <title>Cloud Gaming CPU Specifications</title>
    <!-- Your existing CSS here -->
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="logo">
                <img src="logo.png" width="220" height="30" alt="Cloud Gaming">
            </div>
            
            <h1>CPU SPECIFICATIONS</h1>
            
            <!-- Modified form tag -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
                    <label for="cores">Cores</label>
                    <input type="text" id="cores" name="cores" required>
                </div>
                
                <button type="submit">Ready</button>
            </form>
        </div>
    </div>
</body>
</html>