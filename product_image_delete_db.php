<?php
    include_once "session.php";
    include_once "db.php";
    
    $product_id = $_POST['product_id'];

    if(!empty($product_id)){
        $query = "DELETE product_image FROM products WHERE id_product = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id]);

    }else{
        header("Location: index.php");
        die();
    }
    header("Location: product_edit.php");    
?>