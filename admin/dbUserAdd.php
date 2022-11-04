<?php
    include "dbConnection.php";

    // echo "<pre>", print_r($_POST), "</pre>";

    // mysqli_real_escape_string() it is use to check not any special charaters in input. Same check JS code is not input.
    $FirstName = mysqli_real_escape_string($dbConnection, $_REQUEST['firstName']);
    $LastName =  mysqli_real_escape_string($dbConnection, $_REQUEST['lastName']);
    $UserName =  mysqli_real_escape_string($dbConnection, $_REQUEST['userName']);
    // sha1 and md5 use to save password from steal
    $Password =  mysqli_real_escape_string($dbConnection, sha1($_REQUEST['password']));
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
    $sqlQuery = "SELECT username FROM user WHERE username = '{$UserName}'";
    $dbReteriveData = mysqli_query($dbConnection, $sqlQuery) or die("Sql USERNAME query faulty");

    if(mysqli_num_rows($dbReteriveData) > 0){
        echo "<h3>username is already in use</h3>";
    }else {
        // getting the number of rows/entries data in table 
        $sqlQuery = "SELECT COUNT(*) FROM user";
        $dbReteriveData = mysqli_query($dbConnection, $sqlQuery) or die("Sql COUNT query faulty");
        $CountOfEntries = mysqli_fetch_assoc($dbReteriveData);
        $CountOfEntries = $CountOfEntries['COUNT(*)'];

        // set the AUTO_INCREMENT start of table 
        $sqlQuery = "ALTER TABLE user AUTO_INCREMENT = $CountOfEntries";
        mysqli_query($dbConnection,$sqlQuery) or die("sql AUTO_INCREMENT query faulty");
    
        // insert new row/entry data
        $sqlQuery = "INSERT INTO user(first_name, last_name, username, password, role)
                     VALUE ('{$FirstName}','{$LastName}','{$UserName}','{$Password}','{$Role}' )";
        if(mysqli_query($dbConnection, $sqlQuery)){
            header("Location: http://localhost/PHP/Projects/Practice/News-Site/admin/users.php");
        }
        else{
            echo "<h3> Sql INSERT query faulty or it is not accepting duplicate entry in UNIQUE COLUMN </h3>";
        }        
    }
    

    mysqli_close($dbConnection);

?>