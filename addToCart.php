<?php

session_start();
include('config.php');


function fetchProduct($productid) 
{
    global $conn;
    $sql = "SELECT * FROM products WHERE id='" .$productid. "'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    }    
    return die($conn->error);
} 
if (isset($_POST['cart'])) {
    $productid = $_POST['id'];
    $quantity = $_POST['quantity'];
    $product = fetchProduct($productid);
    $name = $product['name'];
    $price = $product['price'];
    $image = $product['image'];
    $cartArray = array(
            'id' => $productid,    
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'quantity'=> $quantity
    );
    if (empty($_SESSION["cart_item"])) {
        $_SESSION["cart_item"]["$productid"] = $cartArray;
        $message = "<div class='box'>Product is added to your cart!</div>";
    } else {
        if(array_key_exists($productid, $_SESSION["cart_item"])) {
            foreach($_SESSION["cart_item"] as $k => $v) {
                if($productid == $k) {
                    if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                    }
                    $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                }
            }
            $message = "<div  class='box'>Product is updated in your cart!</div>"; 
        } else {
            $_SESSION["cart_item"]["$productid"] = $cartArray;
            $message = "<div class='box'>Product is added to your cart!</div>";
        }
    }

}

header('location:product.php')
?>

