<?php
    session_start();
    if (!isset($_SESSION['userId'])) {
        header("Location: http://localhost/PHP/Projects/Practice/News-Site/admin");
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="styles/font-awesome.css">
    <link rel="stylesheet" href="styles/style.css">

</head>
<body >
    

<header>
        <div class="logo-login">
            <div>
                <a href="">
                    <img src="images/news.jpg" alt="">
                </a>
            </div>
            <div>
                <a  href="#"><?php echo $_SESSION['username']; ?>  |</a>
                <a class = "logout" href="logout.php">Logout</a>
            </div>
             
        </div>
        <nav>
            <a class = "posts" href="post.php">Post</a>
            <?php if ($_SESSION['role'] == 1) { ?>
                <a href="category.php">Category</a>
                <a href="users.php">User</a>
                <a href="settings.php">Settings</a>
            <?php } ?>
        </nav>

    </header>