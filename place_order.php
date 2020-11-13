<?php
$title = "Order";
include('header.php');
include_once('functions.php');
// remove items from the cart
if (isset($_POST['order'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email= $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $postcode = $_POST['postcode'];
    $phone_no = $_POST['phone_no'];
    
    //add product
    //$order = placeOrder($name, $price, $image, $quantity, $colors, $category, $tags, $description);

}

session_destroy();
?>
 
    <section id="cart-view">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Thank You!</h1><br/>
                    <div class="alert alert-success">
                        <strong>Your order has been placed!</strong> Thank you very much!
                    </div> <br/>
                    <h3>🛒 Want to do more shopping?</h3>	<br/>
                    <div class="return-to-shop">
		                <a class="aa-cart-view-btn" href="product.php">Return to shop</a>
	                </div>
                </div>
            </div>
        </div> 
    </section>      
    <?php include('footer.php'); ?>