<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4UM</title>
    <!-- External CSS styles -->
    <link rel="stylesheet" href="style.css">


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
        <a href="index.php"><h1> 4UM</h1></a>
    </div>
    <nav>
        <ul>
            <li><a href="signup.php">Sign Up</a></li>
            <?php
                // Include database connection code
                include("database.php");

                $sql = "SELECT username FROM users WHERE id = 1 ";
                $result = $conn->query($sql);

                // Step 3: Fetch the results of the query
                if ($result->num_rows > 0) {
                    // Step 4: Display the user data on your webpage
                    
                    while($row = $result->fetch_assoc()) {
                        
                        echo $row["username"]. "<span style='margin-right: 15px; margin-left: 15px;'>";
        
                        
                    }
                
                } else {
                    echo "AnonimousUser". "<span style='margin-right: 15px; margin-left: 15px;'>";
                }
                $conn->close();
            ?>
        </ul>
    </nav>
    <div class="create-post-btn">
        <a href="index.php">Back</a>
    </div>
</header>

<!-- Main Content -->
<main>

  
    
    <section class="posts_container">

        <div class="post">

        <?php
            // Include database connection code
            include("database.php");

            // Get the post ID from the URL parameter
            $post_id = $_GET['id'];

            // Prepare and execute the query to fetch the post details
            $sql = "SELECT * FROM posts WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $post_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Display the post details
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<h3> Username: ".$row["username"]. "</h3>";
                    echo "<h5>" .$row["data_created"]. "</h5>";
                    echo "<h1>Title: " . $row["title"] . "</h1>";
                    echo "<p>" . $row["content"] . "</p>";
                    echo "<p>Topic: " . $row["topic"] . "</p>";
                }
            } else {
                echo "No post found.";
            }

            $stmt->close();
            $conn->close();
        ?>


        </div>
    </section>

    <form class="comment_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <!-- <label for="username">User name:</label><br> -->
        <input type="text" id="username" name="username" placeholder="User Name" required><br><br>
        
        <input type="text" id="content" name="content" placeholder="Wrtie more about..."><br><br>

        <input class="submit_btn" type="submit" value="Post" required>
        
        
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("database.php");
    
        
    
        $username = $_POST['username'];
        $content = $_POST['content'];
        
    
        $sql = "INSERT INTO comments(username, content)
        VALUES ('$username', '$content')";
    
       
    
        $conn->close();
    }
    ?>
    <?php
            // Include database connection code
            include("database.php");

            // Get the post ID from the URL parameter
            $post_id = $_GET['id'];

            // Prepare and execute the query to fetch the post details
            $sql = "SELECT * FROM comments";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $post_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Display the post details
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<h3> Username: ".$row["username"]. "</h3>";
                    echo "<h5>" .$row["data_created"]. "</h5>";
                    echo "<h1>Title: " . $row["title"] . "</h1>";
                    echo "<p>" . $row["content"] . "</p>";
                    echo "<p>Topic: " . $row["topic"] . "</p>";
                }
            } else {
                echo "No post found.";
            }

            $stmt->close();
            $conn->close();
        ?>
    
</main>

<!-- Footer -->
<footer>
    <p><a href="https://github.com/Vlad-stackover">&copy; <script>document.write(new Date().getFullYear());</script> Vlad-Stackover. All rights reserved.</a></p>
    <ul class="social-links">
        <li><a href="https://github.com/Vlad-stackover">Github</a></li>
        <li><a href="https://www.linkedin.com/in/vlad-gruzin-638862305/">LinkedIn</a></li>
    </ul>
</footer>



</body>
</html>