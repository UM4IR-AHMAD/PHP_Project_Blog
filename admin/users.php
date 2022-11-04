<?php
    include "header.php";
    include "admin.php";

?>




<main>
    <div class = "main-top">
        <h2>All Users</h2>
        <a href="userAdd.php">Add User</a>
    </div>
    <table>
        <thead>
            <th>S.No.</th>
            <th>Full Name</th>
            <th>User Name</th>
            <th>Role</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>

            <?php
                include "dbConnection.php";

                // getting number of records/rows
                $sqlQuery = "SELECT COUNT(*) FROM user ";
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

                $sqlQuery = "SELECT * FROM user LIMIT $offset, $ShowRecordsPerPage";
                $dbRetrieveData = mysqli_query($dbConnection, $sqlQuery) or die("sql SELECT query failed");
                if(mysqli_num_rows($dbRetrieveData) > 0)
                {
                    while ($EechRow = mysqli_fetch_assoc($dbRetrieveData)) {
            ?>
            
                <tr>
                    <td>
                        <?php echo  $EechRow['user_id'] ; ?> 
                    </td>
                    <td>
                        <?php echo  $EechRow['first_name'] .
                         " " . $EechRow['last_name']; ?> </td>
                    <td>
                        <?php echo  $EechRow['username']; ?>
                     </td>
                    <td>
                        <?php 
                            if($EechRow['role'] == 0){
                                echo "Normal";
                            }else{
                                echo "Admin";
                            }
                        ?> 
                    </td>
                    <td><a href="UserUpdate.php?id=<?php echo $EechRow['user_id']; ?>"><i class='fa fa-edit'></i></a></td>
                    <td><a href="dbUserDelete.php?id=<?php echo $EechRow['user_id']; ?>"><i class='fa fa-trash-o'></i></a></td>
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
                if($CurrentPage > 1) echo '<li><a   href="users.php?page='.($CurrentPage - 1).'">Prev</a></li>';                
                for ($i=1; $i <= $NoOfPages ; $i++) {

                    $HighlightPageNumber = "";
                    if ($i == $CurrentPage) {
                        $HighlightPageNumber = "Highlight-Page-Number";
                    }
                    echo '<li><a  class ="'.$HighlightPageNumber.'"  href="users.php?page='.$i.'">'.$i.'</a></li>';
                }
                if($CurrentPage < $NoOfPages) echo '<li><a    href="users.php?page='.($CurrentPage + 1).'">Next</a></li>';
            ?>
        </ul>
    </div>
    
</main>



<?php
    include "footer.php";
?>