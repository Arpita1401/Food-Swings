<?php include ('partials/menu.php');?>

    <!--Main Conetnt start-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            <br><br>
            <a href="add-admin.php" class="btn-primary">Add admin</a>
            <br><br><br>
            <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];//displaying session message
                unset($_SESSION['add']);//removing message after a few seconds
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];//displaying session message
                unset($_SESSION['delete']);//removing message after a few seconds
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];//displaying session message
                unset($_SESSION['update']);//removing message after a few seconds
            }
            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];//displaying session message
                unset($_SESSION['user-not-found']);//removing message after a few seconds
            }
            if(isset($_SESSION['changed']))
            {
                echo $_SESSION['changed'];//displaying session message
                unset($_SESSION['changed']);//removing message after a few seconds
            }
            if(isset($_SESSION['not-changed']))
            {
                echo $_SESSION['not-changed'];//displaying session message
                unset($_SESSION['not-changed']);//removing message after a few seconds
            }
            

             ?>
             
            <br><br>
            

            <table class="tbl-full">
                <tr>
                    <th>Sl.no</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                <?php 
                //query to get all admin 
                $sql= "SELECT * FROM tbl_admin";
                //Execute query
                $res = mysqli_query ($conn, $sql);

                //check whether the query is executed
                if($res == TRUE)
                {
                    //count rows to check whether we have data in database or not
                    $count= mysqli_num_rows($res);//function to get all rows in db

                    $sn=1;//variable to store serial number

                    if($count >0)
                    {
                        //WE have data in db
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            //loop to get all data

                            //GET individual data
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];


                            //display values in table
                            ?>

                <tr>
                    <td><?php echo $sn++;   ?></td>
                    <td><?php echo $full_name;  ?></td>
                    <td><?php echo $username;  ?></td>
                    <td>
                    <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update admin</a>
                    <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete admin</a>
                    <a href="<?php echo SITEURL;?>admin/change-password.php?id=<?php echo $id; ?>" class="btn-primary">Change password</a>

                    </td>
                </tr>
                            <?php
                        }
                    }
                    else{
                        //no data in db
                    }
                }

                ?>
            </table>

        </div>
    </div>
    <!--Main Content end-->


    <?php include('partials/footer.php');?>