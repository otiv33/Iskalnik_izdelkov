<?php
    include_once "header.php";
    include_once "db.php";

    $search_input = $_POST['search_input'];

    if(!empty($search_input)){
        
        $query = 'SELECT * FROM products WHERE LOWER(product_title) LIKE LOWER("%'.$search_input.'%") OR LOWER(description) LIKE LOWER("%'.$search_input.'%")';
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }else{
        $query = "SELECT TOP 100 * FROM products";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }
?>
<h3 style="text-align:center">Top results for keyword : "<?php echo $search_input?>"</h3>
<hr/>
<div class="d-flex justify-content-center">
    <?php while($r = $stmt->fetch()){
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
