<?php
    include "header.php";
    include "dbConnection.php";

    $SqlQuery = "SELECT * FROM settings";
    $dbRetrieveData = mysqli_query($dbConnection, $SqlQuery) or die("SELECT * query failed");
    $row = mysqli_fetch_assoc($dbRetrieveData);
    $WebsiteName = $row['websiteName'];
    $WebsiteLogo = $row['logo'];
    $FooterDescription = $row['footerDescription'];


    // updating the settings
    if (isset($_POST['websiteName'])) {
        if (!empty($_FILES['logo']['name'])) {
            $WebsiteLogo = $_FILES['logo']['name'];
        }
        else {
            $WebsiteLogo = $_POST['oldLogo'];
        }

        $WebsiteName = mysqli_real_escape_string($dbConnection, $_POST['websiteName']);
        $FooterDescription = mysqli_real_escape_string($dbConnection, $_POST['footerDescription']);

        $SqlQuery = "UPDATE settings SET websiteName = '{$WebsiteName}', logo = '{$WebsiteLogo}', footerDescription = '{$FooterDescription}'";
        mysqli_query($dbConnection, $SqlQuery) OR die("Failed Query: UPDATE settings");
        mysqli_close($dbConnection);
    }
?>

<main id = "setting-main">
    <div class = "main-top">
        <h2>Update Post</h2>
    </div>

    <form  action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" enctype="multipart/form-data">
        <div>
            <label for="" name="" >Website Name</label>
            <input type="text" name="websiteName" id="" value="<?php echo $WebsiteName; ?>">
        </div>
        <div>
            <label for="" name="" >Website Logo</label>
            <input type="file" name="logo" id="" >
            <div class = "image-container">
                <img src="images/<?php echo $WebsiteLogo; ?>" alt="">
            </div> 
            <input type="hidden" name="oldLogo" id="" value="<?php echo $WebsiteLogo; ?>">
        </div>
        <div>
            <label for="" name="" > Footer Description</label>
            <textarea name="footerDescription" id="" cols="30" rows="8"><?php echo $FooterDescription; ?></textarea>
        </div>
        <input type="submit" value="Save">
    </form>
</main>


<?php
    include "footer.php";
?>

