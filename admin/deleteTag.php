<?php

session_start();
include('../config.php');

if(isset($_GET['action']) && $_GET['action'] == "remove") {
    $tag_id = $_REQUEST['tag_id'];
    $delete = "DELETE FROM tags WHERE id='$tag_id'";
    if ($conn->query($delete) === TRUE) {
        $_SESSION['message'] = "Tag is deleted";
    } else {
        $_SESSION['error'] = $conn->error;
    }
}

if(isset($_POST['delete'])) {
    $delete_id = $_POST['checkbox'];
    $rowCount = count($delete_id );
    if (count($rowCount) > 0) {
        foreach ($delete_id as $id) {
            $sql = "DELETE FROM tags WHERE id='$id'";
            $delete = $conn->query($sql);
        }
    }
    if ($delete) {
        if ($rowCount == 1) { 
            $_SESSION['message'] = "Tag deleted successfully." ;
        } 
        else { 
            $_SESSION['message'] = "Tags deleted successfully." ;
        }
    }
    else {
        $_SESSION['error'] = $conn->error;
    }
}

header('location: tags.php');

?>