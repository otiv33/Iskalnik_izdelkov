<?php
    include_once "session.php";
    include_once "db.php";
    include_once "alert.php";
    
    $product_id = $_GET['product_id'];
    $product_image = $_GET['product_image'];

    //Set everything image related to empty
    if(!empty($product_id)){
        $query = "UPDATE products SET product_image = \"\", product_image_description = \"\" WHERE id_product = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id]);
        if (!unlink($product_image)) { //Deletion of image file
            consoleLog("$product_image cannot be deleted due to an error");  
        }
        else {  
            consoleLog("$product_image has been deleted");  
        }
    }else{
        header("Location: index.php");
        die();
    }
    header("Location: product_edit.php?product_id=".$product_id); 
?>