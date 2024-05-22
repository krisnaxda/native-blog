<?php
session_start();
include_once 'http://localhost/native-blog/includes/database.php';
include_once 'process.php';
include "../includes/navAdmin.php";
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$admin_id = $_SESSION['admin_id'];



$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

if ($_POST) {
    $post->admin_id = $_SESSION['admin_id'];
    $post->title = $_POST['title'];
    $post->content = $_POST['content'];

    if ($post->create()) {
        echo "<div>Post was created.</div>";
    } else {
        echo "<div>Unable to create post.</div>";
    }
}



?>
<div class="intro">
  <h1>Create Post</h1>
</div>

<div id="createdashboard">

    <div class="headboard" style="margin-top:-10px;">
        <div>
            <h3 style="color: #fff;">Lets write..</h3> 
        </div>
        <div class="addpost">
            <a href="../admin">Back</a>
        </div>
    </div>

    <form id="postinput" action="process.php?action=add" method="post">
        <div style="margin-top:20px;">
            Title
        </div>
        <div style="margin-bottom:30px;margin-top:10px;">
            <input type="text" name="title">
        </div>
        <div style="margin-top:20px;">
            Content
        </div>
        <div>
            <textarea name="content" id=""></textarea>
        </div>
        <div class="submit">
        <input type="submit" value="Submit">
        </div>
    </form>
</div>

<p style="position: absolute; bottom: 0; left: 0; width: 100%; text-align: center;">© All rights reserved — Native Blog</p>