<?php

session_start();
include('../config.php');

if(isset($_GET['action']) && $_GET['action'] == "remove") {
    $product_id = $_REQUEST['product_id'];
    $delete = "DELETE FROM products WHERE id='$product_id'";
    if ($conn->query($delete) === TRUE) {
        $_SESSION['message'] = "Product is deleted";
    } else {
        $_SESSION['error'] = $conn->error;
    }
}

if(isset($_POST['delete'])) {
    $delete_id = $_POST['checkbox'];
    $rowCount = count($delete_id );
    if (count($rowCount) > 0) {
        foreach ($delete_id as $id) {
            $sql = "DELETE FROM products WHERE id='$id'";
            $delete = $conn->query($sql);
        }
    }
    if ($delete) {
        if ($rowCount == 1) { 
            $_SESSION['message'] = "Product deleted successfully." ;
        } 
        else { 
            $_SESSION['message'] = "Products deleted successfully." ;
        }
    }
    else {
        $_SESSION['error'] = $conn->error;
    }
}

header('location: products.php');

?>