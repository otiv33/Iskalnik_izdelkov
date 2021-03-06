<?php
    include_once "session.php";
    include_once "db.php";

    //Image upload
    include "product_image_upload.php";

    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $price = $_POST['price'];
    $store_id = $_POST['store_id'];
    $user_id = $_POST['user_id'];
    //$product_image -> Is defined in "product_image_upload.php"
    if(!isset($product_image)){//If nothing was uploaded OR if upload not OK
        $product_image = "";
    }
    $product_image_description = $_POST['product_image_description'];
    $date_add = $_POST['date_add'];
    $date_modify = $_POST['date_modify'];
    $online_store_product_url = $_POST['online_store_product_url'];

    //Inserting new product
    if(!empty($product_title) && !empty($product_description) && !empty($price) && !empty($user_id) && !empty($store_id) && !empty($date_add) && !empty($date_modify)){
        $query = "INSERT INTO products (product_title, product_description, price, store_id, user_id, product_image, product_image_description, date_add, date_modify, online_store_product_url ) VALUES (?,?,?,?,?,?,?,?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_title, $product_description, $price, $store_id, $user_id, $product_image, $product_image_description, $date_add, $date_modify, $online_store_product_url]);
    }else{
        header("Location: index.php");
        die();
    }
    
    header("Location: product_add_edit.php");

?>