<?php include ('partials/menu.php');?>

    <!--Main Conetnt start-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Order</h1>
            <br><br>
            <?php
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];//displaying session message
                unset($_SESSION['update']);//removing message after a few seconds
            }
            if(isset($_SESSION['no-food']))
        {
            echo $_SESSION['no-food'];//displaying session message
            unset($_SESSION['no-food']);//removing message after a few seconds
        }
            ?>
            

            <table class="tbl-full">
                <tr>
                    <th>Sl.no</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Order date</th>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>

                <?php 
                
                $sql= "SELECT * FROM tbl_order ORDER BY id DESC";
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
                            $food=$row['food'];
                            $price=$row['price'];
                            $qty=$row['qty'];
                            $total=$row['total'];
                            $order_date=$row['order_date'];
                            $status=$row['status'];
                            $customer_name=$row['customer_name'];
                            $customer_contact=$row['customer_contact'];
                            $customer_email=$row['customer_email'];
                            $customer_address=$row['customer_address'];

                            ?>

                            <tr>
                                <td><?php echo $sn++;?></td>
                                <td><?php echo $food;?></td>
                                <td><?php echo $price;?></td>
                                <td><?php echo $qty;?></td>
                                <td><?php echo $total;?></td>
                                <td><?php echo $order_date;?></td>
                                <td class="success"><?php echo $status;?></td>
                                <td><?php echo $customer_name;?></td>
                                <td><?php echo $customer_contact;?></td>
                                <td><?php echo $customer_email;?></td>
                                <td><?php echo $customer_address;?></td>
                                <td>
                                <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update order</a>
                                </td>
                            </tr>
                            <?php
                        }

                    }
                    else{
                        ?>
                        <tr>
                            <td colspan="12"><div class="error">No  order available</div></td>
                        </tr>
                        <?php
                    }
                
                ?>
                
            </table>

        </div>
    </div>
    <!--Main Content end-->


    <?php include('partials/footer.php');?>