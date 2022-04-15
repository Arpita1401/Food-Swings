<?php include ('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update food</h1>
        <br><br>

        <?php 
          if(isset($_GET['id']))
          {
            $id= $_GET['id'];
            $sql= "SELECT * FROM tbl_food WHERE id=$id"; 

            $res= mysqli_query($conn,$sql);
            $count= mysqli_num_rows($res);
            if($count == 1)
            {
                $row2= mysqli_fetch_assoc($res);
                $title= $row2['title'];
                $description= $row2['description'];
                $price=$row2['price'];
                $current_image= $row2['image_name'];
                $current_category= $row2['category_id'];    
                $featured= $row2['featured'];
                $active= $row2['active'];

            }
            else
            {
                $_SESSION['no-food']="<div class='error'>No food found</div>";
                header("Location:".SITEURL.'admin/manage-food.php');
            }
          }
          else{
              //redirect to manage category
              header("Location:".SITEURL.'admin/manage-food.php');
          }
        ?>
        <form action="" method="post" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title;?>">
                </td>
            </tr>

            <tr>
                <td>Description:</td>
                <td>
                   <textarea name="description"  cols="50" rows="5" > <?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price" value="<?php echo $price;?>">
                </td>
            </tr>

            <tr>
                <td>Current image:</td>
                <td>
                    <!-- display image -->
                    <?php 

                    if($current_image !="")
                    {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>"  width= "120px">
                        <?php
                    }
                    else
                    {
                        echo "<div class='error'>Image not added</div>";
                    }

                    ?>
                </td>
            </tr>

            <tr>
                <td>New image:</td>
                <td>
                <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <!-- category -->
                <td>Category:</td>
                <td>
                <select name="category" >

                    <?php 
                    $sql5 = "SELECT *  FROM tbl_category WHERE  active='yes'";

                    $res5 = mysqli_query($conn, $sql5);

                    $count= mysqli_num_rows($res5);

                    if($count >0)
                    {
                        while($row=mysqli_fetch_assoc($res5))
                        {
                            $category_id= $row['id'];
                            $category_title= $row['title'];
                            ?>
                            
                            <option <?php if($current_category == $category_id){echo "selected";}?> value="<?php echo $category_id;?>"> <?php echo $category_title;?></option>
                            
                            <?php
                        }
                    
                    }
                    else
                    {
                        ?>
                        <option value="0">No category found</option>
                        <?php
                    }
                    ?>
                    
                    </select>
                </td>
            </tr>

            <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if( $featured =="yes") { echo "checked";}?> type="radio" name="featured" value="yes">YES

                        <input <?php if( $featured =="no") { echo "checked";}?> type="radio" name="featured" value="no">NO
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if( $active =="yes") { echo "checked";}?> type="radio" name="active" value="yes">YES
                        <input <?php if( $active =="no") { echo "checked";}?> type="radio" name="active" value="no">NO
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update food" class="btn-secondary">
                    </td>
                </tr>
        </table>
        </form>

        <?php 
        if(isset($_POST['submit']))
        {
            $title= $_POST['title'];
            $id=$_POST['id'];
            $description= $_POST['description'];
            $price=$_POST['price'];
            $current_image=$_POST['current_image'];
            $category = $_POST['category'];
            $featured= $_POST['featured'];
            $active= $_POST['active'];


            if(isset($_FILES['image']['name']))
            {
                $image_name= $_FILES['image']['name'];
                if($image_name != "")
                {
                    if($image_name != "")
                    {
              
                    //autorename image
                    $ext= end(explode('.', $image_name));//get the extension like jpg,png,etc
              
                    $image_name = "Food_Category_".rand(000,999).'.'.$ext;
              
              
              
                    $source_path= $_FILES['image']['tmp_name'];
                    $destination_path= "../images/food/".$image_name;
              
              
                    $upload= move_uploaded_file($source_path, $destination_path);
              
                    if($upload == FALSE)
                    {
                        $_SESSION['upload']= "<div class='error'>Failed to upload image</div>";
                        header("Location:".SITEURL.'admin/manage-food.php');
                        die();
                    }
                    if($current_image!="")
                    { 
                        $path= "../images/food/".$current_image;
                        $remove = unlink($path);
    
                        if($remove ==  FALSE)
                        {
                            $_SESSION['remove'] = "<div class='error'>Failed to remove current image</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();
                        }
                    }
                   

                  }//

                }
                else
                {
                    $image_name=$current_image;
                }
            }
            else{
                $image_name=$current_image;
            }
       


            $sql2= "UPDATE tbl_food SET
            title= '$title',
            description='$description',
            price=$price,
            image_name= '$image_name',
            category_id= '$category',
            featured= '$featured',
            active= '$active'
            WHERE id=$id
            ";

            $res2= mysqli_query($conn, $sql2);

            if( $res==TRUE)
            {
                $_SESSION['update']="<div class='success'>food updated</div>";
                header("Location:".SITEURL.'admin/manage-food.php');
            }
            else{
                $_SESSION['update']="<div class='error'>Food failed to update</div>";
                header("Location:".SITEURL.'admin/manage-food.php');
            }




        }
        
        
        ?>
    </div>
</div>


<?php include ('partials/footer.php');?>