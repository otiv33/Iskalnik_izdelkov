<?php
    include_once "header.php";
    include_once "db.php";
    
    $user_id = $_SESSION['user_id'];

    $query = "SELECT verified FROM users WHERE id_user = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);
    $verified = $stmt->fetch()['verified'];
    if($verified == 0){
        echo '<script type="text/javascript">'; 
        echo 'alert("You can\'t use this option until you are verified");'; 
        echo 'window.location.href = "index.php";';
        echo '</script>';
    }else{
?>
<h1>Urejanje in dodajanje izdelkov</h1>
    <div>
        <form action="product_add.php" method="GET">
            <button type="submit" class="btn btn-info">Dodaj izdelek</button>
        </form>
    </div>
    <br/>
    <div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th></th>
                <th></th>
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
        $query = "SELECT * FROM products WHERE user_id = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_id]);

        while($r = $stmt->fetch()){
            echo '<tr>';

                echo '<td><form action="product.php" method="POST" class="form-group">';
                    echo '<input type="hidden" name="product_id" value="'.$r['id_product'].'" class="form-control"/>';
                    echo '<input type="hidden" name="user_id" value="'.$user_id.'" class="form-control"/>';
                    echo '<button type="submit" class="btn btn-link">Oglej si izdelek</button>';
                echo '</form></td>';

                echo '<td><form action="product_edit.php" method="POST" class="form-group">';
                    echo '<input type="hidden" name="product_id" value="'.$r['id_product'].'" class="form-control"/>';
                    echo '<button type="submit" class="btn btn-warning">Edit</button>';
                echo '</form></td>';

                    echo '<td><form action="product_delete_db.php" method="POST" class="form-group">';
                    echo '<input type="hidden" name="product_id" value="'.$r['id_product'].'" class="form-control"/>';
                    echo '<button type="submit" class="btn btn-danger">Delete</button>';
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
    }
    ?>
    </tbody>
    </table>
</div>

<?php
    include_once "footer.php"
?>