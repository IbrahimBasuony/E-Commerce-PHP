
<?php include 'header.php' ?>
<?php include 'navbar.php' ?>
<?php require_once 'inc/connection.php' ?>


<?php require_once('inc/errors.php'); ?>
<?php require_once('inc/success.php'); ?> 

<?php if(! isset($_SESSION['userId'])){
    header('location:login.php');
}
?>
    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modren Desgin</p>
        <div class="pro-container">

        <?php
        if(isset($_GET['page'])){
            $page= (int) $_GET['page'];
            
            $query="select count(id) as total from product ";
            $result=mysqli_query($conn,$query);
            if(mysqli_num_rows($result) == 1){
                $runquery=mysqli_fetch_assoc($result);
            }
                
            
        
            $total=$runquery['total'];
            $limit= "3";
            $number_of_pages= ceil($total / $limit);
            $offset= ($page-1) * $limit ;
        
        
        
            function paginate ($page , $number_of_pages){
                if($page>=1 && $page<=$number_of_pages){
                    return true ;
                }else{
                    return false ;
                }
            }
        
        
        
            if( paginate($page,$number_of_pages) == false ){
                header("location:" . $_SERVER['PHP_SELF'] . "?page=1" );
            }
           
        
        
        
        }else{
            header("location:" . $_SERVER['PHP_SELF'] . "?page=1");
        }

        // -------------------------------------------------------------------------
                  $sql="select * from `product` limit $limit offset $offset ";
                  $result=mysqli_query($conn,$sql);
                  if(mysqli_num_rows($result) > 0){
                     $products = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    
                    }
                    
                    foreach( $products as $product ){
                  ?>
         
            <div class="pro">
            <form action="handle/handleCart.php?id=<?php echo $product['id'] ?>" method="post" >
            <img src="admin/upload/<?php echo $product['img'] ?>" alt="p1" />
                <div class="des">
                <h2><?php echo $product['title'] ?></h2>
                    <h5><?php echo $product['description'] ?></h5>
                    <div class="star ">
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                    </div>
                    <h4><?php echo $product['price'] ?></h4>
                    <input type="number" name="quantity">

                     <input type="hidden"  name="id" value="<?php echo $product['id'] ?>" >
                    <input type="hidden"  name="title" value="<?php echo $product['title'] ?>" >
                    <input type="hidden"  name="description" value="<?php echo $product['description'] ?>" >
                    <input type="hidden"  name="price" value="<?php echo $product['price'] ?>" >
                    <input type="hidden"  name="img" value="<?php echo $product['img'] ?>" > 

                    <button type="submit" name="submit"><a class="cart "><i class="fas fa-shopping-cart "></i></a></button>
                     
                </div>
            </form>
        </div>
            <?php } ?>

                <!-- <div class="pro">
            <img src="" alt="p1" />
                <div class="des">
                <h2></h2>
                    <h5></h5>
                    <div class="star ">
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                    </div>
                    <h4></h4>
                    <input type="number" name="quantity">
                    <button type="submit"><a class="cart "><i class="fas fa-shopping-cart "></i></a></button>
                     
                </div>
                <div class="pro">
           
            <img src="" alt="p1" />
                <div class="des">
                <h2></h2>
                    <h5></h5>
                    <div class="star ">
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                    </div>
                    <h4></h4>
                    <input type="number" name="quantity">
                    <button type="submit"><a class="cart "><i class="fas fa-shopping-cart "></i></a></button>
                     
                </div>
                <div class="pro">
          
            <img src="" alt="p1" />
                <div class="des">
                <h2></h2>
                    <h5></h5>
                    <div class="star ">
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                        <i class="fas fa-star "></i>
                    </div>
                    <h4></h4>
                    <input type="number" name="quantity">
                    <button type="submit"><a class="cart "><i class="fas fa-shopping-cart "></i></a></button>
                     
                </div>
              
            </div>
        </div> -->
        </div>
    </section>
    


    <section id="pagenation" class="section-p1">
    <!-- <nav aria-label="Page navigation example" >
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1 of 2 </a></li>
    
 
    <li class="page-item">
      <a class="page-link" href=" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav> -->

<div class="container d-flex justify-content-center">
<nav aria-label="...">
  <ul class="pagination">
    <li class="page-item <?php if($page==1){echo'disabled';}?> ">
      <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?page=" . $page-1 ; ?>">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?page=1" ;?>"><?php echo $page .  " of " . $number_of_pages ;?></a></li>
 
    <li class="page-item <?php if($page==$number_of_pages){echo'disabled';}?>">
      <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?page=" . $page+1 ; ?>">Next</a>
    </li>
  </ul>
</nav>
</div>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext ">
            <h4>Sign Up For Newletters</h4>
            <p>Get E-mail Updates about our latest shop and <span class="text-warning ">Special Offers.</span></p>
        </div>
        <div class="form ">
            <input type="text " placeholder="Enter Your E-mail... ">
            <button class="normal ">Sign Up</button>
        </div>
    </section>


    <?php include 'footer.php' ?>