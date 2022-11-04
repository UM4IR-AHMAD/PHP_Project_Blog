<?php
    include "header.php";
    include "dbConnection.php";

    $SqlQuery = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
    $dbRetrieveData = mysqli_query($dbConnection, $SqlQuery) or die("SELECT query failed");
    $row = mysqli_fetch_assoc($dbRetrieveData);
    $PostTitle = $row['title'];
    $PostDescription = $row['description'];
    $PosCategory = $row['category'];
    $PostImageName = $row['post_img'];
    $PostAuthor = $row['author'];
    mysqli_close($dbConnection);
    if ($PostAuthor == $_SESSION['userId'] || $_SESSION['role'] == 1) {
?>

<main id = "postUpdate-main">
    <div class = "main-top">
        <h2>Update Post</h2>
    </div>

    <form  action="dbPostUpdate.php" method="POST" enctype="multipart/form-data">
        <input hidden type="text" name = "postId" value="<?php echo $_GET['id'];?>">
        <div>
            <label for="" name="" >Title</label>
            <input type="text" name="title" id="" value="<?php echo $PostTitle; ?>">
        </div>
        <div>
            <label for="" name="" >Description</label>
            <textarea name="description" id="" cols="30" rows="8"><?php echo $PostDescription; ?></textarea>
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
                            $selection = "";
                            if ($row['category_id'] == $PosCategory) {
                                $selection = "selected";
                            }

                            echo "<option ".$selection." value=".$row['category_id']." >".$row['category_name']."</option>";
                        }
                    }
                    mysqli_close($dbConnection);
                ?>
            </select>
        </div>
        <div>
            <label for="" name="" >Post Image</label>
            <input type="file" name="image" id="" >
            <div class = "image-container">
                <img src="dbImages/<?php echo $PostImageName; ?>" alt="">
            </div> 
            <input type="hidden" name="oldImage" id="" value="<?php echo $PostImageName; ?>">
 
        </div>
        <input type="submit" value="Save">
    </form>
    <?php
    }else {
        echo "<h3>No data found</h3>";
    }
    ?>
</main>


<?php
    include "footer.php";
?>