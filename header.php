<?php
    include "dbConnection.php";
    $SqlQuery = "SELECT websiteName, logo FROM settings";
    $dbReteriveData = mysqli_query($dbConnection, $SqlQuery);
    $data = mysqli_fetch_assoc($dbReteriveData);
    $websiteName = $data['websiteName'];
    $logo = $data['logo'];

    if (empty($logo)) {
        $logOrName = "<h2>$websiteName</h2>";
    } else {
        $logOrName = "<img src='images/$logo' alt=''>";
    }
    
    
    $PageName = strtolower(basename($_SERVER["PHP_SELF"]));

    switch ($PageName) {
        case 'category.php':
            $SqlQuery = "SELECT category_name FROM category WHERE category_id= {$_GET['cid']}";
            $PageName = "category_name";
            $QueryReady = true;
            break;
        case 'author.php':
            $SqlQuery = "SELECT CONCAT(first_name, ' ', last_name) AS name FROM user WHERE user_id = {$_GET['aid']}";
            $PageName = "name";
            $QueryReady = true;
            break;
        case 'post.php':
            $SqlQuery = "SELECT title FROM post WHERE post_id= {$_GET['post_id']}";
            $PageName = "title";
            $QueryReady = true;
            break;
        case 'search.php':
            $PageName = $_GET['search'];
            $QueryReady = false;
            break;            
        default:
            $PageName = "Home";
            $QueryReady = false;
            break;
    }

    if ($QueryReady) {
        $dbReteriveData = mysqli_query($dbConnection, $SqlQuery) or die("Failed Query: SELECT to gete page name");
        switch ($PageName ) {
            case 'name':
                $PageName = "Post By: " .mysqli_fetch_assoc($dbReteriveData)[$PageName];
                break;
            case 'category_name':
                $PageName = mysqli_fetch_assoc($dbReteriveData)[$PageName] . " News";
                break;
            default:
                $PageName = mysqli_fetch_assoc($dbReteriveData)[$PageName];
                break;
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $PageName?></title>
    <link rel="stylesheet" href="CSS/font-awesome.css">
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    <header>
        <div>
            <a href="index.php"><?php echo $logOrName; ?></a>
        </div>
        <nav>
            <ul>
                <?php
                $SelectedCategoeryId = "";
                        if (isset($_GET['cid'])) {
                            $SelectedCategoeryId = $_GET['cid'];
                        }


                 $SqlQuery = "SELECT category_id, category_name FROM category WHERE post > 0";
                 $dbReteriveData = mysqli_query($dbConnection, $SqlQuery) or die ("Query : SELECT failed");
                 if (mysqli_num_rows($dbReteriveData) > 0) {
                    while($Row = mysqli_fetch_assoc($dbReteriveData)){
                        $active = "";
                        if ($SelectedCategoeryId == $Row['category_id']) {
                            $active = "active";
                        }
                        echo "<li class={$active}> <a href='category.php?cid={$Row['category_id']}'>{$Row['category_name']}</a></li>";
                    }
                 }
                mysqli_close($dbConnection);
                ?>
            </ul>
        </nav>
    </header>
