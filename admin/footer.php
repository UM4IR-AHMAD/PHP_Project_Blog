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

<?php
        echo '
        <script type="text/JavaScript" >
                var setBodySize = function (){
                        document.body.style.height = "max-content";                        
                        var bodyHeight = document.body.offsetHeight;
                        var heightof100vh = Math.round(window.innerHeight);

                        if(heightof100vh > bodyHeight){ 
                                document.body.style.height = "100vh";                 
                        }
                }

                setBodySize();
                window.addEventListener("resize", function() {
                        setBodySize();
                });
        </script>
        ';
?>
</body>
</html>