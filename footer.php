<?php
    include "dbConnection.php";
     $SqlQuery = "SELECT footerDescription FROM settings";
     $dbReteriveData = mysqli_query($dbConnection, $SqlQuery);
     $footerDescription = mysqli_fetch_assoc($dbReteriveData)['footerDescription'];
     mysqli_close($dbConnection);
?>
<footer>
        <span><?php echo $footerDescription;?></span>
    </footer>
</body>
</html>