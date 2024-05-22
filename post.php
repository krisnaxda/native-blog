<?php
include_once 'includes/database.php';
include "includes/header.php";
include_once 'admin/process.php';

$database = new Database();
$db = $database->getConnection();

// Class Post 
$post = new Post($db);

if (isset($_GET['id'])) {
    $post->id = $_GET['id'];

    if ($post->show()) {
        // Continue to show the form with the current post data
    } else {
        echo '<script>alert("Post not found."); window.location.href="index.php"</script>';
        exit;
    }
}

$date = date('j F, Y', strtotime($post->date));
?>
<div class="post">
  <h1><?php echo htmlspecialchars($post->title); ?></h1>
  <p>Posted By <?php echo htmlspecialchars($post->username); ?>, on <?php echo htmlspecialchars($date) ?></p>
</div>
<div>
    <?php echo ($post->content); ?>
</div>

<p style="position: absolute; bottom: 0; left: 0; width: 100%; text-align: center;">© All rights reserved — Native Blog</p>