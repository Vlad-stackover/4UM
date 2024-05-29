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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>

<!-- Header -->
<header>
    <div class="logo">
        <a href="index.php"><h1>4UM</h1></a>
    </div>
    <nav>
        <ul>
            <li><a href="signup.php">Sign Up</a></li>
            <?php
                include("database.php");

                $sql = "SELECT username FROM users WHERE id = 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<span style='margin-right: 15px; margin-left: 15px;'>".$row["username"]."</span>";
                    }
                } else {
                    echo "<span style='margin-right: 15px; margin-left: 15px;'>AnonymousUser</span>";
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
                include("database.php");

                // Get the post ID from the URL parameter
                $postId = $_GET['id'];

                // Prepare and execute the query to fetch the post details
                $sql = "SELECT * FROM posts WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $postId);
                $stmt->execute();
                $result = $stmt->get_result();

                // Display the post details
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<h3>Username: ".$row["username"]."</h3>";
                        echo "<h5>".$row["data_created"]."</h5><p>";
                        echo "<h1>Title: " . $row["title"] . "</h1>";
                        echo "<p>" . $row["content"] . "</p>";
                        
                    }
                } else {
                    echo "No post found.";
                }

                $stmt->close();
                $conn->close();
            ?>
        </div>

        <div class="comments">
            <?php
                include("database.php");

                // Fetch comments for the specific post
                $sql = "SELECT * FROM comments WHERE postId = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $postId);
                $stmt->execute();
                $result = $stmt->get_result();

                // Display the comments
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<p><strong>" . $row["username"] . ":</strong> " . $row["content"] . "</p>";
                    }
                } else {
                    echo "No comments yet.";
                }

                $stmt->close();
                $conn->close();
            ?>
        </div>

        <form class="comment_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $postId; ?>" method="post">
            <input type="text" id="username" name="username" placeholder="User Name" required><br><br>
            <textarea id="content" name="content" placeholder="Write your comment..." required></textarea><br><br>
            <input class="submit_btn" type="submit" value="Comment">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include("database.php");

            $username = $_POST['username'];
            $content = $_POST['content'];

            $sql = "INSERT INTO comments (username, content, postId) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $username, $content, $postId);

            if ($stmt->execute()) {
                echo "Comment posted successfully.";
                // Redirect to avoid form resubmission
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
        ?>
    </section>
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
