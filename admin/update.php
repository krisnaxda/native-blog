<?php
session_start();
include_once '../includes/database.php';
include_once 'process.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$admin_id = $_SESSION['admin_id'];

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Create a new post object
$post = new Post($db);


if (isset($_GET['id'])) {
    $post->id = $_GET['id'];
    $post->admin_id = $_SESSION['admin_id'];

    if ($post->showone()) {
        // Continue to show the form with the current post data
    } else {
        echo '<script>alert("Post not found."); window.location.href="index.php"</script>';
        exit;
    }
}elseif ($_POST) {
    $post->id = $_POST['id'];
    $post->admin_id = $_SESSION['admin_id'];
    $post->title = $_POST['title'];
    $post->content = $_POST['content'];

    if ($post->update()) {
        echo '<script>alert("Post updated successfully."); window.location.href="index.php"</script>';
    } else {
        echo "Unable to update post.";
    }
    exit;
} else {
    echo "Invalid request.";
    exit;
}

include "../includes/navAdmin.php";
?>
<div class="intro">
  <h1>Create Post</h1>
</div>

<div id="createdashboard">

    <div class="headboard" style="margin-top:-10px;">
        <div>
            <h3 style="color: #fff;">What Happen?</h3> 
        </div>
        <div class="addpost">
            <a href="../admin">Back</a>
        </div>
    </div>
    <form id="postinput" action="update.php" method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($post->id); ?>">
        <div style="margin-top:20px;">
            Title
        </div>
        <div style="margin-bottom:30px;margin-top:10px;">
            <input type="text" name="title" value="<?php echo htmlspecialchars($post->title); ?>">
        </div>
        <div style="margin-top:20px;">
            Content
        </div>
        <div>
            <textarea name="content" id=""><?php echo htmlspecialchars($post->content); ?></textarea>
        </div>
        <div class="submit">
        <button type="submit">Update Post</button>
        </div>
    </form>
</div>
<p style="position: absolute; bottom: 0; left: 0; width: 100%; text-align: center;">© All rights reserved — Native Blog</p>