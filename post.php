<?php

include 'resources/db_config.php';
$conn = connect();
session_start();

//check if a post method has been requested
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //escape special characters, if any
    $text = mysqli_real_escape_string($conn, $_POST['entry']);
    $user = $_SESSION['user_id'];

    $sql = "INSERT INTO posts(post_caption, post_time, post_by) VALUES('$text', NOW(), $user)";

    $query = mysqli_query($conn, $sql);

    if (!$query) {
        echo mysqli_error($conn);
        echo "<script>alert('The post was unsuccessful.')</script>";
    } else {
        exit(header("Location: home.php"));
    }
}