<?php

session_start();
include('../config.php');

if(isset($_GET['action']) && $_GET['action'] == "remove") {
    $order_id = $_REQUEST['order_id'];
    $delete = "DELETE FROM orders WHERE id='$order_id'";
    if ($conn->query($delete) === TRUE) {
        $_SESSION['message'] = "Order is deleted";
    } else {
        $_SESSION['error'] = $conn->error;
    }
}

if(isset($_POST['delete'])) {
    $delete_id = $_POST['checkbox'];
    $rowCount = count($delete_id );
    if (count($rowCount) > 0) {
        foreach ($delete_id as $id) {
            $sql = "DELETE FROM orders WHERE id='$id'";
            $delete = $conn->query($sql);
        }
    }
    if ($delete) {
        if ($rowCount == 1) { 
            $_SESSION['message'] = "Order deleted successfully." ;
        } 
        else { 
            $_SESSION['message'] = "Orders deleted successfully." ;
        }
    }
    else {
        $_SESSION['error'] = $conn->error;
    }
}

header('location: orders.php');

?>