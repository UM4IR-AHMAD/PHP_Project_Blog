<?php
    session_start();
    if (isset($_SESSION['userId'])) {
        header("Location: http://localhost/PHP/Projects/Practice/News-Site/admin/post.php");
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/font-awesome.css">
    <link rel="stylesheet" href="styles/style.css">

</head>
<body>
    
<main id = "login-main">
    <div class = "top">
        <img src="images/news.jpg" alt="">
    </div>

    <form class = "user-update-form"  action="<?php $_SERVER['PHP_SELF']?>" method="POST">  
        
        <div>
            <label for="" name="" >Username</label>
            <input required type="text" name="username" id="" >
        </div>
        <div>
            <label for="" name="" >Passowrd</label>
            <input required type="password" name="password" id="" >
        </div>
        <input type="submit" name = "login" value="Login"><label class="incorrect" for="" name="" ></label>
    </form>
</main>


</body>
</html>


<?php
    include "dbConnection.php";
    if (isset($_REQUEST['login'])) {
        $UserName = mysqli_real_escape_string($dbConnection, $_REQUEST['username']);
        $Passoword = sha1($_REQUEST['password']);

        

        if (empty($UserName) || empty($Passoword)) {
            echo "<script>
            document.querySelector('.incorrect').innerText = 'ALL FIELDS MUST BE ENTERED';
            </script>";
        }
        else {
            $SqlQuery = "SELECT user_id, role FROM user WHERE username = '{$UserName}' AND password = '{$Passoword}'";
            $dbReteriveData = mysqli_query($dbConnection, $SqlQuery) or die("SELECT user_id query failed");
            $dbRecord = mysqli_fetch_assoc($dbReteriveData);
            mysqli_close($dbConnection);
            if ($dbRecord == null) {
                echo '<script > 
                document.querySelector(".incorrect").innerText = "username or password isn\'t correct"; 
                </script>';
            }
            else {

                session_start();
                $_SESSION['userId'] = $dbRecord['user_id'];
                $_SESSION['username'] = $UserName;
                $_SESSION['role'] = $dbRecord['role'];

                // if ($_SESSION['role'] == 1) {
                //     header("Location: http://localhost/PHP/Projects/Practice/News-Site/admin/users.php");
                // }
                header("Location: http://localhost/PHP/Projects/Practice/News-Site/admin/post.php");
            }
        }

        
        
        
    }
?>
