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
      <h1>manage category</h1>
        
        <br>
        
        <?php 
      include('../config/constants.php'); 
      include('login-check.php');
        
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        
        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        
        if(isset($_SESSION['no-category-found']))
        {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        if(isset($_SESSION['failed to remove']))
        {
            echo $_SESSION['failed to remove'];
            unset($_SESSION['failed to remove']);
        }
            
        ?>
        
       <br>
        <!-- Button to add admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Catergory</a>
        <br>
        <br>
         <table class="tbl-full">
        <tr> 
             <th>S.N</th>
             <th>Title</th>
             <th>Image</th>
             <th>Featured</th>
             <th>Active</th>
             <th>Actions</th>
        </tr>
             
             <?php 
             //Query to get all category from database
             $sql = "SELECT * FROM tbl_category";
             
             //execute query
             $res = mysqli_query($conn, $sql);
             
             //count rows
             $count = mysqli_num_rows($res);
             
             //create serial number variable and assign value as 1 
             $sn=1;
             
             //check whether we have data in database or not 
             if($count>0)
             {
                 //we have data in database
                 //get data and display
                 while($row=mysqli_fetch_assoc($res))
                 {
                     $id = $row['id'];
                     $title = $row['title'];
                     $image_name = $row['image_name'];
                     $featured = $row['featured'];
                     $active = $row['active'];
                     
                     ?>
             
             <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $title; ?></td>
            
            <td>
                <?php
                     //check whether image name is available or not
                     if($image_name!="")
                     {
                         //display image
                         ?>
                         
                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="80px">
                
                         <?php
                     }
                     else
                     {
                         //display the message
                         echo "<div class='error'>No image added</div>";
                     }
                ?>
            </td>
                 
                 
            <td><?php echo $featured; ?></td>
             <td><?php echo $active; ?></td>
            
            <td>
                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                
                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>;" class="btn-danger">Delete Category</a>
            </td>
        </tr>
             
                     <?php 
                 }
             }
             else
             {
                 //we do not have data
                 //we will display the message inside table
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
<!--main section ends-->
        
<!--footer section starts-->
<div class="footer">
   <div class="wrapper">
    <p class="text-center"> &copy; 2021 Goan Spice, Wembley - Takeaway</p>
    </div> 
</div>
<!--footer section ends-->
        
    </body>    
</html>