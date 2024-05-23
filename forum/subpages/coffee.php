<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4UM</title>
    <!-- External CSS styles -->
    <link rel="stylesheet" href="../style.css">


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
        <a href="../index.php"><h1> 4UM</h1></a>
    </div>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Forums</a></li>
            <li><a href="#">Search</a></li>
            
        </ul>
    </nav>
    <div class="create-post-btn">
        <a href="../create.php">Create New Topic</a>
    </div>
</header>

<!-- Main Content -->
<main>

    <!-- List of Topics -->
    <aside class="sidebar">
        <div class="category_div">
            <h1 id="select_category">Category</h1>
            <h3><a href="tech.php">TECH</a></h3>
            <h3><a href="cars.php">CARS</a></h3>
            <h3><a href="guns.php">GUNS</a></h3>
            <h3><a href="coffee.php">COFFEE</a></h3>
            <h3><a href="health.php">HEALTH</a></h3>
            <h3><a href="programing.php">PROGRAMING</a></h3>
            
        </div>
    </aside>
    
    <section class="posts_container">

        <div class="post">

        <?php
            // Include database connection code
            include("../database.php");

            $sql = "SELECT * FROM posts WHERE topic='coffee';";
            $result = $conn->query($sql);

            // Step 3: Fetch the results of the query
            if ($result->num_rows > 0) {
                // Step 4: Display the user data on your webpage
                while($row = $result->fetch_assoc()) {
                    echo "<div class='post-row' onclick=\"window.location.href='post.php?id=" . $row["id"] . "'\" style='cursor:pointer;'>";
                    echo "<h3>" . $row["title"] . "</h3>";
                    echo "<p>" . $row["content"] . "</p>";
                    echo "<p><strong>Topic:</strong> " . $row["topic"] . "</p>";
                    echo "</div><hr>";
                }
            } else {
                echo "0 results";
            }
            $conn->close();
        ?>

        </div>
    </section>

    
</main>

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