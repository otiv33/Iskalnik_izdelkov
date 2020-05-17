<?php
    include_once "header.php";
    include_once "db.php";

    $search_input = $_POST['search_input'];

    if(!empty($search_input)){
        
        $query = 'SELECT * FROM products WHERE LOWER(product_title) LIKE LOWER("%'.$search_input.'%") OR LOWER(product_description) LIKE LOWER("%'.$search_input.'%")';
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }else{
        $query = "SELECT TOP 100 * FROM products";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }
?>

<link rel="stylesheet" type="text/css" href="css/myCSS.css">

<h3 style="text-align:center">Top results for keyword : "<?php echo $search_input?>"</h3>
<hr/>
<div class="container-fluid">
    <?php while($r = $stmt->fetch()){
        if(empty($r['product_image']))
            $r['product_image'] = 'img/no_image.jpg';
        
        echo '<div class="row d-flex justify-content-center">';
        echo '<div class="col-5">';
        echo '<div class="card-deck">';

        echo '<div class="card p-2" onClick="document.forms[\'product-form\'].submit();">';
        echo    '<img class="card-img-top" src="'.$r['product_image'].'" alt="'.$r['product_image_description'].'">';
        echo    '<div class="card-body">';
        echo        '<h5 class="card-title"><b>'.$r['product_title'].'</b></h5>';
        echo        '<p class="card-text">'.$r['product_description'].'</p>';
        echo        '<p class="card-text"><b>'.$r['price'].'€</b></p>';
        echo        '<form name="product-form" action="product.php" method="POST"><input type="hidden" name="product_id" value="'.$r['id_product'].'"/></form>';        echo    '</div>';
        echo '</div>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<br/>';
    }
    ?>
</div>
