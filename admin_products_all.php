<?php
    include_once "header.php";
    include_once "db.php";
    
    adminOnly();

    $user_id = $_SESSION['user_id'];

    if(!is_admin()){
        echo '<script type="text/javascript">'; 
        echo 'alert("You can\'t use this option</td>'; echo '<td>you are not an administrator.");'; 
        echo 'window.location.href = "index.php";';
        echo '</script>';
    }else{
?>
<h1>Urejanje izdelkov</h1>

    <div class="table-responsive">
    <table class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th>ID</th>
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
        $query = "SELECT * FROM products";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        while($r = $stmt->fetch()){
            echo '<tr data-toggle="tooltip" title="Klikni na izdelek za ogled podrobnosti." onClick="document.forms[\'product-form-'.$r['id_product'].'\'].submit();">';

                //On click redirect to product
                echo '<form name="product-form-'.$r['id_product'].'" action="product.php" method="POST" class="form-group">';
                    echo '<input type="hidden" name="product_id" value="'.$r['id_product'].'" class="form-control"/>';
                    echo '<input type="hidden" name="user_id" value="'.$user_id.'" class="form-control"/>';
                    //echo '<button type="submit" class="btn btn-link">Oglej si izdelek</button>';
                echo '</form>';

                echo '<td><form action="product_edit.php" method="POST" class="form-group">';
                    echo '<input type="hidden" name="product_id" value="'.$r['id_product'].'" class="form-control"/>';
                    echo '<button type="submit" class="btn btn-warning">Edit</button>';
                echo '</form></td>';

                echo '<td><form action="product_delete_db.php" method="POST" class="form-group">';
                    echo '<input type="hidden" name="product_id" value="'.$r['id_product'].'" class="form-control"/>';
                    echo '<button type="submit" class="btn btn-danger">Delete</button>';
                echo '</form></td>';

                echo '<td>'.$r['id_product'].'</td>';
                echo '<td>'.$r['product_title'].'</td>'; 
                echo '<td>'.$r['product_description'].'</td>'; 
                echo '<td>'.$r['price'].'€</td>'; 
                echo '<td><a href="'.$r['online_store_product_url'].'">'.$r['online_store_product_url'].'</a></td>'; 
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