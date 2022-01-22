<?php
include('../config/constants.php');

//echo "delete";
//check whether the id and image_name value is set or not
if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //get the value and delete 
    //echo "Get value and delete"; 
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    
    //remove the physical image file if available 
    if($image_name != "")
    {
        //image is available. so remove it 
        $path = "../images/category/".$image_name;
        //remove the image 
        $remove = unlink($path);
        
        //if failed to remove image then add an error message and stop the process
        if($remove==true)
        {
            //set the session message 
            $_SESSION['remove'] = "<div class='error'>Failed to Remove category image</div>";
            //redirect to manage category page 
            header('location:'.SITEURL.'admin/manage-category.php');
            //stop the process
            die();
        }
    }
    
    //delete data from database 
    //sql query delete data from database
    $sql = "DELETE FROM tbl_category WHERE id = $id";
    
    //execute the query 
    $res = mysqli_query($conn, $sql);
    
    //check whether data is deleted from db or not
    if($res==true)
    {
        //set success message and redirect 
        $_SESSION['delete'] = "<div class='success'>category deleted successfully</div>";
        //redirect to manage category
        header('location:'.SITEURL.'admin/manage-category.php');
        
    }
    else
    {
        //set fail message and redirect
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Category</div>";
        //redirect to manage category
        header('location:'.SITEURL.'admin/manage-category.php');
    }
       
    
}
else
{
    //redirect to manage category page
    header('location:'.SITEURL.'admin/manage-category.php');
}



?>