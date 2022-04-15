<?php include ('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update category</h1>
        <br><br>

        <?php 
          if(isset($_GET['id']))
          {
            $id= $_GET['id'];
            $sql= "SELECT * FROM tbl_category WHERE id=$id"; 

            $res= mysqli_query($conn,$sql);
            $count= mysqli_num_rows($res);
            if($count == 1)
            {
                $row= mysqli_fetch_assoc($res);
                $title= $row['title'];
                $current_image= $row['image_name'];
                $featured= $row['featured'];
                $active= $row['active'];

            }
            else
            {
                $_SESSION['no-category']="<div class='error'>No category found</div>";
                header("Location:".SITEURL.'admin/manage-category.php');
            }
          }
          else{
              //redirect to manage category
              header("Location:".SITEURL.'admin/manage-category.php');
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
                <td>Current image:</td>
                <td>
                    <!-- display image -->
                    <?php 

                    if($current_image !="")
                    {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo  $current_image; ?>"  width= "120px">
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
                        <input type="submit" name="submit" value="Update category" class="btn-secondary">
                    </td>
                </tr>
        </table>
        </form>

        <?php 
        if(isset($_POST['submit']))
        {
            $title= $_POST['title'];
            $id=$_POST['id'];
            $current_image=$_POST['current_image'];
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
                    $destination_path= "../images/category/".$image_name;
              
              
                    $upload= move_uploaded_file($source_path, $destination_path);
              
                    if($upload == FALSE)
                    {
                        $_SESSION['upload']= "<div class='error'>Failed to upload image</div>";
                        header("Location:".SITEURL.'admin/manage-category.php');
                        die();
                    }
                    if($current_image!="")
                    { 
                        $path= "../images/category/".$current_image;
                        $remove = unlink($path);
    
                        if($remove ==  FALSE)
                        {
                            $_SESSION['remove'] = "<div class='error'>Failed to remove current image</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
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
       


            $sql2= "UPDATE tbl_category SET
            title= '$title',
            image_name= '$image_name',
            featured= '$featured',
            active= '$active'
            WHERE id=$id
            ";

            $res2= mysqli_query($conn, $sql2);

            if( $res==TRUE)
            {
                $_SESSION['update']="<div class='success'>Category updated</div>";
                header("Location:".SITEURL.'admin/manage-category.php');
            }
            else{
                $_SESSION['update']="<div class='error'>Category failed to update</div>";
                header("Location:".SITEURL.'admin/manage-category.php');
            }




        }
        
        
        ?>
    </div>
</div>


<?php include ('partials/footer.php');?>