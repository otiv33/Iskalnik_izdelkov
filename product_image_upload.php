<?php
include_once "session.php";
include_once "alert.php";

//Execute if there is a file that was sent
if(!empty($_FILES["product_image"]["name"]) ){
    //Check if there is already a file
    if(isset($_POST['product_id'])){
        $product_id = $_POST['product_id'];
        $query = "SELECT product_image FROM products WHERE id_product = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id]);
        $existing_image = $stmt->fetch()['product_image'];
        if(!empty($existing_image)){
            //Delete image from DB
            $query = "UPDATE products SET product_image = \"\", product_image_description = \"\" WHERE id_product = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$product_id]);
            //Delete image from folder
            if (!unlink($existing_image)) {  
                consoleLog("$existing_image cannot be deleted due to an error");  
            }
            else {  
                consoleLog("$existing_image has been deleted");  
            }  
        }
    }

    //Standard upload procedure-------------------------------------------------------
    $picture_description = $_POST['product_image_description'];
    $target_dir = "uploads/";
    $change_name = date("Y-m-d-h-i-s")."-".$picture_description."-";
    $target_file = $target_dir .$change_name. basename($_FILES["product_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["product_image"]["tmp_name"]);
        if($check !== false) {
           // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
          //  echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    
    // Check file size
    if ($_FILES["product_image"]["size"] > 5000000) {
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 1
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
            $product_image = $target_file; //WE ASSIGN THE VALUE for product image
        }else{
            consoleLog("File could not be copied to folder");
        }
    }else{
        consoleLog("Product upload not OK");
    }
}

?>