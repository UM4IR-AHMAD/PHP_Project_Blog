<?php
    include "header.php";
    include "admin.php";

?>



<main>
    <div class = "main-top">
        <h2>Add User</h2>
    </div>

    <form  action="dbUserAdd.php" method="POST">
        <div>
            <label for="" name="" >First Name</label>
            <input type="text" name="firstName" id="" placeholder="First Name">
        </div>
        <div>
            <label for="" name="" >Last Name</label>
            <input type="text" name="lastName" id="" placeholder="Last Name">
        </div>
        <div>
            <label for="" name="" >User Name</label>
            <input type="text" name="userName" id="" placeholder="Username">
        </div>
        <div>
            <label for="" name="" >Passowrd</label>
            <input type="password" name="password" id="" placeholder="Passowrd">
        </div>
        <div>
            <label for="" name="" >User Role</label>
            <select name="role" id="">
                <option value="0" selected>Normal</option>
                <option value="1" selected>Admin</option>
            </select>
        </div>
        <input type="submit" value="Save">
    </form>
</main>



<?php
    include "footer.php";
?>