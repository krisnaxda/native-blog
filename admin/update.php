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

include "../includes/navAdmin.html";
?>

<div class="intro">
  <h1>Update Post</h1>
</div>
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

function setHeight(fieldId){
    document.getElementById(fieldId).style.height = document.getElementById(fieldId).scrollHeight+'px';
}
setHeight('content');
</script>

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
        <div style="margin-top:20px;">
            <textarea name="content" onkeyup="textAreaAdjust(this)" id="content"  TextMode="MultiLine" onclick="setHeight('content');" onkeydown="setHeight('content');"><?php echo htmlspecialchars($post->content); ?></textarea>
        </div>
        <div class="submit">
        <button type="submit" class="update-btn">Update Post</button>
        </div>
    </form>
</div>
</div>

<div class="footer">
    <div class="footer-content">
    © All rights reserved — Native Blog
    </div>
</div>
