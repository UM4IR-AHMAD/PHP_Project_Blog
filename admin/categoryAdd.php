<?php
        include "header.php";
        include "admin.php";

    if (isset($_GET['categoryName'])) {
        
  

    include "dbConnection.php";

    // echo "<pre>", print_r($_POST), "</pre>";

    // mysqli_real_escape_string() it is use to check not any special charaters in input. Same check JS code is not input.
    $CategoryName = mysqli_real_escape_string($dbConnection, $_GET['categoryName']);
    $Posts =  0;

    // if DB column not use unique constrant: checking username duplicate

    // new and better way
    $sqlQuery = "SELECT category_name FROM category WHERE category_name = '{$CategoryName}'";
    $dbReteriveData = mysqli_query($dbConnection, $sqlQuery) or die("Sql USERNAME query faulty");

    if(mysqli_num_rows($dbReteriveData) > 0){
        echo "<h3>category is already in use</h3>";
    }else {
        // getting the number of rows/entries data in table 
        $sqlQuery = "SELECT COUNT(*) FROM category";
        $dbReteriveData = mysqli_query($dbConnection, $sqlQuery) or die("Sql COUNT query faulty");
        $CountOfEntries = mysqli_fetch_assoc($dbReteriveData);
        $CountOfEntries = $CountOfEntries['COUNT(*)'];

        // set the AUTO_INCREMENT start of table 
        $sqlQuery = "ALTER TABLE category AUTO_INCREMENT = $CountOfEntries";
        mysqli_query($dbConnection,$sqlQuery) or die("sql AUTO_INCREMENT query faulty");

    
        // insert new row/entry data
        $sqlQuery = "INSERT INTO category(category_name, post)
                     VALUE ('{$CategoryName}', '{$Posts}')";
        if(mysqli_query($dbConnection, $sqlQuery)){
            header("Location: http://localhost/PHP/Projects/Practice/News-Site/admin/category.php");
        }
        else{
            echo "<h3> Sql INSERT query faulty or it is not accepting duplicate entry in UNIQUE COLUMN </h3>";
        }        
    }
    

    mysqli_close($dbConnection);
    }
?>



<main>
    <div class = "main-top">
        <h2>Add category</h2>
    </div>

    <form  action="<?php $_PHP_SELF ?>" method="GET">
        <div>
            <label for="" name="" >Category Name</label>
            <input type="text" name="categoryName" id="" placeholder="Category Name">
        </div>
        <input type="submit" value="Save">
    </form>
</main>



<?php
    include "footer.php";
?>