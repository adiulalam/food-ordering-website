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
        

 <div class="main-content">
     <div class="wrapper">
         
         <h1>update admin</h1>
         
         <br>
         
         <?php 
         
         include('../config/constants.php');
         
         //1. get the id of selected admin
         $id=$_GET['id'];
         
         //2. create sql query to get the deatils 
         $sql="SELECT * FROM tbl_admin WHERE id=$id";
         
         //execute the query
         $res=mysqli_query($conn, $sql);
         
         //check whether query is executed or not
         if($res==TRUE)
         {
             //check whether the data is available or not
             $count = mysqli_num_rows($res);
             //check whether we have admin data or not
             if($count==1)
             {
                 // get the details
                 //echo "admin available";
                 $row=mysqli_fetch_assoc($res);
                 
                 $full_name = $row['full_name'];
                 $username = $row['username'];
             }
             else
             {
                 //redirect to manage admin page
                 header('location:'.SITEURL.'admin/manage-admin.php');
             }
         }
         
         ?>
         
         <form action="" method="post">
             <table class="tbl-30"> 
                 <tr>
                     <td>Full Name: </td>
                     <td>
                     <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                     </td>
                 </tr>
                 
                 <tr>
                     <td>Username: </td>
                     <td>
                         <input type="text" name="username" value="<?php echo $username; ?>">
                     </td>
                 </tr>
                 
                 <tr>
                     <td colspan="2">
                     <input type="hidden" name="id" value="<?php echo $id; ?>">
                     <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                     </td>
                 </tr>
                 
             </table>
         </form>
         
     </div>     
 </div> 
 
 <?php 
        
        //check whether the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //echo "button clicked";
            //get all the values from form to update
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];
            
            //create a sql query to update admin
            $sql = "UPDATE tbl_admin SET
            full_name = '$full_name',
            username = '$username' 
            WHERE id='$id'
            ";
            
            //execute the query
            $res = mysqli_query($conn, $sql);
            
            //check whether the query is successful or not
            if($res==TRUE)
            {
                //Query executed and admin updated
                $_SESSION['update'] = "Admin updated successfully.";
                //redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else
            {
                //failed to update admin
                $_SESSION['update'] = "failed to update.";
                //redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        
 ?>
      
        
 <!--footer section starts-->
<div class="footer">
   <div class="wrapper">
    <p class="text-center">&copy; 2021 Goan Spice, Wembley - Takeaway</p>
    </div> 
</div>
<!--footer section ends-->


    </body>    
</html>

        