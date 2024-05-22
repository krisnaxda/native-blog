<?php
include_once 'includes/database.php';
include "includes/header.php";

$database = new Database();
$db = $database->getConnection();

if ($db) {
    $query = "SELECT posts.id, posts.admin_id, posts.title, posts.content, posts.date, admin.username FROM posts INNER JOIN admin ON posts.admin_id = admin.id ORDER BY date DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // foreach ($posts as $post) {
    //     echo "<article>";
    //     echo "<h2>" . htmlspecialchars($post['title']) . "</h2>";
    //     echo "<p>Posted by Admin: " . htmlspecialchars($post['username']) . " on " . htmlspecialchars($post['date']) . "</p>";
    //     echo "<p>" . htmlspecialchars(substr($post['content'], 0, 100)) . "...</p>";
    //     echo "<p><a href='post.php?id=" . $post['id'] . "'>Read more</a></p>";
    //     echo "</article>";
    // }
} else {
    echo "Koneksi gagal!";
}
?>
<div class="intro">
  <h1>Native-Blog</h1>
  <h2>SQL, PHP, JavaScript and everything in between.</h2>
</div>
  
<?php
foreach ($posts as $post) {

    echo "<a href='post.php?id=" . $post['id'] . "' class='post-list'>";
?>

    <div class="post-title">
        <h2>
            <?php echo ($post['title']) ?>
        </h2>
        <p style="font-size: 14px;margin-top:-10px;">
            <?php echo (substr($post['content'], 0, 120)); 
            ?> <b>Read More.</b>
        </p>
    </div>
    <div class="post-date">
        <?php
        $date = date('j F, Y', strtotime($post['date']));
        echo htmlspecialchars($date)
        ?>
    </div>
</a>
<?php } ?>
</div>
<div class="footer">
    <div class="footer-content">
    © All rights reserved — Native Blog
    </div>
</div>
