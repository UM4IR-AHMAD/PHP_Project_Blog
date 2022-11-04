<?php
       include "header.php";
       include "admin.php";

?>




<main>
    <div class = "main-top">
        <h2>All category</h2>
        <a href="categoryAdd.php">Add category</a>
    </div>
    <table>
        <thead>
            <th>S.No.</th>
            <th>Category Name</th>
            <th>No. of Posts</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>

            <?php
                include "dbConnection.php";

                // getting number of records/rows
                $sqlQuery = "SELECT COUNT(*) FROM category ";
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

                $sqlQuery = "SELECT * FROM category LIMIT $offset, $ShowRecordsPerPage";
                $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("sql SELECT query failed");
                if(mysqli_num_rows($dbRetrieveData) > 0)
                {
                    while ($EechRow = mysqli_fetch_assoc($dbRetrieveData)) {
            ?>
            
                <tr>
                    <td>
                        <?php echo  $EechRow['category_id'] ; ?> 
                    </td>
                    <td>
                        <?php echo  $EechRow['category_name'] ?> </td>
                    <td>
                        <?php echo  $EechRow['post']; ?>
                     </td>
                    <td><a href="categoryUpdate.php?id=<?php echo $EechRow['category_id']; ?>"><i class='fa fa-edit'></i></a></td>
                    <td><a href="dbCategoryDelete.php?id=<?php echo $EechRow['category_id']; ?>"><i class='fa fa-trash-o'></i></a></td>
                </tr>
            <?php
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
                if($CurrentPage > 1) echo '<li><a   href="category.php?page='.($CurrentPage - 1).'">Prev</a></li>';                
                for ($i=1; $i <= $NoOfPages ; $i++) {

                    $HighlightPageNumber = "";
                    if ($i == $CurrentPage) {
                        $HighlightPageNumber = "Highlight-Page-Number";
                    }
                    echo '<li><a  class ="'.$HighlightPageNumber.'"  href="category.php?page='.$i.'">'.$i.'</a></li>';
                }
                if($CurrentPage < $NoOfPages) echo '<li><a    href="category.php?page='.($CurrentPage + 1).'">Next</a></li>';
            ?>
        </ul>
    </div>
    
</main>



<?php
    include "footer.php";
?>