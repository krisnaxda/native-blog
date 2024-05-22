<?php
include_once 'includes/database.php';
include "includes/header.html";
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
  <p style="margin-top: -30px;">Posted By <?php echo htmlspecialchars($post->username); ?>, on <?php echo htmlspecialchars($date) ?></p>
</div>
<div style="margin-top: 30px;color: #fff; font-size: 19px">
    <?php echo($post->content); ?>
</div>

</div>
<div class="footer">
    <div class="footer-content">
    © All rights reserved — Native Blog
    </div>
</div>
