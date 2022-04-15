<?php include('partials-front/menu.php');?>


<?php
    if(isset($_GET['category_id']))
    {
        $category_id= $_GET['category_id'];
        $sql9="SELECT title FROM tbl_category WHERE id=$category_id";

        $res9= mysqli_query($conn,$sql9);
        $row9=mysqli_fetch_assoc($res9);
        $category_title= $row9['title'];

    }
    else{
        header("Location:".SITEURL.'/categories.php');
        

    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php  
    
    $sql= "SELECT * FROM tbl_food WHERE category_id= '$category_id'";

    $res= mysqli_query($conn,$sql);

    $count= mysqli_num_rows($res);

    if($count  > 0)
    {
        while($row=mysqli_fetch_assoc($res))
        
        {
            $id= $row['id'];
            $title=$row['title'];
            $image_name= $row['image_name'];
            $description = $row['description'];
            $price = $row['price'];

            ?>

                <div class="food-menu-box">
                <div class="food-menu-img">

                <?php 
                if($image_name == "") 
                {
                    echo "<div class='error'>No image available!</div>";
                }
                else
                {
                    ?> 
                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                    <?php
                }

                ?>
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price">Rs. <?php echo $price;?></p>
                    <p class="food-detail">
                    <?php echo $description;?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?food_id= <?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>




            <?php
        }
    }
    else{
        echo "<div class='error'>No such category available!</div>";
    }
    
    
    ?>
    
    
    <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>