<?php
include ('../config/constants.php');

if(isset($_GET['id']) && isset($_GET['image_name']))

{ 
    $id= $_GET['id'];
    $image_name = $_GET['image_name'];

    if($image_name != "")
    {
        $path= "../images/food/".$image_name;
        $remove = unlink($path);
        if($remove ==  FALSE)
        {
            $_SESSION['remove'] = "<div class='error'>Failed to delete image food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
        }
    }
    $sql= "DELETE FROM tbl_food WHERE id= $id";

    $res = mysqli_query($conn, $sql);

    if($res ==TRUE)
{
    //Query executed and admin deleted
    $_SESSION['delete'] = "<div class='success'>Food deleted</div>";
    //redirect to manange-admin page with message
    header('location:'.SITEURL.'admin/manage-food.php');

}
else{
    //failed to delete admin
    $_SESSION['delete'] = "<div class='error'> Failed to delete food</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}


}
else
{
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>