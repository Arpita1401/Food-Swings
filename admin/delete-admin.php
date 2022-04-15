<?php 
include ('../config/constants.php');

//get the id of admin to be deleted
$id=$_GET['id'];
//cretae and execute sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";
$res=  mysqli_query($conn, $sql);

//checking if query executes successfully or not
if($res ==TRUE)
{
    //Query executed and admin deleted
    $_SESSION['delete'] = "<div class='success'>Admin deleted</div>";
    //redirect to manange-admin page with message
    header('location:'.SITEURL.'admin/manage-admin.php');

}
else{
    //failed to delete admin
    $_SESSION['delete'] = "<div class='error'> Failed to delete admin</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}



?>