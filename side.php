<?php
                    include "dbConnection.php";


                    $sqlQuery = "SELECT post_id, title, category, post_date,  post_img, c.category_name as categoryname, u.username as username
                    FROM post p JOIN category c ON p.category = c.category_id
                    JOIN user u ON p.author = u.user_id";
                    $sqlQuery .= " ORDER BY p.post_id DESC LIMIT 3";
                    
                    $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("sql SELECT query failed");

                ?>

<div class="side">
            <h4>Recents Posts</h4>
            <?php
                if(mysqli_num_rows($dbRetrieveData) > 0)
                {
                    while ($EechRow = mysqli_fetch_assoc($dbRetrieveData)) {
            ?>
            <div class="post-small-view">
                <div class="post">
                <div class="image">
                        <a href="post.php?post_id=<?php echo $EechRow['post_id'];?>"><img src="admin/dbimages/<?php echo $EechRow['post_img']?>" alt=""></a>
                    </div>
                    <div class="post-content-container">
                    <h5> <a href="post.php?post_id=<?php echo $EechRow['post_id'];?>"><?php echo $EechRow['title']?></a> </h5>
                        <div class="info">
                            <span>
                                <i class="fa fa-tags" aria-hidden="true"></i>
                                <a href="category.php?cid=<?php echo $EechRow['category'];?>"><?php echo $EechRow['categoryname']?></a>
                            </span>
                            <span>
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <a><?php echo $EechRow['post_date']?></a>
                            </span>
                        </div>
                    </div>
                </div>
                <a class="read-more" href="post.php?post_id=<?php echo $EechRow['post_id']?>">Read More</a>
            </div>
            <?php
                    }
                }
                else{
                    echo '<h4>no data found</h4>';
                }
                mysqli_close($dbConnection);
            ?>
</div>

