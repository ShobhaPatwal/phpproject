<?php

session_start();
include_once('../config.php');
include_once('../functions.php');
$errors = array();


$category_name = isset($_POST['categoryName'])?$_POST['categoryName']:'';

// check whether category already exist with the same name
$check_category = checkCategory($category_name);

// add category
$category = addCategory($category_name);

if (isset($_SESSION['success'])) : ?>
    <div class="notification success png_bg">
		<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
        <div><?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
        ?></div>
    </div>
<?php
endif;

?>



