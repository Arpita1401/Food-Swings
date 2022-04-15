<?php include ('partials/menu.php');?>

    <!--Main Conetnt start-->
    <div class="main-content"> 
        <div class="wrapper">
            <h1>Manage Category</h1>
            <br><br>
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add category</a>
            <br><br>
            <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];//displaying session message
            unset($_SESSION['add']);//removing message after a few seconds
        }
        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];//displaying session message
            unset($_SESSION['remove']);//removing message after a few seconds
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];//displaying session message
            unset($_SESSION['delete']);//removing message after a few seconds
        }
        if(isset($_SESSION['no-category']))
        {
            echo $_SESSION['no-category'];//displaying session message
            unset($_SESSION['no-category']);//removing message after a few seconds
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];//displaying session message
            unset($_SESSION['update']);//removing message after a few seconds
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];//displaying session message
            unset($_SESSION['upload']);//removing message after a few seconds
        }
        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];//displaying session message
            unset($_SESSION['remove']);//removing message after a few seconds
        }

        ?>
        <br><br>
            <table class="tbl-full">
                <tr>
                    <th>Sl.no</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php 
                //create category
                $sql= "SELECT * FROM tbl_category";
                //Execute query
                $res = mysqli_query ($conn, $sql);

                    //count rows to check whether we have data in database or not
                    $count= mysqli_num_rows($res);//function to get all rows in db

                    $sn=1;//variable to store serial number

                    if($count >0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id= $row['id'];
                            $title=$row['title'];
                            $image_name= $row['image_name'];
                            $featured= $row['featured'];
                            $active= $row['active'];
                            ?>
                            
                            <tr>
                                    <td><?php echo $sn++;   ?></td>
                                    <td><?php echo $title;  ?></td>

                                    <td>
                                        <?php 
                                        
                                        if($image_name!="")
                                        {
                                            ?>
                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?> "width="100px">

                                            <?php
                                        }
                                        else{
                                            echo "No image available";
                                        }
                                        ?>
                                    </td>

                                    <td> <?php echo $featured;  ?></td>
                                    <td><?php echo $active;  ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete category</a>
                                    </td>
                            </tr>


                            <?php 
                        }

                    }
                    else
                    {
                        ?>

                        <tr>
                            <td colspan="6"><div class="error">No category added</div></td>
                        </tr>
                        <?php
                    }
                ?>
               
            </table>

        </div>
    </div>
    <!--Main Content end-->

    <?php include('partials/footer.php');?>