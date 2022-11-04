<?php
    include "header.php";
?>
  
<div id="main-container">
        <main>
            <?php
                    include "dbConnection.php";
                    $sqlQuery = "SELECT title, description, category, author, post_date, post_img, 
                    c.category_name as categoryname, u.first_name, u.last_name
                    FROM post P JOIN category c ON p.category = c.category_id
                    JOIN user u ON p.author = u.user_id 
                    WHERE p.post_id = {$_GET['post_id']}";
                    
                    $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("sql SELECT query failed");

                    $EechRow = mysqli_fetch_assoc($dbRetrieveData);
                    mysqli_close($dbConnection);
            ?>
            <div class="post-full-view">
            <div class="post-content-container">
            <div class="info">
                            <h3> <a href=""><?php echo $EechRow['title']?></a> </h3>

                            <span>
                                <i class="fa fa-tags" aria-hidden="true"></i>
                                <a href="category.php?cid=<?php echo $EechRow['category'];?>"><?php echo $EechRow['categoryname']?></a>
                            </span>
                            <span>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <a href="author.php?aid=<?php echo $EechRow['author'];?>"><?php echo $EechRow['first_name'] ." ".$EechRow['last_name'] ;?></a>
                        
                            </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <a><?php echo $EechRow['post_date']?></a>
                                </span>
                            </div>
                <div class="post">
                        <div class="image">
                            <a href=""><img src="admin/dbimages/<?php echo $EechRow['post_img']?>" alt=""></a>
                        </div>
                        <p class="description">
                        <?php echo $EechRow['description']?>
                        </p>
                    </div>
                </div>
            </div>            
        </main>
        <div class="search">
            <h4>Search</h4>
            <form action="search.php" method="GET">
                <input type="text" name="search" placeholder="Search..."><input type="submit" value="search">
            </form>
        </div>
        <?php
            // include "search.php";
            include "side.php";
        ?>
      
</div>

<?php
    include "footer.php";
?>