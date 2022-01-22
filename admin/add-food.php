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
<h1>Add Food</h1>
<br>
    
    <?php 
    
    if(isset($_SESSION['upload']))
    {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
           
    }
    
    
    ?>
    
    <form action="" method="post" enctype="multipart/form-data">
    
        <table class="tbl-30">
        <tr>
        <td>Title: </td>
        <td>
            <input type="text" name="title" placeholder="Title of the Food">
        </td>
        </tr>
            
        <tr>
        <td>Description: </td>
        <td>
            <textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
        </td>
        </tr>
            
        <tr>
        <td>Price: </td>
        <td>
        <input type="number" name="price" placeholder="Enter Food Price">
        </td>
        </tr>
        
        <tr>
        <td>Select Image</td>
        <td>
        <input type="file" name="image">
        </td>
        </tr>
        
        <tr>
        <td>Category: </td>
        <td>
        <select name="category">
            <?php 
        
         //create php cpde to display category from db
         //1 create sql query to get all active categories from db
            $sql = "SELECT  * FROM tbl_category WHERE active='Yes'";
          
            //execute query  
            $res = mysqli_query($conn, $sql);
            
            //count rows to check whether we have category or not
            $count = mysqli_num_rows($res);
            
            //if count is greater than zero, we have category else we do not have category
            if($count>0)
            {
                //we have category
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the details of category
                    $id = $row['id'];
                    $title = $row['title'];
                    ?>
                
                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                    <?php
                }
            
            }
            else
            {
                //we do not have category
                ?>
            <option value="0">No category Found</option>
                <?php   
            }
            
         //2 display on a dropdown   
         
            
            ?>
        
        </select>
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
         <input type="submit" name="submit" value="Add Food" class="btn-secondary">
         </td>
         </tr>
        </table>
        
    </form>
    
    <?php 
    
    //check whether the button is clicked or not
    if(isset($_POST['submit']))
    {
        //add the food in database
        //echo "Works";
        
        //1. get the data from form 
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        
        //check whether radio button for featured and active are checked or not 
        if(isset($_POST['featured']))
        {
            $featured = $_POST['featured'];
        }
        else
        {
            $featured = "No"; //SETTING default value
        }
        
        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }
        else
        {
            $active = 'No'; //default value 
        }
            
        //2. upload the image if selected
        //check whether the select image is clicked or not and uplaod the image only if image is selected 
        if(isset($_FILES['image']['name']))
        {
            //get the details of the slected image
            $image_name = $_FILES['image']['name'];
            
            //check whether image is selected or not and upload image only if selected 
            if($image_name !="")
            {
                //image is selected 
                //a. rename image 
                //get the extension of the slected image eg. jpeg 
                $ext = end(explode('.', $image_name));
                
                //create new name for image 
                $image_name = "Food-Name-".rand(0000,9999).".".$ext; //new image name eg. "Food-Name-765.jpg"
                
                //b. upload image 
                //get the src path and destination path 
                
                // source path is the current location of the image 
                $src=$_FILES['image']['tmp_name'];
                
                //destination path for the image to be uploaded
                $dst = "../images/food/".$image_name;
                
                //finally upload image
                $upload = move_uploaded_file($src, $dst);
                
                //check whether image uploaded or not 
                if($upload==false)
                {
                    //failed to upload image 
                    //redirect to add food page 
                    $_SESSION['upload'] = "<div class='error'>failed to upload image</div>";
                    header('location:'.SITEURL.'admin/add-food.php');
                    //stop process 
                    die();
                }
                
            }
            
        }
        else
        {
            $image_name = ""; //setting default value as blank
        }
        
        //3. insert into database 
        
        //create sql query to save or add food 
        //for numerical value, do not need to pass value inside quotes, only do this for string value 
        $sql2 = " INSERT INTO tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active = '$active'
            
        "; 
        
        //execute the query 
        $res2 = mysqli_query($conn, $sql2);
        
        //check whether data is inserted or not 
        //4. redirect to manage food 
        if($res2 == true)
        {
            //data inserted successfully
            $_SESSION['add'] = "<div class='success'>food added successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //failed to insert data 
            $_SESSION['add'] = "<div class='error'>failed to add food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
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