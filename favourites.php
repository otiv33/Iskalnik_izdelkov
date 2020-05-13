<?php
    include_once "header.php";
    include_once "db.php";
    
    $user_id = $_SESSION['user_id'];

    $query = "SELECT p.* FROM favourites AS f INNER JOIN products AS p ON f.product_id = p.id_product WHERE f.user_id = ?;";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);

?>
<h1>Vaš seznam priljubljenih</h1>
<div>
    <?php
        while($r = $stmt->fetch()){
            echo '<div class="container">';
                echo '<div class="d-flex justify-content-start" style="border: 1px solid black"><ul>';
                    echo '<li><b>Product : </b>'.$r['product_title'].', '.$r['description'].', '.$r['price'].'€, '.$r['online_store_product_url'].', '.$r['date_add'].', '.$r['date_modify'].'</li>';
                echo '<div class="d-flex justify-content-start">';
                    echo '<form action="product.php" method="POST" class="form-group">';
                        echo '<input type="hidden" name="product_id" value="'.$r['id_product'].'" class="form-control"/>';
                        echo '<input type="hidden" name="user_id" value="'.$user_id.'" class="form-control"/>';
                        echo '<button type="submit" class="btn btn-link">Oglej si podrobnosti o izdelku</button>';
                    echo '</form>';

                    echo '<form action="favourites_remove_db.php" method="POST" class="form-group">';
                        echo '<input type="hidden" name="product_id" value="'.$r['id_product'].'" class="form-control"/>';
                        echo '<input type="hidden" name="user_id" value="'.$user_id.'" class="form-control"/>';
                        echo '<button type="submit" class="btn btn-danger">Odstrani iz priljubljenih</button>';
                    echo '</form>';
                echo '</div>';


            echo '</ul></div>';
            echo '</div>';
        }
    ?>
    </div>
</div>

<?php
    include_once "footer.php"
?>