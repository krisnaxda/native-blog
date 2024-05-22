<?php
session_start();

include_once '../includes/database.php';

if (isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars(strip_tags($_POST['username']));
    $password =  htmlspecialchars(strip_tags($_POST['password']));

    $query = "SELECT id, username, password FROM admin WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    // $stmt->bindParam(':password', $password); // Note: Store hashed passwords in a real application
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $admin['password'])){
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['username'] = $admin['username'];
            header('Location: index.php');
            exit;
        }else{
            $error = "Wrong Password";
        }
    } else {
        $error = "We can't match any of your username/password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <style>
        .error {
            margin-top: 10px;
            color: red;
            display: none; /* Initially hidden */
        }
    </style>
    <link rel="stylesheet" href="../includes/admin.css">
</head>
<body>
    <div class="login-container">
        <h2>Login Admin</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)): ?>
        <div id="error-message" class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    </div>
</body>
</html>

<script>
        // Show the error message if it exists
        document.addEventListener('DOMContentLoaded', function() {
            var errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.style.display = 'block';
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 5000); // 5000 milliseconds = 5 seconds
            }
        });
    </script>