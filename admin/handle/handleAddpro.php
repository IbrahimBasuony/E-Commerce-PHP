<?php
require_once('../../inc/connection.php');
session_start();

if(isset($_POST['addProduct'])){

    //$cat=htmlspecialchars(trim($_POST['cat']));
    $title=htmlspecialchars(trim($_POST['title']));
    $desc=htmlspecialchars(trim($_POST['desc']));
    $price=htmlspecialchars(trim($_POST['price']));
    $quantity=htmlspecialchars(trim($_POST['quantity']));

    // echo $title ;
    // die;

    $image  =$_FILES['image'] ;
    $name=$image['name'];
    $tmp_name=$image['tmp_name'];
    $size=$image['size'];
    $sizeMb=$size / (1024*1024);

    $ext=strtolower(pathinfo($name,PATHINFO_EXTENSION));
    $newname = uniqid() . ".$ext" ;

    $extensions = ['jpg','png','pdf','gif','jpeg','word'];

    $errors=[];

    if(empty($title)){
        $errors[]= "Title is Required";
      }

      if(empty($desc)){
        $errors[]= "Description is Required ";
      }

      if(empty($price)){
        $errors[]= "Price is Required";
      }elseif(! is_numeric($price)){
        $errors[]= "Price  must be numeric";
      }

      if(empty($quantity)){
        $errors[]= "quantity is Required";
      }elseif(! is_numeric($quantity)){
        $errors[]= "quantity  must be numeric";
      }


   if( ! $_FILES['image']['name']){
    $errors[]= "Image is required";
    }elseif(!in_array($ext,$extensions)){
    $errors[]="Image not valid";
    }elseif($sizeMb > 1){
    $errors[]= "Image is more than 1Mb";
    }



    if(empty($errors)){
        $sql="select * from `categories` where `name`='$title'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==1){
           $cat1 = mysqli_fetch_assoc($result);
           $cat_id=$cat1['id'];

           $query= " INSERT INTO `product`( `category_id` ,`title`, `description`, `price`, `quantity`, `img`)
           VALUES ('$cat_id' ,'$title','$desc','$price','$quantity','$newname')";
          $result=mysqli_query($conn,$query);
             
          if($result){
              move_uploaded_file( $tmp_name ,"../upload/$newname");
              $_SESSION['success']="Product added successfully";
                header('location:../view/layout.php');
          
              }else{
                $_SESSION['error']="Rroduct not added";
                  header('location:../view/addProduct.php');
              }


    
        }else{
            $_SESSION['error']="Category Not Found";
            header('location:../view/addProduct.php'); 
            
        }
    

    
            }else{
                $_SESSION['errors']=$errors;
                header('location:../view/addProduct.php');  
            }
    


    }else{
        header('location:../view/addProduct.php');
    }