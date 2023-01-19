<?php
require_once('../inc/connection.php');
session_start();


if(isset($_POST['signup'])){
   $user_name=htmlspecialchars(trim($_POST['username']));
   $email=htmlspecialchars(trim($_POST['email']));
   $password=htmlspecialchars(trim($_POST['password']));
   $phone=htmlspecialchars(trim($_POST['phone']));
   $address=htmlspecialchars(trim($_POST['address']));


   $errors=[];
    
   if(empty($user_name)){
     $errors[]= "UserName is Required";
   }elseif(is_numeric($user_name)){
     $errors[]= "UserName  Must be Letters";
   }elseif(strlen($user_name) > 50){
     $errors[]= "UserName  Must be Less Than 50 Letters";
   }
   
   if(empty($email)){
     $errors[]= "Email is Required";
   }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
     $errors[]= "Enter Validate Email";
   }

   if(empty($password)){
     $errors[]= "Password is Required";
   }elseif(strlen($password) > 50){
     $errors[]= "Password  Must be Less Than 50 Letters";
   }

   if(empty($phone)){
     $errors[]= " Phone is Required";
   }elseif(!is_numeric($phone) ){
     $errors[]= "Phone  Must be  Numbers";
   }

   if(empty($address)){
     $errors[]= " Address is Required";
   }elseif(strlen($address) > 100){
     $errors[]= "Address  Must be Less Than 100 Letters";
   }


   if(empty($errors)){

              $qry="select email , phone from users where `email`='$email' || `phone`='$phone'";
              $runQuery=mysqli_query($conn,$qry);
              if(mysqli_num_rows($runQuery) == 1){

                $_SESSION['error']="This Acoount is exist";
                $_SESSION['username']=$user_name;
                $_SESSION['email']=$email;
                $_SESSION['phone']=$phone;
                $_SESSION['address']=$address;
                header('location:../signup.php');

              }else{




                $hashedPass=password_hash($password,PASSWORD_BCRYPT);
                $query="INSERT INTO users ( `name`, `email`, `password`, `phone`, `address`) 
                VALUES ('$user_name','$email','$hashedPass','$phone','$address')";
                $result=mysqli_query($conn,$query);
                if($result){
                    $_SESSION['success']= "You signed up successfuly" ;
                    header('location:../login.php');
                    }else{
                      $_SESSION['error']="Error while Insetring Data";
                      header('location:../signup.php');
                    }
       
                  }
        }else{
            $_SESSION['errors']=$errors;
            $_SESSION['username']=$user_name;
            $_SESSION['email']=$email;
            $_SESSION['phone']=$phone;
            $_SESSION['address']=$address;
            header('location:../signup.php');

        }

      

}else{
    header('location:../signup.php');
}