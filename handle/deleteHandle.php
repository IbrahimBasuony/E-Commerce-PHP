<?php
session_start();
if(isset($_POST['remove']) && isset($_GET['id'])){
    $id=htmlspecialchars(trim($_GET['id']));
    $keycol=array_column($_SESSION['cart'],'id');
    $keysearch=array_search($id,$keycol);
   
    unset($_SESSION['cart'][$keysearch]);
    $_SESSION['cart']=array_values($_SESSION['cart']);
    header('location:../cart.php'); 
}else{
    header('location:../cart.php'); 
}