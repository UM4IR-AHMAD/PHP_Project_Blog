<?php
    include "dbConnection.php";

    // get the data of last record/row 
    $sqlQuery = "SELECT * FROM post WHERE post_id=(SELECT max(post_id) FROM post)";
    $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("Query of get last record info has FAILED");
    $LastRecord = mysqli_fetch_assoc($dbRetrieveData);

    // echo "<pre>".print_r($LastRecord)."</pre>";

    // get the category of require record/row 
    $sqlQuery = "SELECT category, post_img FROM post WHERE post_id={$_GET['id']}";
    $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("Query of get require category id has FAILED");
    $RequireData = mysqli_fetch_assoc($dbRetrieveData);


    // update the require category count of Category Table
    $sqlQuery = "UPDATE category SET post = post - 1 WHERE category_id = {$RequireData['category']}";
    mysqli_query($dbConnection, $sqlQuery) or die("Query of decrease count of require category ha FAILED");

    // remove the require image from the File     
    unlink('dbImages/'.$RequireData['post_img']);

    $sqlQuery = "DELETE FROM post WHERE post_id = {$LastRecord['post_id']};";
    mysqli_query($dbConnection, $sqlQuery) or die("Query: DELETE last record has FAILED");

    if($_GET['id'] != $LastRecord['post_id']){
        $sqlQuery = "UPDATE post 
        SET title = '{$LastRecord['title']}',  description = '{$LastRecord['description']}', category = '{$LastRecord['category']}', post_date = '{$LastRecord['post_date']}',  author = '{$LastRecord['author']}', post_img = '{$LastRecord['post_img']}'  
        WHERE post_id = {$_GET['id']}";
        mysqli_query($dbConnection, $sqlQuery) or die("UPDATE Query has FAILED");
    }

    mysqli_close($dbConnection);
    header("Location: http://localhost/PHP/Projects/Practice/News-Site/admin/post.php");
?>