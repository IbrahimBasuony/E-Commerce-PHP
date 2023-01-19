<?php

require_once '../../inc/connection.php' ;
session_start();

if(isset($_POST['delete'])){
    if(isset($_GET['id'])){
        $id=(int) $_GET['id'];

        $query="select id , img from product where id=$id";
        $runquery=mysqli_query($conn,$query);
        if(mysqli_num_rows($runquery) == 1){

        $product=mysqli_fetch_assoc($runquery);
        $img=$product['img'];
        $delete_query ="delete from product where id=$id";
        $result=mysqli_query($conn,$delete_query);

        if($result){
            unlink("../upload/$img");
            $_SESSION['success']="Product Was Deleted Successfully";
            header('location:../view/layout.php');

        }else{
            $_SESSION['error']=" Product Wasn't Deleted ";
            header('location:../view/layout.php');
        }

    }else{
        $_SESSION['error']="Error";
        header('location:../view/layout.php');
    }

    }else{
        header('location:../view/layout.php');
    }
    
}else{
    header('location:../view/layout.php');
}