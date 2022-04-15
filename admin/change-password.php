<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change password</h1>
        <br><br>

        <?php 
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td> New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
//check whether the button is clicked or not
if(isset($_POST['submit']))


{
    
    // //get the data from form
    $id= $_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password= md5($_POST['new_password']);
    $confirm_password= md5($_POST['confirm_password']);

    //check wthether the current id and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    //execute query
    $res= mysqli_query($conn, $sql);

    if($res ==TRUE)
    {
        //check whether is available or not
        $count= mysqli_num_rows($res);//function to get all rows in db

        if($count == 1)
        {
            //user exist
            if($new_password == $confirm_password)
            {
                $sql1= "UPDATE tbl_admin SET 
                password= '$new_password'
                WHERE id=$id
                ";
                $res1= mysqli_query($conn, $sql1);

                if($res1== TRUE)
                {
                    
            $_SESSION['changed'] = "<div class='success'>Password changed</div>";
            header("Location:".SITEURL.'admin/manage-admin.php');
                }
                else{
                    
            $_SESSION['not-changed'] = "<div class='error'>Password could not change</div>";
            header("Location:".SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                
            //user does not exist
            $_SESSION['user-not-found'] = "<div class='error'>Incorrect password </div>";
            header("Location:".SITEURL.'admin/manage-admin.php');
            }

        }
        else
        {
            //user does not exist
            $_SESSION['user-not-found'] = "<div class='error'>Incorrect password </div>";
            header("Location:".SITEURL.'admin/manage-admin.php');
        }
    }

}
?>
<?php include ('partials/footer.php');?>