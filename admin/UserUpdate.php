<?php
    include "header.php";
    include "admin.php";

    include "dbConnection.php";
    $sqlQuery = "SELECT first_name, last_name, username, role FROM user WHERE user_id = {$_GET['id']}";
    $reterivedData = mysqli_query($dbConnection, $sqlQuery) or die("SELECT Query is failed");
    $row = mysqli_fetch_assoc($reterivedData);
    $userID = $_GET['id'];
    $fname = $row['first_name'];
    $lname = $row['last_name'];
    $username = $row['username'];
    $role = $row['role'];
    mysqli_close($dbConnection);

    $normal = "";
    $admin = "";
    if ($role == 0) {
        $normal = "selected";
    }
    else {
        $admin = "selected";

    }
?>



<main>
    <div class = "main-top">
        <h2>Modify User Details</h2>
    </div>

    <form class = "user-update-form"  action="dbUserUpdate.php" method="POST">
        <input hidden type="number" name = "userID" value=<?php echo $userID; ?>>  
        <div>
            <label for="" name="" >First Name</label>
            <input type="text" name="firstName" id="" value="<?php echo $fname; ?>">
        </div>
        <div>
            <label for="" name="" >Last Name</label>
            <input type="text" name="lastName" id="" value="<?php echo $lname; ?>">
        </div>
        <div>
            <label for="" name="" >User Name</label>
            <input type="text" name="userName" id="" value="<?php echo $username; ?>">
        </div>
        <div>
            <label for="" name="" >User Role</label>
            <select name="role" id="">
                <option <?php echo $normal; ?> value="0" >Normal</option>
                <option <?php echo $admin; ?> value="1" >Admin</option>
                <?php
                    // Sir approach
                   /*  if ($role == 1) {
                        echo "<option  value='0' >Normal</option> 
                        <option selected value='1' >Admin</option>";                    }
                    else {
                        echo "<option selected value='0' >Normal</option> 
                        <option  value='1' >Admin</option>";
                    } */
                ?>
            </select>
        </div>
        <input type="submit" value="Update">
    </form>
</main>



<?php
    include "footer.php";
?>