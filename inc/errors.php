
<?php
if(isset($_SESSION["errors"])){
     foreach($_SESSION["errors"] as $value){?>
         <div class="alert alert-danger"><?php echo $value ; ?></div>
            <?php  
             }
             unset($_SESSION['errors']);
                }
                ?>    







<?php if(isset($_SESSION['error'])){?>
    <div class="alert alert-danger"><?php echo $_SESSION['error'] ; ?></div>
    <?php
     unset($_SESSION['error']); }?>




    
     
    





    
    
