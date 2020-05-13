<?php
    include_once "header.php";
    include_once "db.php";

    $query = "SELECT id_product, product_image, product_image_description, product_title, description, price FROM products ORDER BY RAND() LIMIT 10;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
?>

    <div class="conatiner-fluid ">
        <h1 class="d-flex justify-content-center">Dober dan <?php if(!empty($_SESSION['name']) && !empty($_SESSION['surname'])) echo $_SESSION['name'].' '.$_SESSION['surname']?></h1>
        <hr/>
        <div class="d-flex justify-content-center">
        <?php
            while($r = $stmt->fetch()){
                echo '<div class="card d-flex justify-content-center" style="width: 18rem;">';
                echo    '<img class="card-img-top" src="'.$r['product_image'].'" alt="'.$r['product_image_description'].'">';
                echo    '<div class="card-body">';
                echo        '<h5 class="card-title"><b>'.$r['product_title'].'</b></h5>';
                echo        '<p class="card-text">'.$r['description'].'</p>';
                echo        '<p class="card-text"><b>'.$r['price'].'€</b></p>';
                echo        '<form action="product.php" method="POST"><button type="submit" class="btn btn-link" name="product_id" value="'.$r['id_product'].'">Poglej ponudbo</button></form>';
                echo    '</div>';
                echo '</div>';
            }
        ?>
        </div>
    </div>
<br/>
<br/>
<br/>
<br/>
<br/>

<?php
    include_once "footer.php";
?>