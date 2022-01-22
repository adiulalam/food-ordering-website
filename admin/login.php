<?php include('../config/constants.php'); 

?>

<html>
<head> 
    <title>login - system</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
    <body>
    
        <div class="login">
        <h1 class="text-center">login</h1>
            <br>
            <?php
            
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login']; //display message
                unset($_SESSION['login']); //removing session message 
            }
            
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            
            ?>
        
            <br> <br>
           
            <!--login start -->
            <form action="" method="post" class="text-center">
            Username:
                <input type="text" name="username" placeholder="enter username">
                <br> <br>
            Password:
                <input type="password" name="password" placeholder="enter password">
            <br> <br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            
            </form>
            <br>
            <!--login ends -->
            
            <p class="text-center">created by <a href="#">Goan Spice</a></p>
        </div>
    
    </body>
</html>

<?php 
include('../config/constants.php'); 
//CHECK IF SUBMIT BUTTON IS CLICKED
    if(isset($_POST['submit']))
    {
        //process login
        //get the data from login form 
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        
        //sql to check if the user with username and pass exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        
        //execute the query
        $res = mysqli_query($conn, $sql);
        
        //count rows users exists or not
        $count = mysqli_num_rows($res);
        
        if($count==1)
        {
            //user available and logged in
            $_SESSION['login'] = "<div class='success'>Login Success.</div>";
            $_SESSION['user'] = $username; //check whether user is logged in and log out is unset it            
            
            //redirect 
            header('location:'.SITEURL.'admin/index.php');
        }
        else
        {
            //user not available and failed
            $_SESSION['login'] = "Login Failed";
            //redirect
            header('location:'.SITEURL.'admin/login.php');
        }
     
    }

?>