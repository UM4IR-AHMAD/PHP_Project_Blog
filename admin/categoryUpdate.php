<?php
        include "header.php";
        include "admin.php";

    include "dbConnection.php";
    $sqlQuery = "SELECT category_name FROM category WHERE category_id = {$_GET['id']}";
    $reterivedData = mysqli_query($dbConnection, $sqlQuery) or die("SELECT Query is failed");
    $row = mysqli_fetch_assoc($reterivedData);
    $categoryID = $_GET['id'];
    $categoryName = $row['category_name'];

    if (isset($_POST['update'])) 
    {
        // mysqli_real_escape_string() it is use to check not any special charaters in input. Same check JS code is not input.
        $categoryID = $_REQUEST['categoryID'];
        $NewCategoryName = mysqli_real_escape_string($dbConnection, $_REQUEST['categoryName']);
        // if DB column not use unique constrant: checking username duplicate

        // new and better way
        $sqlQuery = "SELECT category_id FROM category WHERE category_name = '{$NewCategoryName}'";
        $dbReteriveData = mysqli_query($dbConnection, $sqlQuery) or die("Sql USERNAME query faulty");
        if(mysqli_num_rows($dbReteriveData) > 0){
            $dbCategoryID = mysqli_fetch_assoc($dbReteriveData);
            // check duplicate of username 
            if ($categoryID != $dbCategoryID['category_id']) {
                echo "<h3>Category is already in use</h3>";
            }
            else {
                goto UPDATE;
            }
        }else {
            // update existing row
            $sqlQuery = "UPDATE category SET category_name = '$NewCategoryName'  
            WHERE category_id = $categoryID";        
            mysqli_query($dbConnection, $sqlQuery) or die( "<h3> Sql INSERT query faulty or it is not accepting duplicate entry in UNIQUE COLUMN </h3>");        
            UPDATE:
            header("Location: http://localhost/PHP/Projects/Practice/News-Site/admin/category.php");
        }
    }
    mysqli_close($dbConnection);

?>



<main>
    <div class = "main-top">
        <h2>Modify Category Details</h2>
    </div>

    <form class = "user-update-form"  action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <input hidden type="number" name = "categoryID" value=<?php echo $categoryID; ?>>  
        <div>
            <label for="" name="" >Category Name</label>
            <input type="text" name="categoryName" id="" value="<?php echo $categoryName; ?>">
        </div>
        <input type="submit" name="update" value="Update">
    </form>
</main>



<?php
    include "footer.php";
?>