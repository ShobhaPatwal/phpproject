<?php

//login user if there are no errors in the form
function loginuser($user, $pass, $checked) {
    global $conn, $errors;
    if (sizeof($errors) == 0) {
        $sql = "SELECT * FROM users WHERE 
        username='".$user."' AND password='".$pass."'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // output data of selected row
            $row = $result->fetch_assoc();
            if (!empty($checked)) {
                setcookie("username", $user, time()+ (10 * 365 * 24 * 60 * 60));  
                setcookie("password", $pass, time()+ (10 * 365 * 24 * 60 * 60));
            }
            $_SESSION['userdata'] = array('username'=>$row['username'],'user_id'=>$row['id']);
            header('Location: index.php');
        } else {
            $errors[] = array('input'=>'form', 'msg'=>'Invalid login details');
            return $errors;
        }

        $conn->close();
    }
    return false;
}

// check whether PRODUCT already exist with the same name
function checkProduct($name) {
    global $conn, $errors;
    $check_query = "SELECT * FROM products WHERE name='".$name."'";
    $result = $conn->query($check_query);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row['name'] == $name) {
                $errors[] = array('input'=>'productname', 'msg'=>'Product already exists');
            }
        }
        return $errors;
    } 
    return false;
}
// add product
function addProduct($name, $price, $image, $category, $tags, $description) {
    global $conn, $errors;
    if (sizeof($errors) == 0) {
        $sql = "INSERT INTO products (name, price, image, category_id, tag_id, description) VALUES('".$name."', '".$price."', '".$image."', '".$category."', '".$tags."', '".$description."')";
        if ($conn->query($sql) === true) {
            $_SESSION['success'] = "Product is added";
            //header('Location: products.php');
        } else {
            $errors[] = array('input'=>'form', 'msg'=>$conn->error);
            return $errors;
        }
    
    }
    return false;
}
// delete product
if (!empty($_GET['action']) && $_GET['action']=="remove") {
    $id = $_GET["product_id"];
    $delete = "DELETE FROM products WHERE id='$id'";
    if ($conn->query($delete) === TRUE) {
        $message = "Product is deleted";
    } else {
        $errors[] = array('input'=>'delete', 'msg'=>$conn->error);
    }
    header('Location: products.php');
}



// check whether category already exist with the same name
function checkCategory($catName) {
    global $conn, $errors;
    $check_query = "SELECT * FROM categories WHERE name='".$catName."'";
    $result = $conn->query($check_query);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($catName === $row['name']) {
                $errors[] = array('input'=>'catname', 'msg'=>'Category already exists');
            }
        }
        return $errors;
    } 
    return false;
}
// add category
function addCategory($catName) {
    global $conn, $errors;
    if (sizeof($errors) == 0) {
        $sql = "INSERT INTO categories (name) VALUES('".$catName."')";
        if ($conn->query($sql) === true) {
            $_SESSION['success'] = "Category is added";
            return $_SESSION['success'];
        } else {
            $errors[] = array('input'=>'form', 'msg'=>$conn->error);
            return $errors;
        }
    
    }
    return false;
}

?>