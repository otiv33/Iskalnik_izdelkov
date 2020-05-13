<?php
    include_once "session.php";
    include_once "db.php";

    $product_id = $_POST['product_id'];
    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $date_modify = $_POST['date_modify'];

    if(!empty($product_title) && !empty($description) && !empty($price) && !empty($date_modify)){
        $query = "UPDATE products SET product_title = ?, description = ?, price = ?, date_modify = ? WHERE id_product = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_title, $description, $price, $date_modify, $product_id]);

    }else{
        header("Location: index.php");
        die();
    }
    
    header("Location: product_add_edit.php");

?>