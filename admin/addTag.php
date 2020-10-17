<?php

session_start();
include_once('../config.php');
include_once('../functions.php');
$error = 0;
if (isset($_POST['submit'])) {
    $tag_name = isset($_POST['tag'])?$_POST['tag']:'';
    // check whether tag already exist with the same name
    $check_tag = checkTag($tag_name);
    // add tag
    $tag = addTag($tag_name);
    header('location: tags.php');
}

?>


