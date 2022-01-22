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
     <h1>Change Password</h1>
     <br> 
     
         <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
         ?>
         
     <form action="" method="post">
       
         <table class="tbl-30">
            <tr>
             <td>Current password: </td>
             <td>
                <input type="password" name="current_password" placeholder="current password">
             </td>
            </tr>
                <tr>
                    <td>New password: </td>
                    <td>
                     <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>
             <tr>
             <td>Confirm password: </td>
                 <td>
                 <input type="password" name="confirm_password" placeholder="confirm password">
                 </td>
             </tr>
             
             <tr>
             <td colspan="2"> 
             <input type="hidden" name="id" value="<?php echo $id; ?>">    
             <input type="submit" name="submit" value="change password" class="btn-secondary">
             </td>
             </tr>
             
         </table>
         
     </form>
     
     </div>
        
 </div>  
 
 <?php 
   
        //check whether submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //echo "button clicked";
            
            //1. get the data from form 
            $id=$_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);
            
            //2. check whether the user with current id and current pass exists or not.
            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
            
            //execute query 
            $res = mysqli_query($conn, $sql);
            
            if($res==TRUE)
            {
                //CHECK WHETHER DATA IS AVAILABLE 
                $count=mysqli_num_rows($res);
                
                if($count==1)
                {
                    //user exists and password can be changed
                    //echo "user found";
                    
                    //check whether new and confirm pass match
                    if($new_password==$confirm_password)
                    {
                        //update password
                        //echo "Matched!";
                        $sql2 = "UPDATE tbl_admin SET 
                        password='$new_password' 
                        WHERE id=$id
                        ";
                        
                        //execute the query 
                        $res2 = mysqli_query($conn, $sql2);
                        
                        //check whether the query is executed or not
                        if($res2==TRUE) 
                        {
                            //SUCCESS MESSAGE 
                            //redirect to manage admin page with error message
                    $_SESSION['Change-pwd'] = "password changed";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                        else
                        {
                            //error message
                    $_SESSION['Change-pwd'] = "password not changed";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-admin.php');
                            
                        }
                        
                    }
                    else
                    {
                    //redirect to manage admin page with error message
                    $_SESSION['pwd-not-match'] = "password did not match";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-admin.php');
                        
                    }
                }
                else
                {
                    //user does not exist set message and redirect
                    $_SESSION['user-not-found'] = "User Not Found";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            
            //3. check whether the new password and confirm password match
            
            //4. change pass if all above is true
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