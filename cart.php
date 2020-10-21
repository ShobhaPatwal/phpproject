<?php 
$title = "Cart";
include('header.php');
if (isset($_POST['update'])) {
  $quantity = $_POST['quantity'];
  print_r($quantity);
}
?>
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Cart Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Cart</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <?php
        if(!empty($_SESSION["cart_item"])) {
            $total_quantity = 0;
            $total_price = 0;
        ?> 
        <div class="cart-view-area">
        <?php
        if (isset($_SESSION['success']))  { ?>
          <div class='cart-empty cart-info'><?php echo $_SESSION['success']; unset($_SESSION['success']);  ?> </div>
        <?php }  ?>
           <div class="cart-view-table">
             <form action="cart.php" method="post">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($_SESSION["cart_item"] as $item){
                      ?>
                      <tr>
                        <td><a class="remove" href="?action=remove&product_id=<?php echo $item["id"]; ?>"><fa class="fa fa-close" data-id="<?php echo $item["id"]; ?>"></fa></a></td>
                        <td><a href="admin/images/<?php echo $item["image"]; ?>"><img src="admin/images/<?php echo $item["image"]; ?>" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="#"><?php echo $item["name"]; ?></a></td>
                        <td>$<?php echo $item["price"]; ?></td>

                        <td><input class="aa-cart-quantity" type="number" name="quantity[]" value="<?php echo $item["quantity"]; ?>" min="1"></td>
                        <td><?php echo "$".number_format(($item["quantity"]*$item["price"]), 2) ?></td>
                      </tr>
                      <?php
                      $total_quantity += $item["quantity"];
                      $total_price += ($item["quantity"]*$item["price"]);
                      } ?>
                      <tr>
                        <td colspan="6" class="aa-cart-view-bottom">
                          <div class="aa-cart-coupon">
                            <input class="aa-coupon-code" type="text" placeholder="Coupon">
                            <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                          </div>
                          <input class="aa-cart-view-btn" type="submit" name="update" value="Update Cart">
                        </td>
                      </tr>
                      </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Subtotal</th>
                     <td><?php echo "$".number_format($total_price, 2) ?></td>
                   </tr>
                   <tr>
                     <th>Total</th>
                     <td><?php echo "$".number_format($total_price, 2) ?></td>
                   </tr>
                 </tbody>
               </table>
               <a href="#" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
        <?php
        } else {
        ?>
        <div class="cart-empty cart-info">Your cart is currently empty.</div>	
        <div class="return-to-shop">
		      <a class="aa-cart-view-btn" href="product.php">Return to shop</a>
	      </div>
        <?php } ?> 
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->


  <!-- Subscribe section -->
  <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <h3>Subscribe our newsletter </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
            <form action="" class="aa-subscribe-form">
              <input type="email" name="" id="" placeholder="Enter your Email">
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Subscribe section -->

  <?php include('footer.php'); ?>