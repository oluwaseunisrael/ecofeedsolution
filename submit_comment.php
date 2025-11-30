<?php
include "config/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = (int)$_POST['post_id'];
    $author_name = mysqli_real_escape_string($conn, $_POST['name']);
    $comment_text = mysqli_real_escape_string($conn, $_POST['comment']);

    $query = "INSERT INTO comments (post_id, author_name, comment_text) VALUES ($post_id, '$author_name', '$comment_text')";
    mysqli_query($conn, $query);

    // Redirect back to the single post page
    header("Location: single-post.php?id=$post_id");
    exit();
}
?>