<link rel="stylesheet" href="../css/admin.css">

<?php

    //include constants.php file here
    include('../config/constants.php'); 
    include('login-check.php');

    //1. get the ID of the admin to be deleted 
    $id = $_GET['id'];

    //2. create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed successfully 
    if($res==TRUE) 
    {
        //Query executed suceessfully and admin deleted
        //echo "admin deleted";
        //create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin deleted successfully.</div>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //failed to delete admin
        //echo "failed to delete admin";
        
        $_SESSION['delete'] = "<div class='error'>failed to delete admin. try again.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
        
    }

    //3. redirect to manage admin page with message (sucess/error)

?>