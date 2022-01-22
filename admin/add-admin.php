<?php
echo 'test';
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
    <h1>Add Admin</h1>
    <br>
      
            <?php 
                if(isset($_SESSION['add'])) //checking whether the session is set or not
                {
                    echo $_SESSION['add']; //display the session message if set
                    unset($_SESSION['add']); //remove session message
                }
            ?>
      
      <form action="" method="POST">
          <br>
            <table class="tbl-30">
          
            <tr>
                <td> Full name:</td>
                <td><input type="text" name="full_name" placeholder="enter your name"></td>
            </tr>
                
                <tr>
                <td> Username:</td>
                <td><input type="text" name="username" placeholder="enter your username"></td>
            </tr>
                
                <tr>
                <td> Password:</td>
                <td><input type="password" name="password" placeholder="enter your password"></td>
            </tr>
                
                <tr>
                <td colspan="2">
                <input type="submit" name="submit" value="Add Admin" class="btn-secondary">   
                </td>
                </tr>
          
            </table>
      
      </form> 
    
  </div>      


</div>        
               
<!--main section ends-->
        
<!--footer section starts-->
<div class="footer">
   <div class="wrapper">
    <p class="text-center">footer content goes here 2020</p>
    </div> 
</div>
<!--footer section ends-->


    </body>    
</html>

<?php
    include('../config/constants.php'); 
   include('login-check.php');
   //process the value from form and save it to database
   
   //check whether the button is clicked or not 
        
   if(isset($_POST['submit']))
   {
       //button clicked
       //echo "button clicked";
       
       //1. get the data form form
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];
       $password = md5($_POST['password']); //password encrption with MDS
       
       //2. sql query to save data into database
       $sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
        ";
       $sql;
    
       //3. executing query and saving data to database
       $res = mysqli_query($conn, $sql) or die(mysql_error());
       
       //4. check whether the (query is executed) data is inserted or not and display appropriate message.
       if($res==TRUE)
       {
           //Data inserted
           //echo "data inserted";
           //create session varible to display message
           $_SESSION['add'] = "Admin added sucessfully";
           //redirect page TO manage admin
           header("location:".SITEURL.'admin/manage-admin.php');
           
       }
       else
       {
           //Failed to insert data
           //echo "failed to insert data";
           //create session varible to display message
           $_SESSION['add'] = "failed to add Admin";
           //redirect page TO add admin
           header("location:".SITEURL.'admin/add-admin.php');
       }
           
   }
  
?>