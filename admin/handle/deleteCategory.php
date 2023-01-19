<?php
require_once '../../inc/connection.php' ;
session_start();

if(isset($_POST['delete'])){
    if(isset($_GET['id'])){
        $id=(int) $_GET['id'];

        $query="select id  from categories where id=$id";
        $runquery=mysqli_query($conn,$query);
        if(mysqli_num_rows($runquery) == 1){

        $cat=mysqli_fetch_assoc($runquery);
        $delete_query ="delete from categories where id=$id";
        $result=mysqli_query($conn,$delete_query);

        if($result){

            $_SESSION['success']="Category Was Deleted Successfully";
            header('location:../view/layout.php');

        }else{
            $_SESSION['error']=" Category Wasn't Deleted ";
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