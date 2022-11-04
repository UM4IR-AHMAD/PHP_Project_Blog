<?php
    include "dbConnection.php";
    $sqlQuery = "SELECT * FROM user WHERE user_id=(SELECT max(user_id) FROM user)";
    $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("sql COUNT query failed");
    $LastRecord = mysqli_fetch_assoc($dbRetrieveData);

    // echo "<pre>".print_r($LastRecord)."</pre>";

    if($_GET['id'] == $LastRecord['user_id']){
        $sqlQuery = "DELETE FROM user WHERE user_id = {$_GET['id']}";
        $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("DELETE Query is failed");
    }
    else {
        $sqlQuery = "DELETE FROM user WHERE user_id = {$LastRecord['user_id']}";
        $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("DELETE Query is failed");

        $sqlQuery = "UPDATE user SET first_name = '{$LastRecord['first_name']}',  last_name = '{$LastRecord['last_name']}',  username = '{$LastRecord['username']}', password = '{$LastRecord['password']}',  role = '{$LastRecord['role']}'  
          WHERE user_id = {$_GET['id']}";    
        $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("DELETE Query is failed");
    }

   
    mysqli_close($dbConnection);
    header("Location: http://localhost/PHP/Projects/Practice/News-Site/admin/users.php");
?>
