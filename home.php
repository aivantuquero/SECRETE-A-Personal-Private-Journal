<?php

include 'resources/db_config.php';

session_start();

//check if the user is not logged in
if (!isset($_SESSION['user_id']) && !isset($_SESSION['username'])) {
    exit(header("Location: index.php"));
}

$conn = connect();

?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="resources/homestyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Home - Secrete</title>
</head>

<body>
    <!-- nav bar -->
    <nav>
        <a href="home.php"><img src="resources/images/logo.png" alt="Secrete"></a>
        <form action="search.php" method="get">
            <input type="text" class="searchfield" name="searchDate" id="searchfield1" placeholder="Search date 'yyyy-mm-dd'">
            <input type="submit" class="button" style="display:none" value="Search">
        </form>
        <ul>
            <li><a href="logout.php"><i class="bi bi-box-arrow-left bi" style="font-size: 1.5rem"></i></a></li>
            <li><a id="searchbtn"><i class="bi bi-search" style="font-size: 1.5rem"></i></a></li>
        </ul>
    </nav>
    <!-- second search bar for mobile view -->
    <form action="search.php" method="get" style="text-align:center; background-color:var(--tertiary)">
            <input type="text" class="searchfield" name="searchDate" id ="searchfield2" placeholder="Search date 'yyyy-mm-dd'">
            <input type="submit" class="button" style="display:none" value="Search">
    </form>

    <!-- create a post box -->
    <div class="createEntry">
        <form action="post.php" method="post" onsubmit="return validateEntry()">
            <h3>Hi <?php echo $_SESSION['username'] ?>, How's your day?</h3>
            <hr>
            <textarea id ="textField" name="entry" style="resize: vertical; font-size: 18px; max-width: 100%" cols="65" rows="10"></textarea>
            <span id="err" style ="display:none; color:red;">You can't leave the text area empty.</span>
            <input id="postbtn" type="submit" value="Create Post!" name="postEntry">

        </form>
    </div>

    <center><h3 id="recentpost-text">Latest Post</h3></center>
    <!-- Generate 3 recent posts -->
    <?php
        $sql = "SELECT posts.post_caption, posts.post_time, posts.post_by, users.full_name, users.user_id FROM posts JOIN users ON posts.post_by = users.user_id WHERE users.user_id = {$_SESSION['user_id']} ORDER BY post_time DESC LIMIT 3";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            echo mysqli_error($conn);
        }
        //check if there are no posts available
        if (mysqli_num_rows($query) == 0) {
            echo '<div class="postBox">';
            echo '<center>There are no posts available.</center>';
            echo '</div>';
        } else {
            //generate posts box for each row
            while ($row = mysqli_fetch_assoc($query)) {
                echo '<div class="postBox">';

                echo '<div class="post-info">';

                echo '<a class="profilelink" href="profile.php">'. $row['full_name'] . '</a>';

                echo '<span>' . date('h:i:s a m/d/Y', strtotime($row['post_time'])) . '</span>';

                echo '</div>';

                echo '<pre>' . $row['post_caption'] . '</pre>';

                echo '</div>';
            }
        }
    ?>
    <script type="text/javascript" src="resources/main.js"></script>
</body>
</html>