<?php
session_start();
include('config.php');
if (isset($_POST['update']) && isset($_SESSION['cart_item'])) {
  $quantity = $_POST['quantity']; 
  foreach($_SESSION['cart_item'] as $item => $value) {
    $_SESSION['cart_item'][$item]['quantity'] = $quantity[$item];
  }
  $_SESSION['success'] = "Cart is updated.";
  header('location: cart.php');
}

?>