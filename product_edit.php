<?php
    include_once "header.php";
    include_once "db.php";

    storeOwnerCheckRegisteredStore();

    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];
    }else{
        $product_id = $_POST['product_id'];
    }

    $user_id = $_SESSION['user_id'];
    $date_modify = date('Y-m-d h:m:s');

    if(is_admin()){
        $query = "SELECT * FROM products WHERE id_product = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id]);
    }else{
        $query = "SELECT * FROM products WHERE id_product = ? AND user_id = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id,$user_id]);
    }
    
    $prod = $stmt->fetch();
?>

<h1>Uredi izdelek</h1>

<form action="product_edit_db.php" method="POST" class="form-group" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?php echo $product_id ?>" class="form-control"/>
    Naslov izdelka : <input type="text" name="product_title" required="required" value="<?php echo $prod['product_title'] ?>" class="form-control"/><br/>
    Opis : <input type="text" name="product_description" required="required" value="<?php echo $prod['product_description'] ?>" class="form-control"/><br/>
    Cena : <input type="number" name="price" step="0.01" min="0" max="1000000000000000" required="required" value="<?php echo $prod['price'] ?>" class="form-control"/><br/>
    <?php
        if(!empty($prod['product_image'])){
            echo '<div class="flexbox">
                    <text><b>An image already exists : </b></text><a href="'.$prod['product_image'].'" target="_blank"><b>'.$prod['product_image'].'</b></a>
                    <a href="product_delete_db.php?product_id='.$prod['id_product'].'&product_image='.$prod['product_image'].'" class="btn btn-danger">Delete image</a>
                    <br/><br/>    
                    <text>Choose a new image to change it : </text><input type="file" name="product_image" id="product_image" />
                    <br/>
                    <br/>
                    <text>Opis slike : </text>
                    <input type="text" name="product_image_description" value="'.$prod['product_image_description'].'" placeholder="Vnesi opis slike"/><br />
                </div><br/>';
        }else{
            echo '<div class="flexbox">
                    <text>Izberi sliko : </text>
                    <input type="file" name="product_image" id="product_image" /> <br />
                    <br/>
                    <text>Opis slike : </text>
                    <input type="text" name="product_image_description" value="'.$prod['product_image_description'].'" placeholder="Vnesi opis slike"/><br />
                </div><br/>';
        }
    ?>
    Povezava do izdelka v spletni trgovini : <input type="text" name="online_store_product_url" required="required" value="<?php echo $prod['online_store_product_url'] ?>" class="form-control"/><br/>
    <input type="hidden" name="date_modify" value="<?php echo $date_modify ?>" class="form-control"/>
    <input type="submit" value="Potrdi spremembe" class="btn btn-primary form-control"/><br/>
</form>

<?php
    include_once "footer.php"
?>