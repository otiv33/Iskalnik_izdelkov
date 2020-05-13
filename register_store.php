<?php
    include_once "header.php";
    $user_id = $_SESSION['user_id'];
?>

<h1>Registracija trgovine</h1>

<form action="register_store_db.php" method="POST" class="form-group">
    <input type="text" name="title" required="required" placeholder="Vnesite naslov" class="form-control"/><br/>
    <input type="text" name="description" required="required" placeholder="Vnesite opis" class="form-control"/><br/>
    <input type="text" name="location" required="required" placeholder="Vnesite URL lokacije" class="form-control"/><br/>
    <input type="text" name="site_link_url" placeholder="Vnesite URL do vaše spletne strani" class="form-control"/><br/>
    <input type="text" name="online_store_link_url" placeholder="Vnesite URL do vaše spletne trgovine" class="form-control"/><br/>
    <input type="hidden" name="user_id" value="<?php echo $user_id ?>" class="form-control"/><br/>
    <input type="submit" value="Registracija" class="form-control"/><br/>
</form>

<?php
    include_once "footer.php"
?>