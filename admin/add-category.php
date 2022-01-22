<?php include('../config/constants.php'); 
      include('login-check.php');
?>
<!-- -->

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
        <h1>Add Category</h1>
        <br> 
        
        <?php 
        
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        
        <br>
<!--add cat form starts -->  
        <form action="" method="post" enctype="multipart/form-data">
        <table class="tbl_30">
          
          <tr>
              <td>Title: </td>
              <td>
                  <input type="text" name="title" placeholder="category title">
              </td>
          </tr>
            
            <tr>
                <td>Select image: </td>
                <td>
                <input type="file" name="image">
                </td>
            </tr>
            
            <tr>
            <td>Featured: </td>
                <td>
                <input type="radio" name="featured" value="Yes"> Yes
                <input type="radio" name="featured" value="No"> No   
                </td>
            </tr>
            
            <tr>
            <td>Active: </td>
                <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                </td>
            </tr>
        
        </table>
        </form>  
<!--add cat form ends -->
        
        <?php 
      include('../config/constants.php'); 
      include('login-check.php');
        
        //Check whether button is clicked
        if(isset($_POST['submit']))
        {
            //echo "clicked";
            
            //get value from category form 
            $title = $_POST['title'];
            
            //for radio input, we need to check whther the button is selected or not
            if(isset($_POST['featured']))
            {
                //get the value from form 
                $featured = $_POST['featured'];
            }
            else
            {
                //set the default 
                $featured = "No";
            }
            
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No";
            }
            
            //CHECK WHETHER THE IMAGE IS SELECTED OR NOT AND SET THE VALUE FOR IMAGE NAME ACCORDINGLY
            //print_r($_FILES['image']);
            
            //die();//break the code here
            
            if(isset($_FILES['image']['name']))
            {
                //upload the image
                //to upload image we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];
                
                
                //upload the image only if image is selected 
                if($image_name != "")
                {
                
                
                //auto rename our image 
                //get the extension of our image (jpg, png, etc) e.g. food1.jpg
                $ext = end(explode('.', $image_name));
                
                //rename the image 
                $image_name = "Food_Category_".rand(000, 999).'.'.$ext; 
                
                $sourced_path = $_FILES['image']['tmp_name'];
                
                $destination_path = "../images/category/".$image_name;
                
                //finally upload image
                $upload = move_uploaded_file($sourced_path, $destination_path);
                
                //check whether image is uploaded or not
                //and if image is not uploaded then we will stop the process and redirect with error message
                if($upload==false)
                {
                    //set message
                    $_SESSION['upload'] = "<div class'error'>failed to upload image</div>";
                    //redirect to add category page 
                    header('location:'.SITEURL.'admin/add-category.php');
                    //stop the process
                    die();
                }
                
                }    
            }
            else
            {
                //dont upload image and set the image name value as blank
                $image_name="";
            }
            
            //2. create sql query to insert category in database
            $sql = "INSERT INTO tbl_category SET 
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
            ";
            
            
            //3. execute the query and save in database 
            $res = mysqli_query($conn, $sql);
            
            //4. check whether the query executed or not and data added or not
            if($res==TRUE)
            {
                //query executed and category added
                $_SESSION['add'] = "<div class='success'>category added</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                
            }
            else
            {
                //failed to add category
                $_SESSION['add'] = "<div class='error'>failed to add category</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/add-category.php');
            }
         }
        
        ?>     
        
    </div>        
</div>   
        
<!--footer section starts-->
<div class="footer">
   <div class="wrapper">
    <p class="text-center">&copy; 2021 Goan Spice, Wembley - Takeaway</p>
    </div> 
</div>
<!--footer section ends-->
        
    </body>    
</html>