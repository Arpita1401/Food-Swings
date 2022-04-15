<?php 
//check whether user is logged in or not
//authorization
if(!isset($_SESSION['user']))
{
    //user is not logged in
    //redirect to login page
    $_SESSION['not-loggedin']="<div class='error'>Please login first</div>";
    header('location:'.SITEURL.'admin/login.php');
    
}
?>