<?php

session_start();
include_once('../config.php');
include_once('../functions.php');
$error = 0;
if (isset($_POST['submit'])) {
    $category_name = isset($_POST['category'])?$_POST['category']:'';
    // check whether category already exist with the same name
    $check_category = checkCategory($category_name);
    // add category
    $category = addCategory($category_name);
    header('location: categories.php');
}

?>


