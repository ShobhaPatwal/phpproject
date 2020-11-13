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
    global $conn, $error;
    $check_query = "SELECT * FROM products WHERE name='".$name."'";
    $result = $conn->query($check_query);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row['name'] == $name) {
                $error = 1;
                $_SESSION['error'] = $name. " product name already exists";
                break;
            }
        }
        return $_SESSION['error'];
    } 
    return false;
}

// add product
function addProduct($name, $price, $image, $quantity, $colors, $category, $tags, $description) {
    global $conn, $error;
    $status = 1;
    $name = str_replace("'","\'",$name);
    $description = str_replace("'","\'",$description);
    if ($error == 0) {
        $sql = "INSERT INTO products (name, price, image, category_id, description, status) VALUES('".$name."', '".$price."', '".$image."', '".$category."', '".$description."', '".$status."')";
        if ($conn->query($sql) === true) {
            $last_id = $conn->insert_id;
            $sql1 = "INSERT INTO stock (product_id, color, quantity) VALUES('".$last_id."', '".$colors."', '".$quantity."')";
            if ($conn->query($sql1) === false) {
                $_SESSION['error'] = $conn->error;
            }
            if (sizeof($tags) == 1)  {
                $tag = $tags[0];
                $sql2 = "INSERT INTO tags_products (product_id, tag_id) VALUES('".$last_id."', '".$tag."')";
                if ($conn->query($sql2) === true) {
                    $_SESSION['success'] = "Product is added";
                } else {
                    $_SESSION['error'] = $conn->error;
                }
            }
            else {
                foreach ($tags as $tag) {
                    $sql3 = "INSERT INTO tags_products (product_id, tag_id) VALUES('".$last_id."', '".$tag."')";
                    if ($conn->query($sql3) === true) {
                        $_SESSION['success'] = "Product is added";
                    } else {
                        $_SESSION['error'] = $conn->error;
                    }
                }
                
            }

        } else {
            $_SESSION['error'] = $conn->error;
        }
       
    }
    return false;
}


// check whether category already exist with the same name
function checkCategory($catName) {
    global $conn, $error;
    $check_query = "SELECT * FROM categories WHERE name='".$catName."'";
    $result = $conn->query($check_query);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($catName === $row['name']) {
                $error = 1;
                $_SESSION['error'] = $catName. " category name already exists";
            }
            break;
        }
        return $_SESSION['error'];
    } 
    return false;
}
// add category
function addCategory($catName) {
    global $conn, $error;
    if ($error == 0) {
        $sql = "INSERT INTO categories (name) VALUES('".$catName."')";
        if ($conn->query($sql) === true) {
            $_SESSION['success'] = "Category is added";
        } else {
            $_SESSION['error'] = $conn->error;
        }
    }
    return false;
}

// check whether tag already exist with the same name
function checkTag($tagName) {
    global $conn, $error;
    $check_query = "SELECT * FROM tags WHERE name='".$tagName."'";
    $result = $conn->query($check_query);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($tagName === $row['name']) {
                $error = 1;
                $_SESSION['error'] = $tagName. " tag name already exists";
            }
            break;
        }
        return $_SESSION['error'];
    } 
    return false;
}
// add tag
function addTag($tagName) {
    global $conn, $error;
    if ($error == 0) {
        $sql = "INSERT INTO tags (name) VALUES('".$tagName."')";
        if ($conn->query($sql) === true) {
            $_SESSION['success'] = "Tag is added";
        } else {
            $_SESSION['error'] = $conn->error;
        }
    }
    return false;
}

?>