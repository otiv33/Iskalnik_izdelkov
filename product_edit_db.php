<?php
    include_once "session.php";
    include_once "db.php";

    //File for image upload
    include "product_image_upload.php";
    
    $product_id = $_POST['product_id'];
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $price = $_POST['price'];
    $date_modify = $_POST['date_modify'];
    $online_store_product_url = $_POST['online_store_product_url'];
    //$product_image -> is defined in "product_image_upload.php"
    if(!isset($product_image)){//If nothing was uploaded OR if upload not OK
        $product_image = "";
    }
    $product_image_description = $_POST['product_image_description'];

    //Update products table
    if(!empty($product_title) && !empty($product_description) && !empty($price) && !empty($date_modify)){
            $query = "UPDATE products SET product_title = ?, product_description = ?, price = ?, date_modify = ?, product_image = ?, product_image_description = ?, online_store_product_url = ? WHERE id_product = ?;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$product_title, $product_description, $price, $date_modify, $product_image, $product_image_description, $online_store_product_url, $product_id]);
    }else{
        header("Location: index.php");
        die();
    }
    
    //Different user redirects
    if(is_admin()){
        header("Location: admin_products_all.php");
    }else{
        header("Location: product_add_edit.php");
    }
    
?>