<?php include('../config/constants.php')?>
<html>
    <head>
        <title>Log in</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="main-content">
            <div class="wrapper">
            <div class="login col-6">
            <h1 class="text-center">Login</h1>
            <br>
            <form action="" method="post" class="text-center">
                Username:
                <input type="text" name="username" placeholder="Username">
                <br><br>
                
                Password:
                <input type="password" name="password" placeholder="Password">
                <br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>
            <br><br>
            <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];//displaying session message
                unset($_SESSION['login']);//removing message after a few seconds
            }
            if(isset($_SESSION['not-loggedin']))
            {
                echo $_SESSION['not-loggedin'];//displaying session message
                unset($_SESSION['not-loggedin']);//removing message after a few seconds   
            }
            ?>
            
        </div>
        <div class="login col-6">
            <h1 class="text-center">Register</h1>
            <br>
            <form action="" method="post" class="text-center">
                Username:
                <input type="text" name="username" placeholder="Username">
                <br><br>
                
                Password:
                <input type="password" name="password" placeholder="Password">
                <br><br>

                <input type="submit" name="submit2" value="Login" class="btn-primary">
            </form>
            <br><br>
            <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];//displaying session message
                unset($_SESSION['login']);//removing message after a few seconds
            }
            if(isset($_SESSION['not-loggedin']))
            {
                echo $_SESSION['not-loggedin'];//displaying session message
                unset($_SESSION['not-loggedin']);//removing message after a few seconds   
            }
            ?>
            
        </div>
        <div class="clear-fix"></div>
            </div>
        </div>
    </body>
</html>


<?php 
if(isset($_POST['submit']))
{
    //process for log in

    //get data from form
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    //create sql query
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password= '$password'";
    //execute query
    $res = mysqli_query($conn,$sql);

    $count= mysqli_num_rows($res);
    if($count == 1)
    {
        $_SESSION['login']= "<div class='success'>Logged in successfully</div>";
        $_SESSION['user']= $username;//to check whether user is logged in or not

        //redirect to dashboard page
        header('location:'.SITEURL.'admin/');


    }
    else{
        $_SESSION['login']= "<div class='error text-center'>Log in failed</div>";
        //redirect to dashboard page
        header('location:'.SITEURL.'admin/login.php');
    }

    
}

//registration form
if(isset($_POST['submit2']))
{
    //process for log in

    //get data from form
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    $sql1 ="INSERT INTO tbl_admin SET 
    username ='$username',
    password ='$password'
    "; 
    $res1 = mysqli_query($conn,$sql1);

    $_SESSION['login']= "<div class='success'>Logged in successfully</div>";
    $_SESSION['user']= $username;//to check whether user is logged in or not

    //redirect to dashboard page
    header('location:'.SITEURL.'admin/');

    
}

?>
