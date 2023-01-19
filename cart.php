<?php include 'header.php' ?>
<?php include 'navbar.php' ?>


<section id="page-header" class="about-header"> 
        <h2>#Cart</h2>
        <p>Let's see what you have.</p>
    </section>
 
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Name</td>
                    <td>Desc</td>
                    <td>Quantity</td>
                    <td>price</td>
                    <td>Subtotal</td>
                    <td>Remove</td>
                    <!-- <td>Edit</td> -->
                </tr>
            </thead>
            <?php 
            if(isset($_SESSION['cart'])){
                    foreach((isset($_SESSION['cart'])) ? $_SESSION['cart'] :null  as $cart){

             ?>
   
            <tbody>
                <tr>
                    <td><img src="admin/upload/<?php echo $cart['img'] ?>" alt="product1"></td>
                    <td><?php echo $cart['title'] ?></td>
                    <td><?php echo $cart['description'] ?></td>
                    <td><?php echo $cart['quantity'] ?></td>
                    <td><?php echo $cart['price'] ?></td>
                    <td><?php echo $cart['price']* $cart['quantity'] ?></td>
                    
                   
                    <td>
                    <form action="handle/deleteHandle.php?id=<?php echo $cart['id'] ?>" method="post">
                    <button type="submit" name='remove' class="btn btn-danger">Remove</button>
                    </form>
                    </td>
                    <!-- Remove any cart item  -->
                    <!-- <td><button type="submit"  class="btn btn-danger">Remove</button></td> -->
                    
                    
                
                </tr>
            </tbody>

            <?php } } ?>
           
            <!-- confirm order  -->
            
            <td>
           <br> Total= <?php 

if(isset($_SESSION['cart'])){
    $keycol=array_column($_SESSION['cart'],'subTotal');
    // print_r($keycol) ;
    $total= array_sum($keycol);
    echo $total ;
} 
 ?><br><br><br>
            <button type="submit" name="" class="btn btn-success">Confirm</button></td>
            
        </table>
    </section>

    <!-- <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Coupon</h3>
            <input type="text" placeholder="Enter coupon code">
            <button class="normal">Apply</button>
        </div>
        <div id="subTotal">
            <h3>Cart totals</h3>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>$118.25</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$118.25</strong></td>
                </tr>
            </table>
            <button class="normal">proceed to checkout</button>
        </div>
    </section> -->

    <?php include "footer.php" ?>

