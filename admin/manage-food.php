<?php include('../config/constants.php');
      include('login-check.php');
?>
<html>
    <head>
<title>Food order website - homepage</title>
        
<link rel="stylesheet" href="../css/admin.css">
        
    </head>
    <body>
<!--menu section starts-->
<div class="menu text-center">
    <div class="wrapper">
      <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="manage-admin.php">Admin</a></li>
          <li><a href="manage-category.php">Category</a></li>
          <li><a href="manage-food.php">Food</a></li>
          <li><a href="manage-order.php">Order</a></li>
          <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
    </div>
<!--menu section ends-->
        
<!--main section starts-->
<div class="main-content">
    <div class="wrapper">
      <h1>manage food</h1> 
        
        <br>
        <!-- Button to add admin -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br>
        <br>
        
        <?php 
        
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        if(isset($_SESSION['unauthorised']))
        {
            echo $_SESSION['unauthorised'];
            unset($_SESSION['unauthorised']);
        }
        
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
        ?>
        
         <table class="tbl-full">
        <tr> 
             <th>S.N</th>
             <th>Title</th>
             <th>Price</th>
             <th>Image</th>
             <th>Featured</th>
             <th>Active</th>
             <th>Actions</th>
        </tr>
             
            <?php 
             
                //create sql query to get all the food 
                $sql = "SELECT * FROM tbl_food";
             
                //execute the query 
                $res = mysqli_query($conn, $sql);
                
                //count rows to check if we have foods or not
                $count = mysqli_num_rows($res);
                
                //create serial number wariable and set default value as 1
                $sn=1;
             
                if($count>0)
                {
                    //we have food in database
                    //get the foods from db and display
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get value from individual column
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        
                        ?>
                
                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $title; ?></td>
                        <td>$<?php echo $price; ?></td>
                        <td>
                            <?php 
                                //check whether we have image or not 
                                if($image_name=="")
                                {
                                    //we do not have image, display error message
                                    echo "<div class='error'>No Image</div>";
                                }
                                else
                                {
                                    //we have image, display image
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="80">
                                    <?php
                                    
                                }
                            ?>
                        </td>  
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                    
                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                        </td>
                    </tr>  
               
                        <?php
                    }
                }
                else
                {
                    //food not added in database 
                    echo "<tr> <td colspan='7' class='error'> Food not Added yet.</td> </tr>";
                } 
             
             ?> 
            
            
            
        </table>
    </div>       
</div>
<!--main section ends-->
        
<!--footer section starts-->
<div class="footer">
   <div class="wrapper">
    <p class="text-center">&copy; 2021 Goan Spice, Wembley - Takeaway</p>
    </div> 
</div>
<!--footer section ends-->
        
    </body>    
</html>