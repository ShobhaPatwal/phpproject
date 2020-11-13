<?php

session_start();
include('../config.php');

if(isset($_GET['action']) && $_GET['action'] == "remove") {
    $category_id = $_REQUEST['category_id'];
    $delete = "DELETE FROM categories WHERE id='$category_id'";
    if ($conn->query($delete) === TRUE) {
        $_SESSION['message'] = "Category is deleted";
    } else {
        $_SESSION['error'] = $conn->error;
    }
}

if(isset($_POST['delete'])) {
    $delete_id = $_POST['checkbox'];
    $rowCount = count($delete_id );
    if (count($rowCount) > 0) {
        foreach ($delete_id as $id) {
            $sql = "DELETE FROM categories WHERE id='$id'";
            $delete = $conn->query($sql);
        }
    }
    if ($delete) {
        if ($rowCount == 1) { 
            $_SESSION['message'] = "Category deleted successfully." ;
        } 
        else { 
            $_SESSION['message'] = "Categories deleted successfully." ;
        }
    }
    else {
        $_SESSION['error'] = $conn->error;
    }
}

header('location: categories.php');

?>