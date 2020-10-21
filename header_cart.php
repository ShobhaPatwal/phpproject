<?php
/* Remove product */
if (!empty($_GET['action']) && $_GET['action']=="remove") {
    if(!empty($_SESSION["cart_item"])) {
      foreach($_SESSION["cart_item"] as $key => $item) {
        if ($_GET["product_id"] == $key) {
          $product_name = $_SESSION["cart_item"][$key]["name"];
          unset($_SESSION["cart_item"][$key]);
          $_SESSION['success'] = $product_name." is deleted from your cart.";
        }
        if(empty($_SESSION["cart_item"])) {
          unset($_SESSION["cart_item"]);
        } 
      }
      
    }
}
?>

<div class="aa-cartbox">
    <a class="aa-cart-link" href="cart.php">
        <span class="fa fa-shopping-basket"></span>
        <span class="aa-cart-title">SHOPPING CART</span>
        <?php
        $cart_count = 0;
        if(!empty($_SESSION['cart_item'])) {
            $cart_count = array_sum( array_column( $_SESSION['cart_item'], 'quantity' ) );
        ?>
        <span class="aa-cart-notify"><?php echo $cart_count; ?></span>
        <?php
        } else { ?>
        <span class="aa-cart-notify"><?php echo $cart_count; ?></span>
        <?php } ?>
    </a>
    <div class="aa-cartbox-summary">

        <?php
        if(isset($_SESSION["cart_item"])) {
            $total_quantity = 0;
            $total_price = 0;
        ?>
        <ul>
            <?php
            foreach ($_SESSION["cart_item"] as $item){
            ?>            
            <li>
                <a class="aa-cartbox-img" href="#"><img src="admin/images/<?php echo $item["image"]; ?>" alt="img"></a>
                <div class="aa-cartbox-info">
                    <h4><a href="#"><?php echo $item["name"]; ?></a></h4>
                    <p><?php number_format($item["price"]*$item["quantity"], 2); ?><?php echo $item["quantity"]." x $".$item["price"]; ?></p>
                </div>
                <a class="aa-remove-product" href="?action=remove&product_id=<?php echo $item["id"]; ?>"><span class="fa fa-times"></span></a>
            </li>  
            <?php
                $total_quantity += $item["quantity"];
                $total_price += ($item["price"]*$item["quantity"]);
            } ?>                      
            <li>
                <span class="aa-cartbox-total-title">Total</span>
                <span class="aa-cartbox-total-price"><?php echo "$".number_format($total_price, 2) ?></span>
            </li>              
        </ul>	
        <a class="aa-cartbox-checkout aa-primary-btn" href="checkout.php">Checkout</a>
        <?php
        } else {
        ?>
        <div class="no-records">Your Cart is Empty</div>
        <?php } ?>            
    </div>
</div>