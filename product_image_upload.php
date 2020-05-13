<?php
include_once "session.php";


$picture_description = $_POST['product_image_description'];

/*if (product_owner($_SESSION['user_id'])) {
    header("Location: location.php?id=".$picture_id);
    die();
}*/



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
        throw new Exception('Upload not succsessful');
        header("Location: product_add_edit.php");
        die();
    }
}else{
    throw new Exception('Upload not OK');
    header("Location: product_add_edit.php");
    die();
}
?>