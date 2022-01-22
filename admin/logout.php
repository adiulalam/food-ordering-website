<?php
include('../config/constants.php'); 

    //1. destory sess
    session_destroy(); //unsets $_session[user]

    //2. redirct to login page 
    header('location:'.SITEURL.'admin/login.php');

?>