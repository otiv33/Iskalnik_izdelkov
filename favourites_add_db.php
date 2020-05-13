<?php
    include_once "session.php";
    include_once "db.php";

    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];

    if(!empty($product_id) && !empty($user_id)){
        $query = "INSERT INTO favourites (product_id, user_id) VALUES (?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id, $user_id]);

    }else{
        header("Location: index.php");
        die();
    }
    
    header("Location: product.php?product_id=".$product_id);

?>