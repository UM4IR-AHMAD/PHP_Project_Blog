<?php
    include "dbConnection.php";

    // echo "<pre>", print_r($_POST), "</pre>";

    // mysqli_real_escape_string() it is use to check not any special charaters in input. Same check JS code is not input.
    $userID = $_REQUEST['userID'];
    $FirstName = mysqli_real_escape_string($dbConnection, $_REQUEST['firstName']);
    $LastName =  mysqli_real_escape_string($dbConnection, $_REQUEST['lastName']);
    $UserName =  mysqli_real_escape_string($dbConnection, $_REQUEST['userName']);
    $Role =  mysqli_real_escape_string($dbConnection, $_REQUEST['role']);

    // if DB column not use unique constrant: checking username duplicate

    // old way to check
    /* $sqlQuery = "SELECT username FROM user";
    $dbReteriveData = mysqli_query($dbConnection, $sqlQuery) or die("Sql USERNAME query faulty");

    if(mysqli_num_rows($dbReteriveData) > 0){
        while ($entry = mysqli_fetch_assoc($dbReteriveData))
        {
            if (strtolower($UserName) == strtolower($entry['username'])) {
                echo "<h3>username is already in use</h3>";
                $UserName = "noName";
            }
        }
    } */



    // new and better way
    $sqlQuery = "SELECT user_id FROM user WHERE username = '{$UserName}'";
    $dbReteriveData = mysqli_query($dbConnection, $sqlQuery) or die("Sql USERNAME query faulty");
    
    if(mysqli_num_rows($dbReteriveData) > 0){
        $dbUserID = mysqli_fetch_assoc($dbReteriveData);
        // check duplicate of username 
        if ($userID != $dbUserID['user_id']) {
            echo "<h3>username is already in use</h3>";
        }else {
            Goto update;
            }
    }else {
        update:
          // update existing row
          $sqlQuery = "UPDATE user SET first_name = '$FirstName',  last_name = '$LastName',  username = '$UserName',  role = '$Role'  
          WHERE user_id = $userID";        
          mysqli_query($dbConnection, $sqlQuery) or die( "<h3> Sql INSERT query faulty or it is not accepting duplicate entry in UNIQUE COLUMN </h3>");        
  
    }
    
    

    mysqli_close($dbConnection);
    header("Location: http://localhost/PHP/Projects/Practice/News-Site/admin/users.php");


?>