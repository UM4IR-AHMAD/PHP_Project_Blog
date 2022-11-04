<?php
    include "header.php";
?>

<main>
    <div class = "main-top">
        <h2>Add New Post</h2>
    </div>

    <form  action="dbPostAdd.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="" name="" >Title</label>
            <input type="text" name="title" id="" placeholder="">
        </div>
        <div>
            <label for="" name="" >Description</label>
            <textarea name="description" id="" cols="30" rows="8"></textarea>
        </div>
       
        <div>
            <label for="" name="" >Category</label>
            <select name="category" id="">
                <option  disabled>Select Category</option>
                <?php
                    include "dbConnection.php";
                    $SqlQuery = "SELECT category_id, category_name FROM category";
                    $dbRetrieveData = mysqli_query($dbConnection, $SqlQuery) or die("SELECT query failed!");
                    if (mysqli_num_rows($dbRetrieveData) > 0) {
                        while ($row = mysqli_fetch_assoc($dbRetrieveData)) {
                            echo "<option value=".$row['category_id']." >".$row['category_name']."</option>";
                        }
                    }
                    mysqli_close($dbConnection);
                ?>
            </select>
        </div>
        <div>
            <label for="" name="" >Post Image</label>
            <input type="file" name="image" id="">  
        </div>
        <input type="submit" value="Save">
    </form>
</main>


<?php
    include "footer.php";
?>