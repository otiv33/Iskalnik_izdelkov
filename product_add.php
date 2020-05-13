<?php
    include_once "header.php";
    include_once "db.php";

    $user_id = $_SESSION['user_id'];
    $date_add = date('Y-m-d h:m:s');
    $date_modify = date('Y-m-d h:m:s');

    $query = "SELECT store_id FROM users WHERE id_user = ?;";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);
    $store_id = $stmt->fetch()['store_id'];
?>

<h1>Dodaj izdelek</h1>

<form action="product_add_db.php" method="POST" class="form-group">
    <input type="text" name="product_title" required="required" placeholder="Vnesi naslov" class="form-control"/><br/>
    <input type="text" name="description" required="required" placeholder="Vnesi opis" class="form-control"/><br/>
    <input type="number" name="price" step="0.01" min="0" max="1000000000000000" required="required" placeholder="Vnesi ceno" class="form-control"/><br/>
    <input type="hidden" name="store_id" value="<?php echo $store_id ?>" class="form-control"/>
    <input type="hidden" name="user_id" value="<?php echo $user_id ?>" class="form-control"/>
    <input type="hidden" name="date_add" value="<?php echo $date_add ?>" class="form-control"/>
    <input type="hidden" name="date_modify" value="<?php echo $date_modify ?>" class="form-control"/>
    <input type="submit" value="Dodaj" class="form-control"/><br/>
</form>

<?php
    include_once "footer.php"
?>