<?php
    
    echo "<pre>", print_r($_FILES),"</pre>";


    // handle the image data to store image
    if (isset($_FILES['image'])) {
        $errors = array();
    
        $FileDetails = $_FILES['image'];
        echo "<pre>", print_r($FileDetails),"</pre>";

        $FileName = $FileDetails['name'];
        $FileType = $FileDetails['type'];
        $FileTemprorayName = $FileDetails['tmp_name'];
        $FileSize = $FileDetails['size'];
    

        // check image extention
        // get the extention
        $ExplodeImage = explode('.',  $FileName);
        $FileExtention = strtolower(end($ExplodeImage));
        $RequireExtensions = array("jpeg", "jpg", "png");

        // check file extension match with require extensions
        if (in_array($FileExtention, $RequireExtensions) === false) {
            $errors[] = "This extension file not allowed, Please choose a JPG or PNG file only";
        }

        // chech the size of file/image is less than 2mb
        if ($FileSize > 2097152) {
            $errors[] = "Size of file is greater";
        }

        if (empty($errors) == true) {

            // sir getting issue with extention, I am not using this
            $onlyFileName = basename($FileName); // this will remove the extionsion
             
            // $FileName = date('Ymd') . $FileName; // my approach but same name image can upload on same day
            $FileName = time() . "-" . $FileName;// sir approach

            /* time change issue : sir varibale also changes the time value it different the image name in file and database
            if getting this issue then put this time attach name into another variable */
            
            // below testing mine variable time change issue
            /* echo $FileName . "-" . time() . "<br>";
            $terminate = true;
            $time = time();
            while ($terminate) {
                if (($time) == time()) {
                    $terminate = false;
                }
             }
            echo $FileName . "-" . time() . "<br>";
            die(); */
            
            
            move_uploaded_file($FileTemprorayName, "dbImages/".$FileName);
        }
        else{
            print_r($errors);
            die();
        }
    }

    include "dbConnection.php";
    session_start();

    echo "<pre>", print_r($_REQUEST),"</pre>";
    echo "<pre>", print_r($_SESSION),"</pre>";

    $PostTitle = mysqli_real_escape_string($dbConnection, $_REQUEST['title']);
    $PostDescription = mysqli_real_escape_string($dbConnection, $_REQUEST['description']);
    $PostCategory = mysqli_real_escape_string($dbConnection, $_REQUEST['category']);
    $PostDate = date("d M, Y");
    $PostImage = $FileName;
    $PostAuthor = $_SESSION['userId'];


    // first get the count of rows
    $SqlQuery = "SELECT COUNT(*) AS count_of_rows FROM post";
    $dbNumberOfRows = mysqli_query($dbConnection, $SqlQuery);
    $dbNumberOfRows = mysqli_fetch_assoc($dbNumberOfRows)["count_of_rows"];

    // set the auto increment of the table
    $SqlQuery = "ALTER TABLE post AUTO_INCREMENT = {$dbNumberOfRows}";
    mysqli_query($dbConnection, $SqlQuery);


    // insert a row in post table and increase the count of category in single query
    // uses mysqli_multi_query to run two query once.

    // try this way to write query
    // "INSERT INTO post(title, description, category, post_date, author, post_img)
    // VALUE ('".$PostTitle."', '".$PostDescription."', '".$PostCategory."', '".$PostDate."', '".$PostAuthor."', '".$PostImage."')";

    $SqlQuery = "INSERT INTO post(title, description, category, post_date, author, post_img)
    VALUE ('{$PostTitle}', '{$PostDescription}', {$PostCategory}, '{$PostDate}', {$PostAuthor}, '{$PostImage}');";
    $SqlQuery .= "UPDATE category SET post = post + 1 WHERE category_id = {$PostCategory}";
    mysqli_multi_query($dbConnection, $SqlQuery) or die("INSERT + UPDATE query failed!");
    mysqli_close($dbConnection);
    header("Location: http://localhost/PHP/Projects/Practice/News-Site/admin/post.php");
?>