<?php include ('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1><br><br>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Type your name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php 
if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];//displaying session message
    unset($_SESSION['add']);//removing message after a few seconds
}
?>

<?php include ('partials/footer.php')?>

<?php
//Process the value from form and save it in database
//checking if the button is clicked or not
if(isset($_POST['submit']))
{
    //Button clicked
      $full_name = $_POST['full_name'];
      $username = $_POST['username'];
      $password = md5($_POST['password']);//Password encryption with md5

      //SQL Query
      $sql="INSERT INTO tbl_admin SET 
         full_name='$full_name',
         username='$username',
         password='$password'
         "; 

    //Executing query and save data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //check whether data is inserted and display appropriate message
    if($res==TRUE)
    {
        //Data inserted
        //SEssion variable
        $_SESSION['add']= "Admin added successfully";
        //Redirect page
        header("Location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Data not inserted
        //SEssion variable
        $_SESSION['add']= "Failed to add admin";
        //Redirect page
        header("Location:".SITEURL.'admin/add-admin.php');
    }

}


?>