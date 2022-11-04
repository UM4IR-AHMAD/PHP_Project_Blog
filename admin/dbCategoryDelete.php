<?php
    include "dbConnection.php";
    $sqlQuery = "SELECT * FROM category WHERE category_id=(SELECT max(category_id) FROM category)";
    $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("sql COUNT query failed");
    $LastRecord = mysqli_fetch_assoc($dbRetrieveData);

    // echo "<pre>".print_r($LastRecord)."</pre>";

    if($_GET['id'] == $LastRecord['category_id']){
        $sqlQuery = "DELETE FROM category WHERE category_id = {$_GET['id']}";
        $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("DELETE Query is failed");
    }
    else {
        $sqlQuery = "DELETE FROM category WHERE category_id = {$LastRecord['category_id']}";
        $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("DELETE Query is failed");

        $sqlQuery = "UPDATE category SET category_name = '{$LastRecord['category_name']}'
        WHERE category_id = {$_GET['id']}";    
        $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("DELETE Query is failed");
    }

   
    mysqli_close($dbConnection);
    header("Location: http://localhost/PHP/Projects/Practice/News-Site/admin/category.php");
?>
