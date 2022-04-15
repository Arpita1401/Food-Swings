<?php include ('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        
        <br><br>
        <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];//displaying session message
            unset($_SESSION['add']);//removing message after a few seconds
        }


        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];//displaying session message
            unset($_SESSION['upload']);//removing message after a few seconds
        }
        ?>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Category title"></td>
                </tr>
                <tr>
                    <td>Select image:</td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="submit" name="submit" value="Add category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

<?php

if(isset($_POST['submit']))
{
    //Button clicked
      $title = $_POST['title'];
      if(isset($_POST['featured']))
      {
        $featured = $_POST['featured'];
      }
      else{
          $featured="no";
      }

      if(isset($_POST['active']))
      {
        $active = $_POST['active'];
      }
      else{
          $active="no";
      }
    //   print_r($_FILES['image']);
    //   die();//breaking the code

    
    if(isset($_FILES['image']['name']))
    {
        //upload image

      $image_name= $_FILES['image']['name'];

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
          header("Location:".SITEURL.'admin/add-category.php');
          die();
      }


    }
    }
    else{
        //do nort upload it and set image name value as blank
        $image_name="";
    }

      //SQL Query
      $sql="INSERT INTO tbl_category SET 
         title='$title',
         image_name='$image_name',
         featured='$featured',
         active='$active'
         "; 

    //Executing query and save data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //check whether data is inserted and display appropriate message
    if($res==TRUE)
    {
        //Data inserted
        //SEssion variable
        $_SESSION['add']= "<div class='success'>Category added successfully</div>";
        //Redirect page
        header("Location:".SITEURL.'admin/manage-category.php');
    }
    else
    {
        //Data not inserted
        //SEssion variable
        $_SESSION['add']= "<div class='error'>Failed to add category</div>";
        //Redirect page
        header("Location:".SITEURL.'admin/add-category.php');
    }

}

        
        ?>

    </div>
</div>

<?php include('partials/footer.php');?>