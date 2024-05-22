<?php
session_start();
include_once '../includes/database.php';
include_once 'process.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_GET['id'])) {
    $database = new Database();
    $db = $database->getConnection();

    $post = new Post($db);
    $post->id = $_GET['id'];
    $post->admin_id = $_SESSION['admin_id'];

    if ($post->delete()) {
        echo "Post was deleted successfully.";
    } else {
        echo "Unable to delete post.";
    }
    header('Location: index.php');
    exit;
} else {
    echo "Invalid request.";
}