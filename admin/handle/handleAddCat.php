<?php
require_once('../../inc/connection.php');
session_start();

if(isset($_POST['addCategory'])){
    $title=htmlspecialchars(trim($_POST['name']));


    $errors=[];
    if(empty($title)){
        $errors[]= "Title is Required";
      }elseif(strlen($title) > 50){
        $errors[]= "Title  Must be Less Than 50 Letters";
      }


      if(empty($errors)){
        $query="insert into categories (`name`) 
        values ('$title')";
        $result=mysqli_query($conn,$query);
           
        if($result){
            $_SESSION['success']="Your Category added successfully";
            header('location:../view/addProduct.php');

        }else{
            $_SESSION['error']="Your Category was not added";
            header('location:../view/addCategory.php');
        }

    }else{
        $_SESSION['errors']=$errors;
        header('location:../view/addCategory.php');
    }



}else{
    header('../view/addCategory.php');
}