<?php include ('partials/menu.php');?>
<div class="main-content">
        <div class="wrapper">
            <h1>Update Order</h1>
            <br><br>

            <?php 
          if(isset($_GET['id']))
          {
              $id= $_GET['id'];

              $sql= "SELECT * FROM tbl_order WHERE id=$id"; 

                $res= mysqli_query($conn,$sql);
                $count= mysqli_num_rows($res);
                if($count == 1)
                {
                    $row= mysqli_fetch_assoc($res);
                    $food= $row['food'];
                    $qty=$row['qty'];
                    $status= $row['status'];
                    $price= $row['price'];
                }
                else
                {
                    $_SESSION['no-food']="<div class='no-details'>No details found</div>";
                    header("Location:".SITEURL.'admin/manage-order.php');
                }
          }
          else{
            header("Location:".SITEURL.'admin/manage-order.php');
          }
          ?>


<form action="" method="post">
    <table class="tbl-30">
        <tr>
            <td>Food name:</td>
            <td>
               <b> <?php echo $food;?></b>
            </td>
        </tr>
        <tr>
            <td>Price:</td>
            <td>
               <b>Rs. <?php echo $price;?></b>
            </td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td>
                <input type="number" name="qty" value="<?php echo $qty;?>">
            </td>
        </tr>
        <tr>
            <td>Status:</td>
            <td>
                <select name="status" >
                    <option <?php if($status == "Ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                    <option <?php if($status == "On delivery"){echo "selected";}?> value="On delivery">On delivery</option>
                    <option <?php if($status == "Delivered"){echo "selected";}?> value="Delivered">Delivered</option>
                    <option <?php if($status == "Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
                </select>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update order" class="btn-secondary">
            </td>
        </tr>

    </table>
</form>



<?php 
        if(isset($_POST['submit']))
        {
            $id=$_POST['id'];
            $price=$_POST['price'];
            $qty=$_POST['qty'];
            $status = $_POST['status'];
            $total=$price * $qty;


            $sql2= "UPDATE tbl_order SET
            qty=$qty,
            total=$total,
            status='$status'
            WHERE id=$id
            ";

            $res2= mysqli_query($conn, $sql2);

            if( $res2==TRUE)
            {
                $_SESSION['update']="<div class='success'>food status and quantity updated</div>";
                header("Location:".SITEURL.'admin/manage-order.php');
            }
            else{
                $_SESSION['update']="<div class='error'>Failed to update </div>";
                header("Location:".SITEURL.'admin/manage-order.php');
            }




        }
        
        
        ?>
        </div>

</div>
<?php include('partials/footer.php');?>