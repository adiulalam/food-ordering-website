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
      <h1>manage order</h1>
        <br>
         <table class="tbl-full">
        <tr> 
             <th>S.N</th>
             <th>Full Name</th>
             <th>Username</th>
             <th>Actions</th>
        </tr>
            <tr>
            <td>1. </td>
            <td>Maria Fernandes</td>
            <td>mariafernandes</td>
            <td>
                <a href="" class="btn-secondary">Update Admin</a>
                <a href="" class="btn-danger">Delete Admin</a>
            </td>
            </tr>
            
             <tr>
            <td>2. </td>
            <td>Maria Fernandes</td>
            <td>mariafernandes</td>
            <td>
               <a href="" class="btn-secondary">Update Admin</a>
                <a href="" class="btn-danger">Delete Admin</a>
            </td>
            </tr>
            
             <tr>
            <td>3. </td>
            <td>Maria Fernandes</td>
            <td>mariafernandes</td>
            <td>
                <a href="" class="btn-secondary">Update Admin</a>
                <a href="" class="btn-danger">Delete Admin</a>
            </td>
            </tr>
            
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