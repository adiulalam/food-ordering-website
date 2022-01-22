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

        
<!--main content section starts-->
<div class="main-content">
    <div class="wrapper">
      <h1>Dashboard</h1>
        <br>
        
        <?php
            
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login']; //display message
                unset($_SESSION['login']); //removing session message 
            }
        
        ?>
        
        <br>
        <div class="col-4 text-center">
        <h1>5</h1>
            <br> 
            categories 
        </div>
        
        <div class="col-4 text-center">
        <h1>5</h1>
            <br> 
            categories 
        </div>
        
        <div class="col-4 text-center">
        <h1>5</h1>
            <br> 
            categories 
        </div>
        
        <div class="col-4 text-center">
        <h1>5</h1>
            <br> 
            categories 
        </div>
        
        <div class="clearfix"></div>
        
    </div>       
</div>
<!--main content section ends-->
<!--footer section starts-->
<div class="footer">
   <div class="wrapper">
    <p class="text-center">&copy; 2021 Goan Spice, Wembley - Takeaway</p>
    </div> 
</div>
<!--footer section ends-->
    </body>
</html>

