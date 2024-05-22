<?php
session_start();
include_once '../includes/database.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$admin_id = $_SESSION['admin_id'];


$database = new Database();
$db = $database->getConnection();

if ($db) {
    $query = "SELECT posts.id, posts.admin_id, posts.title, posts.content, posts.date, admin.username 
              FROM posts INNER JOIN admin ON posts.admin_id = admin.id 
              WHERE posts.admin_id = :admin_id ORDER BY date DESC";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":admin_id", $admin_id, PDO::PARAM_INT);
    $stmt->execute();

    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "Koneksi gagal!";
}

include "../includes/navAdmin.php"
?>


<div class="intro">
  <h1>Native-Blog</h1>
</div>

<div class="dashboard">

    <div class="headboard">
        <div>
            <h2 style="color: #fff;">List Artikel Saya</h2> 
        </div>
        <div class="addpost">
            <a href="create.php">+Add Post</a>
        </div>
    </div>
<?php
foreach ($posts as $post) {
?>
    <div class="post-list">
    <div class="post-title"> 
        <h2>
            <?php echo ($post['title']) ?>
        </h2>
        <p style="font-size: 14px;margin-top:-15px;">
        Created on 
        <?php
        $date = date('j F, Y', strtotime($post['date']));
        echo htmlspecialchars($date)
        ?>
        </p>
    </div>
    <div class="but">
      <div class="">
      <a class='update-btn' href='update.php?id=<?php echo $post['id']; ?>'>
        Update
    </a>
      </div>
      <div class="but">
      <button class='delete-btn' data-id='<?php echo $post['id']; ?>'>
        Delete
    </button>
      </div>
    </div>
</div>

</d>
<?php
}
?>
</div>

<p style="position: absolute; bottom: 0; left: 0; width: 100%; text-align: center;">© All rights reserved — Native Blog</p>
<!-- Modal Delete -->
<div id="deleteModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Are you sure you want to delete this post?</p>
    <button id="confirmDeleteBtn">Yes, Delete</button>
    <button id="cancelDeleteBtn">Cancel</button>
  </div>
</div>

<script type="text/javascript" async src="../includes/modal.js"></script>