
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
      <h1>manage admin</h1> 
        <br />
        
        <?php 
           if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //display message
                unset($_SESSION['add']); //removing session message 
            }
            
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
        
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
         
            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }
        
             if(isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }
        
            if(isset($_SESSION['Change-pwd']))
            {
                echo $_SESSION['Change-pwd'];
                unset($_SESSION['Change-pwd']);
            }
        ?>
        
        <br><br>
        <!-- Button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>
         <table class="tbl-full">
        <tr> 
             <th>S.N</th>
             <th>Full Name</th>
             <th>Username</th>
             <th>Actions</th>
        </tr>
             
             
     <!--php code starts-->        
             
         <?php 
             //query to get all admin 
             $sql = "SELECT * FROM tbl_admin";
             //Execute the query
             $res = mysqli_query($conn, $sql);
             
             //Check whether the query is executed or not
             if($res==TRUE)
             {
                 // COUNT ROWS TO CHECK WHETHER WE HAVE DATA IN DATABASE OR NOT
                 $count = mysqli_num_rows($res); // Function to get all the rows in database
                 
                 $sn=1; //create a variable and assign the value
                 
                 // check the number of rows
                 if($count>0)
                 {
                     //we have data in database
                     while($rows=mysqli_fetch_assoc($res))
                     {
                         //using while loop to get data from database
                         //and while loop will run as long as we have data in database
                         
                         //get individual data
                         $id=$rows['id'];
                         $full_name=$rows['full_name'];
                         $username=$rows['username'];
                         
                         //display the values in our table
                         ?>
             
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">change password</a>
                                
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>
             
             
                         <?php
                         
                     }
                 }
                 else
                 {
                     //we do not have data in database
                 }
                     
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