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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post->admin_id = $_SESSION['admin_id'];
    $post->title = $_POST['title'];
    $post->content = $_POST['content'];

     // Attempt to create the post
     if ($post->create()) {
        echo '<script>alert("Article successfully sent"); window.location.href="index.php"</script>';
    } else {
        echo "<div>Unable to create post.</div>";
    }
}


include "../includes/navAdmin.php";
?>

<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
  });
</script>

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

    <form id="postinput" action="create.php" method="post">
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
            <textarea name="content" id="textarea"></textarea>
        </div>
        <div class="submit">
        <button type="submit" class="update-btn">Add Post</button>
        </div>
    </form>
</div>

</div>
<div class="footer">
    <div class="footer-content">
    © All rights reserved — Native Blog
    </div>
</div>