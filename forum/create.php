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
    

   

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">User name:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="topic">Topic:</label><br>
        <select id="topic" name="topic">
            <option value="COFFEE">COFFEE</option>
            <option value="CARS">CARS</option>
            <option value="GUNS">GUNS</option>
            <option value="HEALTH">HEALTH</option>
            <option value="PROGRAMING">PROGRAMING</option>
            <option value="tech">TECH</option>
        </select><br>
        <br>

        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">Body text:</label><br>
        <input type="text" id="content" name="content"><br><br>
        <input class="submit_btn" type="submit" value="Post" required>
        
        
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("database.php");
    
        
    
        $username = $_POST['username'];
        $topic = $_POST['topic'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        
    
        $sql = "INSERT INTO posts(username, topic, title, content)
        VALUES ('$username', '$topic', '$title', '$content')";
    
        if ($conn->query($sql) === TRUE) {
            echo "Post was added sucesfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    ?>
      
    <!-- Footer -->
    <footer>

        <p></p><a href="https://github.com/Vlad-stackover">&copy; <script>document.write(new Date().getFullYear());</script> Vlad-Stackover. All rights reserved.</a></p>
        <ul class="social-links">
            <li><a href="#">Github</a></li>
            <li><a href="#">LinkedIn</a></li>
            <li><a href="#">Email</a></li>
        </ul>
        
    </footer>



</body>
</html>