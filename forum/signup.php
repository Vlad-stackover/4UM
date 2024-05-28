<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4UM</title>
    <!-- External CSS styles -->
    <link rel="stylesheet" href="style.css">

    <script src="script.js"></script>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="logo.ico">


    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body>

    <!-- Header -->
    <header>
        <div class="logo">
            <a href="index.php"><h1>4UM</h1></a>
        </div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Forums</a></li>
                <li><a href="#">Search</a></li>
                
            </ul>
        </nav>
        <div class="create-post-btn">
            <a href="index.php">Back</a>
        </div>
    </header>
    

   

    <form class="create_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">User name:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        

        <label for="title">Password:</label><br>
        <input type="text" id="password" name="password" required><br><br>

        <input class="submit_btn" type="submit" value="Create" required>
        <a href="login.php">or Delete Account</a>
        
        
        
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include("database.php");

            $username = $_POST['username'];
            $password = $_POST['password'];

            // Hashowanie hasła
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                echo "User registered successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
        ?>

    
      
    <!-- Footer -->
    <footer>
        <p><a href="https://github.com/Vlad-stackover">&copy; <script>document.write(new Date().getFullYear());</script> Vlad-Stackover. All rights reserved.</a></p>
        <ul class="social-links">
            <li><a href="https://github.com/Vlad-stackover">Github</a></li>
            <li><a href="https://www.linkedin.com/in/vlad-gruzin-638862305/">LinkedIn</a></li>
            <li><a href="#">Email</a></li>
        </ul>
    </footer>



</body>
</html>