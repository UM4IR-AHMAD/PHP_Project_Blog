<?php
    // session_start();
    if ($_SESSION['role'] == 0) {
        header("Location: http://localhost/PHP/Projects/Practice/News-Site/admin/post.php");
    }
?>