<?php 
    //include connection and access controls
      include('../config/constants.php'); 
      include('login-check.php');

    //echo "page ready!";
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //process to delete 
        //echo "Process to delete";
        //1. get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        
        //2.remove the image if available 
        //check whether the image is available or not
        if($image_name != "")
        {
            //image exists and need to be removed from folder
            //get the image path
            $path = "../images/food/".$image_name;
            
            //remove image file from folder
            $remove = unlink($path);
            
            //check whether image is removed or not
            if($remove==false)
            {
                //failed to remove image
                $_SESSION['upload'] = "<div class='error'>image failed to remove</div>";
                //redirect to manage food
                header('location:'.SITEURL.'admin/manage-food.php');
                //stop the process of deleting food
                die();
            }
        }
        
        //3. delete food from db
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //execute the query 
        $res = mysqli_query($conn, $sql);
        
        //check whether the query is executed or not and check the session message
        if($res==true)
        {
            //food deleted
            $_SESSION['delete'] = "<div class='success'>Food deleted</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            
        }
        else
        {
            //failed to delete food
            $_SESSION['delete'] = "<div class='error'>Food not deleted</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        
        
    }
    else
    {
        //redirect to manage food page
        //echo "redirect";
        $_SESSION['unauthorised'] = "<div class='error'>Unauthorised Access</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>