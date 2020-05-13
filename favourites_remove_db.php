<?php
    include_once "session.php";
    include_once "db.php";

    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];
    if(isset($_POST['from_product'])){
        $from_product = $_POST['from_product'];
    }else{
        $from_product = false;
    }


    if(!empty($product_id) && !empty($user_id)){
        $query = "DELETE FROM favourites WHERE product_id = ? AND user_id = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id, $user_id]);
    }else{
        header("Location: index.php");
        die();
    }
    if($from_product == true){
        header("Location: product.php?product_id=".$product_id);
    }else{
        header("Location: favourites.php");
    }
    

?>