<?php

session_start();
include_once('../config.php');
include_once('../functions.php');
$error = 0;
if (isset($_POST['submit'])) {
    $name = isset($_POST['name'])?$_POST['name']:'';
    $price = isset($_POST['price'])?$_POST['price']:'';
    $category = isset($_POST['category'])?$_POST['category']:'';
    $tags = $_POST['tags'];
    //$tags = implode(',', $_POST['tags']);
    $description = isset($_POST['description'])?$_POST['description']:'';
    $quantity = $_POST['quantity'];
    $colors = implode(',', $_POST['color']);
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = "images/";
    //$location = "../img/". $category ."/";
    if (!move_uploaded_file($tmp_name,$location.$image)) {
        $errors[] = array('input'=>'file', 'msg'=>'Sorry, there was an error uploading your file.');
    }
    //check product already exists
    $checkProduct = checkProduct($name);

    //add product
    $addProduct = addProduct($name, $price, $image, $quantity, $colors, $category, $tags, $description);
    header('location: products.php');

} 

?>


