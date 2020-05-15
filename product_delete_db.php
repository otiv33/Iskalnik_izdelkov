<?php
    include_once "session.php";
    include_once "db.php";

    $product_id = $_POST['product_id'];

    if(!empty($product_id)){
        $query = "DELETE FROM products WHERE id_product = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id]);

    }else{
        header("Location: index.php");
        die();
    }
    if(is_admin()){
        header("Location: admin_products_all.php");
    }else{
        header("Location: product_add_edit.php");
    }

?>