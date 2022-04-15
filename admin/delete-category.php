<?php
include ('../config/constants.php');

if(isset($_GET['id']) && isset($_GET['image_name']))

{ 
    $id= $_GET['id'];
    $image_name = $_GET['image_name'];

    if($image_name != "")
    {
        $path= "../images/category/".$image_name;
        $remove = unlink($path);
        if($remove ==  FALSE)
        {
            $_SESSION['remove'] = "<div class='error'>Failed to delete category image</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
            die();
        }
    }
    $sql= "DELETE FROM tbl_category WHERE id= $id";

    $res = mysqli_query($conn, $sql);

    if($res ==TRUE)
{
    //Query executed and admin deleted
    $_SESSION['delete'] = "<div class='success'>Category deleted</div>";
    //redirect to manange-admin page with message
    header('location:'.SITEURL.'admin/manage-category.php');

}
else{
    //failed to delete admin
    $_SESSION['delete'] = "<div class='error'> Failed to delete category</div>";
    header('location:'.SITEURL.'admin/manage-category.php');
}


}
else
{
    header('location:'.SITEURL.'admin/manage-category.php');

}

?>