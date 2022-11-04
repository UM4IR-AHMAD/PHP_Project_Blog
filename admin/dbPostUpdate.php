<?php
    
   /*  echo "<pre>", print_r($_FILES),"</pre>";
    echo strcmp($_REQUEST['oldImage'], $_FILES['image']['name']); */
    // handle the image data to store image
    if(!empty($_FILES['image']['name'])) {
        // echo "heloooooooooooooooooooooo";

            // echo "heloooooooooooooooooooooo";

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
                $FileExtention = strtolower(end(explode('.',  $FileName)));
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
                    if (strcmp($_REQUEST['oldImage'], $_FILES['image']['name'])) {
                        unlink("dbImages/".$_REQUEST['oldImage']); 
                    }
                    move_uploaded_file($FileTemprorayName, "dbImages/".$FileName);
                }
            }
        
    }


    include "dbConnection.php";
    session_start();

    // echo "<pre>", print_r($_REQUEST),"</pre>";
    // echo "<pre>", print_r($_SESSION),"</pre>";

    $PostId = $_REQUEST['postId'];
    $PostTitle = mysqli_real_escape_string($dbConnection, $_REQUEST['title']);
    $PostDescription = mysqli_real_escape_string($dbConnection, $_REQUEST['description']);
    $PostCategory = mysqli_real_escape_string($dbConnection, $_REQUEST['category']);
    $PostDate = date("d M, Y");
    $PostImage = $FileName;
    $PostAuthor = $_SESSION['userId'];

    //get the old category value to set the increase/decrease on the post count.
    $SqlQuery = "SELECT category FROM post WHERE post_id = {$PostId}";
    $dbRetrieveData = mysqli_query($dbConnection, $SqlQuery);
    $OldCategory = mysqli_fetch_assoc($dbRetrieveData)['category'];

    $SqlQuery = "UPDATE post SET title = '{$PostTitle}', description = '{$PostDescription}', 
    category = {$PostCategory}, post_date = '{$PostDate}', author = {$PostAuthor}";
    if(!empty($_FILES['image']['name'])) $SqlQuery .= ", post_img = '{$PostImage}'";
    $SqlQuery .= " WHERE post_id = {$PostId};";
    if($OldCategory != $PostCategory){
        $SqlQuery .= "UPDATE category SET post = post - 1 WHERE category_id = {$OldCategory};";
        $SqlQuery .= "UPDATE category SET post = post + 1 WHERE category_id = {$PostCategory}";
    }
    mysqli_multi_query($dbConnection, $SqlQuery) or die("INSERT + UPDATE query failed!");
    mysqli_close($dbConnection);
    header("Location: http://localhost/PHP/Projects/Practice/News-Site/admin/post.php");
?>