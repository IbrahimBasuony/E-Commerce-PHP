<?php
session_start();
    
    if(isset($_POST['submit'])){
        $id=htmlspecialchars(trim($_POST['id']));
        $title=htmlspecialchars(trim($_POST['title']));
        $description=htmlspecialchars(trim($_POST['description']));
        $price=htmlspecialchars(trim($_POST['price']));
        $quantity=htmlspecialchars(trim($_POST['quantity']));
        $img=htmlspecialchars(trim($_POST['img']));

        $errors=[];

        if(empty($quantity)){
            $errors[]= "quantity is Required";
          }elseif(! is_numeric($quantity)){
            $errors[]= "quantity  must be numeric";
          }

          if( empty($errors)){ 
           
            $cart=[
                'id'=>$id ,
                'title'=>$title,
                'description'=> $description ,
                'price'=> $price,
                'quantity'=> $quantity,
                'subTotal'=>$price*$quantity,
                'img'=> $img 

            ];

            // $_SESSION['cart']=[];

           $_SESSION['cart'][]=$cart ;

          

            header('location:../cart.php');
            

            


          }else{
            $_SESSION['errors']= $errors ;
            header('location:../shop.php');
          }
          

    }else{
        header('location:../shop.php');
    }

