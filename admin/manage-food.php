<?php include ('partials/menu.php');?>

    <!--Main Conetnt start-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>
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
        if(isset($_SESSION['no-food']))
        {
            echo $_SESSION['no-food'];//displaying session message
            unset($_SESSION['no-food']);//removing message after a few seconds
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
        <br>
            <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add food</a>
            <br><br>
            
            <table class="tbl-full">
                <tr>
                    <th>Sl.no</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php 
                $sql= "SELECT * FROM tbl_food";
                //Execute query
                $res = mysqli_query ($conn, $sql);
                
                $count= mysqli_num_rows($res);
                $sn=1;
                if($count >0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id= $row['id'];
                        $title=$row['title'];
                        $price= $row['price'];
                        $image_name= $row['image_name'];
                        $featured= $row['featured'];
                        $active= $row['active'];
                        ?>
                        
                        <tr>
                                <td><?php echo $sn++;   ?></td>
                                <td><?php echo $title;  ?></td>
                                <td>Rs.<?php echo $price;  ?></td>


                                <td>
                                    <?php 
                                    
                                    if($image_name!="")
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?> "width="80px">

                                        <?php
                                    }
                                    else
                                    {
                                        echo "No image available";
                                    }
                                    ?>
                                </td>

                                <td> <?php echo $featured;  ?></td>
                                <td><?php echo $active;  ?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update food</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete food</a>
                                </td>
                        </tr>


                        <?php 
                    }

                }
                else{
                    echo "<tr><td colspan='7'><div class='error'>No food added</div></td></tr>";
                }
                ?>

            </table>
        </div>
    </div>
    <!--Main Content end-->


    <?php include('partials/footer.php');?>