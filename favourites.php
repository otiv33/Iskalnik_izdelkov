<?php
    include_once "header.php";
    include_once "db.php";

    storeOwnerCheckRegisteredStore();
    
    $user_id = $_SESSION['user_id'];

    $query = "SELECT p.* FROM favourites AS f INNER JOIN products AS p ON f.product_id = p.id_product WHERE f.user_id = ?;";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);

?>
<h1>Vaš seznam priljubljenih</h1>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                
                <th></th>
                <th>Product title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Online store product URL</th>
                <th>Date added</th>
                <th>Date modified</th>
                <th>Product image</th>
            </tr>
        </thead>
    <tbody>
    <?php
        while($r = $stmt->fetch()){
            echo '<tr onClick="document.forms[\'product-form-'.$r['id_product'].'\'].submit();">';

                echo '<form name="product-form-'.$r['id_product'].'" action="product.php" method="POST" class="form-group">';
                    echo '<input type="hidden" name="product_id" value="'.$r['id_product'].'" class="form-control"/>';
                    echo '<input type="hidden" name="user_id" value="'.$user_id.'" class="form-control"/>';
                    //echo '<button type="submit" class="btn btn-link">Oglej si izdelek</button>';
                echo '</form>';

                echo '<td><form action="favourites_remove_db.php" method="POST" class="form-group">';
                    echo '<input type="hidden" name="product_id" value="'.$r['id_product'].'" class="form-control"/>';
                    echo '<input type="hidden" name="user_id" value="'.$user_id.'" class="form-control"/>';
                    echo '<button type="submit" class="btn btn-danger">Odstrani iz priljubljenih</button>';
                echo '</form></td>';

                echo '<td>'.$r['product_title'].'</td>'; 
                echo '<td>'.$r['product_description'].'</td>'; 
                echo '<td>'.$r['price'].'€</td>'; 
                echo '<td>'.$r['online_store_product_url'].'</td>'; 
                echo '<td>'.$r['date_add'].'</td>'; 
                echo '<td>'.$r['date_modify'];
                echo '<td><a href="'.$r['product_image'].'"><img src="'.$r['product_image'].'" width="20%"></a><td>';

            echo '</tr>';
        }
    ?>
    </tbody>
    </table>
</div>

<?php
    include_once "footer.php"
?>