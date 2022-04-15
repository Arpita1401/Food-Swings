<?php include ('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add food</h1>
        <br><br>


        <?php 
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];//displaying session message
            unset($_SESSION['upload']);//removing message after a few seconds
        }
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];//displaying session message
            unset($_SESSION['add']);//removing message after a few seconds
        }
        ?> 

        <br>

        <form action="" method="post" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" placeholder=" Food Title">
                </td>
            </tr>
            <tr>
                <td>Description:</td>
                <td>
                   <textarea name="description"  cols="50" rows="5" placeholder="Describe your food"></textarea>
                </td>
            </tr>
            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>
            <tr>
                    <td>Add food image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
            </tr>
            <tr>
                <td>Category:</td>
                <td>
                    <select name="category" >

                    <?php 
                    $sql = "SELECT *  FROM tbl_category WHERE  active='yes'";

                    $res = mysqli_query($conn, $sql);

                    $count= mysqli_num_rows($res);

                    if($count >0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id= $row['id'];
                            $title= $row['title'];
                            ?>
                            
                            <option value="<?php echo $id;?>"> <?php echo $title;?></option>
                            
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
                    <td><input type="radio" name="featured" value="yes">YES
                    <input type="radio" name="featured" value="no">NO</td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td><input type="radio" name="active" value="yes">YES
                    <input type="radio" name="active" value="no">NO</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add food" class="btn-secondary">
                    </td>
                </tr>

            
        </table>

        </form>


        <?php
        if(isset($_POST['submit']))
        {
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $category=$_POST['category'];

            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }
            else
            {
                $featured="no";
            }

            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else{
                $active="no";
            }

            if(isset($_FILES['image']['name']))//cct
            {
            //upload image
              $image_name= $_FILES['image']['name'];
        
              if($image_name != "")
              {
        
              //autorename image
              $ext= end(explode('.', $image_name));//get the extension like jpg,png,etc
        
              $image_name = "Food_Name_".rand(0000,9999).'.'.$ext;
        
              $source_path= $_FILES['image']['tmp_name'];
              $destination_path= "../images/food/".$image_name;
        
        
              $upload= move_uploaded_file($source_path, $destination_path);
        
              if($upload == FALSE)
              {
                  $_SESSION['upload']= "<div class='error'>Failed to upload image</div>";
                  header("Location:".SITEURL.'admin/add-food.php');
                  die();
              }
        
        
            }
            }
            else{
                //do nort upload it and set image name value as blank
                $image_name = "";
            }//cct

            $sql1 ="INSERT INTO tbl_food SET 
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured ='$featured',
            active ='$active'
            "; 

            $res1 = mysqli_query($conn, $sql1);

            if($res1 == TRUE)
            {
                //Data inserted
                //SEssion variable
                $_SESSION['add']= "<div class='success'>Food added successfully</div>";
                //Redirect page
                header("Location:".SITEURL.'admin/manage-food.php');
            }
            else
            {
                //Data not inserted
                //SEssion variable
                $_SESSION['add']= "<div class='error'>Failed to add food unfortunately</div>";
                //Redirect page
                header("Location:".SITEURL.'admin/add-food.php');
            }

        }
        
        ?>


    </div>
</div>
<?php include ('partials/footer.php');?>
