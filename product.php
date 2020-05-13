<?php
    include_once "header.php";
    include_once "db.php";
    
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = null;
    }
    
    if(isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
    }else{
        $product_id = $_POST['product_id'];
    }

    $query = "SELECT p.*, s.* FROM products AS p INNER JOIN stores AS s ON p.store_id = s.id_store WHERE id_product = ?;";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$product_id]);
    $r = $stmt->fetch();

    $query = "SELECT true AS result FROM favourites WHERE product_id = ? AND user_id = ?;";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$product_id, $user_id]);
    $favourite = $stmt->fetch();
?>

<div class="container">

        <div class="col-md-12" style="text-align:center">
        <div class="row">
            <div class="col-md-4">
                <?php 
                if(isset($user_id)){
                    if(isset($favourite['result'])){
                        if($favourite['result'] == true){ 
                        ?>
                        <form action="favourites_remove_db.php" method="POST" class="form-group">
                            <input type="hidden" name="product_id" value="<?php echo $product_id ?>" class="form-control"/>
                            <input type="hidden" name="user_id" value="<?php echo $user_id?>" class="form-control"/>
                            <input type="hidden" name="from_product" value="<?php echo $favourite['result']?>" class="form-control"/>
                            <button type="submit" class="btn btn-danger">Odstrani iz priljubljenih</button>
                        </form>
                    <?php
                    }}else{
                    ?>
                    <form action="favourites_add_db.php" method="POST" class="form-group">
                        <input type="hidden" name="product_id" value="<?php echo $product_id ?>" class="form-control"/>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" class="form-control"/>
                        <button type="submit" class="btn btn-warning">Dodaj pod priljubljene</button>
                    </form>
                <?php }}; ?>
            </div>
            <div class="col-md-4">
                <h1> <?php echo $r['product_title']?></h2>
            </div>
        </div>
            
            <hr/>
            <p><b>Opis : <?php echo $r['description']?> </b></p>
            <p>Cena : <?php echo $r['price']?>€</p> 
            <p>Povezava URL izdelka v spletni trgovini : <a href="<?php echo $r['online_store_product_url']?>"><?php echo $r['online_store_product_url']?></a></p>
            <p>Dodano : <?php echo $r['date_add']?> </p>
            <p>Spremenjeno : <?php echo $r['date_modify']?></p>
            <p>Ime trgovine : <?php echo $r['title']?></p>
            <p>Opis trgovine : <?php echo $r['description']?></p>
            <p style="display: inline-block;max-width: 30%;height: 1.5em;overflow: hidden;text-overflow: ellipsis;white-space: nowrap; ">Lokacija : <a href="<?php echo $r['location']?>"><?php echo $r['location']?></a></p>
            <p>Spletna stran trgovine : <a href="<?php echo $r['site_link_url']?>"><?php echo $r['site_link_url']?></a></p>
            <p>Povezava do spletne trgovine : <a href="<?php echo $r['online_store_link_url']?>"><?php echo $r['online_store_link_url']?></a></p>
            <p>Slika izdelka : </p>
            <img src="<?php echo $r['product_image']?>" alt="<?php echo $r['product_image_description']?>" width="40%">
        </div>



</div>


    </div>
</div>

<?php
    include_once "footer.php";
?>