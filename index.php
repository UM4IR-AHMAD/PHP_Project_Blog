<?php
    include "header.php";
?>

<div id="main-container">
        <main>
            <?php
                    include "dbConnection.php";

                    // getting number of records/rows
                    $sqlQuery = "SELECT COUNT(*) FROM post";
                    $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("sql COUNT query failed");
                    $TotalRecords = mysqli_fetch_assoc($dbRetrieveData)['COUNT(*)'];

                    $ShowRecordsPerPage = 6;
                    // calculate number of pages need
                    $NoOfPages = ceil( $TotalRecords / $ShowRecordsPerPage );

                    // get current page number
                    if (isset($_GET['page'])) {
                        $CurrentPage = $_GET['page'];
                    }
                    else {
                        $CurrentPage = 1;
                    }


                    // calculate offset
                    $offset = ($CurrentPage - 1) * $ShowRecordsPerPage;


                    $sqlQuery = "SELECT *, c.category_name as categoryname
                    FROM post P JOIN category c ON p.category = c.category_id
                    JOIN user u ON p.author = u.user_id";
                    $sqlQuery .= " ORDER BY p.post_id
                    LIMIT $offset, $ShowRecordsPerPage";
                    
                    $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("sql SELECT query failed");
                    if(mysqli_num_rows($dbRetrieveData) > 0)
                    {
                        while ($EechRow = mysqli_fetch_assoc($dbRetrieveData)) {
                ?>
            <div class="post-normal-view">
                <div class="post">
                    <div class="image">
                        <a href="post.php?post_id=<?php echo $EechRow['post_id'];?>"><img src="admin/dbimages/<?php echo $EechRow['post_img']?>" alt=""></a>
                    </div>
                    <div class="post-content-container">
                        <h3> <a href="post.php?post_id=<?php echo $EechRow['post_id'];?>"><?php echo $EechRow['title']?></a> </h3>
                        <div class="info">
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
                        <p class="description">
                        <?php echo substr($EechRow['description'],0,150) . "...";?>
                        </p>
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



<div class = "pagination-container">
                    <ul>
                        <?php
                            if($CurrentPage > 1) echo '<li><a   href="index.php?page='.($CurrentPage - 1).'">Prev</a></li>';                
                            for ($i=1; $i <= $NoOfPages ; $i++) {

                                $HighlightPageNumber = "";
                                if ($i == $CurrentPage) {
                                    $HighlightPageNumber = "Highlight-Page-Number";
                                }
                                echo '<li><a  class ="'.$HighlightPageNumber.'"  href="index.php?page='.$i.'">'.$i.'</a></li>';
                            }
                            if($CurrentPage < $NoOfPages) echo '<li><a    href="index.php?page='.($CurrentPage + 1).'">Next</a></li>';
                        ?>
                    </ul>
            </div>
            
        </main>
            
        <div class="search">
            <h4>Search</h4>
            <form action="search.php" method="GET">
                <input type="text" name="search" placeholder="Search..."><input type="submit" value="search">
            </form>
        </div>
        
        <?php
            include "side.php";
        ?>
</div>

        

<?php
    include "footer.php";
?>