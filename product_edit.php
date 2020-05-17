<?php
    include_once "header.php";
    include_once "db.php";

    storeOwnerCheckRegisteredStore();

    $product_id = $_POST['product_id'];
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
    echo $prod['product_title']
?>

<h1>Uredi izdelek</h1>

<form action="product_edit_db.php" method="POST" class="form-group">
    <input type="hidden" name="product_id" value="<?php echo $product_id ?>" class="form-control"/>
    <input type="text" name="product_title" required="required" value="<?php echo $prod['product_title'] ?>" class="form-control"/><br/>
    <input type="text" name="product_description" required="required" value="<?php echo $prod['product_description'] ?>" class="form-control"/><br/>
    <input type="number" name="price" step="0.01" min="0" max="1000000000000000" required="required" value="<?php echo $prod['price'] ?>" class="form-control"/><br/>
    <input type="hidden" name="date_modify" value="<?php echo $date_modify ?>" class="form-control"/>
    <input type="submit" value="Potrdi spremembe" class="form-control"/><br/>
</form>

<?php
    include_once "footer.php"
?>