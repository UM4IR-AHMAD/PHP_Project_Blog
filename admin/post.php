<?php
    include "header.php";
?>

<main>
    <div class = "main-top">
        <h2>All Posts</h2>
        <a href="postAdd.php">Add Post</a>
    </div>
    <table>
        <thead>
            <th>S.No.</th>
            <th>Title</th>
            <th>Category</th>
            <th>Date</th>
            <th>Author</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>

            <?php
                include "dbConnection.php";

                

                // getting number of records/rows
                $sqlQuery = "SELECT COUNT(*) FROM post";
                if($_SESSION['role'] == 0) $sqlQuery .= " WHERE author = '{$_SESSION['userId']}'";
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
                $Where = "WHERE u.username = '{$_SESSION['username']}'";


                $sqlQuery = "SELECT post_id, title,  c.category_name as categoryname, post_date, u.username as username
                FROM post P JOIN category c ON p.category = c.category_id
                JOIN user u ON p.author = u.user_id";
                if($_SESSION['role'] == 0) $sqlQuery .= " WHERE username = '{$_SESSION['username']}'";
                $sqlQuery .= " ORDER BY p.post_id
                LIMIT $offset, $ShowRecordsPerPage";
                
                $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("sql SELECT query failed");
                if(mysqli_num_rows($dbRetrieveData) > 0)
                {
                    $PostCount =  $offset + 1;
                    while ($EechRow = mysqli_fetch_assoc($dbRetrieveData)) {
            ?>
                <tr>
                    <td>
                        <?php echo  $PostCount; ; ?> 
                    </td>
                    <td>
                        <?php echo  $EechRow['title']; ?> </td>
                    <td>
                        <?php echo  $EechRow['categoryname']; ?>
                     </td>
                     <td>
                        <?php echo  $EechRow['post_date']; ?>
                     </td>
                     <td>
                        <?php echo  $EechRow['username']; ?>
                     </td>
                    <td><a href="postUpdate.php?id=<?php echo $EechRow['post_id']; ?>"><i class='fa fa-edit'></i></a></td>
                    <td><a href="dbPostDelete.php?id=<?php echo $EechRow['post_id']; ?>"><i class='fa fa-trash-o'></i></a></td>
                </tr>
            <?php
                        $PostCount++;
                    }
                }
                else{
                    echo '
                    <tr >
                        <td colspan="7"><h4>no data found</h4></td>
                    </tr>
                    ';
                }
                mysqli_close($dbConnection);
            ?>
        </tbody>
    </table>

    
    <div class = "pagination-container">
        <ul>
            <?php
                if($CurrentPage > 1) echo '<li><a   href="post.php?page='.($CurrentPage - 1).'">Prev</a></li>';                
                for ($i=1; $i <= $NoOfPages ; $i++) {

                    $HighlightPageNumber = "";
                    if ($i == $CurrentPage) {
                        $HighlightPageNumber = "Highlight-Page-Number";
                    }
                    echo '<li><a  class ="'.$HighlightPageNumber.'"  href="post.php?page='.$i.'">'.$i.'</a></li>';
                }
                if($CurrentPage < $NoOfPages) echo '<li><a    href="post.php?page='.($CurrentPage + 1).'">Next</a></li>';
            ?>
        </ul>
    </div>

</main>

<?php
    include "footer.php";
?>