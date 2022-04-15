<?php 
include('../config/constants.php');

//destroy session
session_destroy();//destroys user session

//redirect to login page
header('location:'.SITEURL.'admin/login.php');

?>