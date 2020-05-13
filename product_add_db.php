<?php
    include_once "session.php";
    include_once "db.php";

    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $store_id = $_POST['store_id'];
    $user_id = $_POST['user_id'];
    $date_add = $_POST['date_add'];
    $date_modify = $_POST['date_modify'];

    if(!empty($product_title) && !empty($description) && !empty($price) && !empty($user_id) && !empty($store_id) && !empty($date_add) && !empty($date_modify)){
        $query = "INSERT INTO products (product_title, description, price, store_id, user_id, date_add, date_modify) VALUES (?,?,?,?,?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_title, $description, $price, $store_id, $user_id, $date_add, $date_modify]);

    }else{
        header("Location: index.php");
        die();
    }
    
    header("Location: product_add_edit.php");

?>