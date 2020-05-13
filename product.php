<?php
    include_once "header.php";
    include_once "db.php";
    
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    $query = "SELECT p.*, s.* FROM products AS p INNER JOIN stores AS s ON p.store_id = s.id_store WHERE id_product = ?;";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$product_id]);
    $r = $stmt->fetch()
?>

 <div class="container">
    <ul>
    <form action="favourites_db.php" method="POST" class="form-group">
    <input type="hidden" name="product_id" value="<?php echo $product_id ?>" class="form-control"/>
        <h1> <?php echo $r['product_title']?></h2>
        <hr/>
        <p><b>Opis : <?php echo $r['description']?> </b></p>
        <p>Cena : <?php echo $r['price']?>€</p> 
        <p>Povezava URL izdelka v spletni trgovini : <?php echo $r['online_store_product_url']?></p>
        <p>Dodano : <?php echo $r['date_add']?> </p>
        <p>Spremenjeno : <?php echo $r['date_modify']?></p>
        <p>Ime trgovine : <?php echo $r['title']?></p>
        <p>Opis trgovine : <?php echo $r['description']?></p>
        <p>Lokacija : <?php echo $r['location']?></p>
        <p>Spletna stran trgovine : <?php echo $r['site_link_url']?></p>
        <p>Povezava do spletne trgovine : <?php echo $r['online_store_link_url']?></p>

    <button type="submit" class="btn btn-warning">Dodaj pod priljubljene</button>
</form></ul></div>


    </div>
</div>

<?php
    include_once "footer.php"
?>