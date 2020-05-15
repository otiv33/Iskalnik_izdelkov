<?php
    include_once "header.php";
    include_once "db.php";
    
    adminOnly();

    $user_id = $_SESSION['user_id'];

    if(!is_admin()){
        echo '<script type="text/javascript">'; 
        echo 'alert("You can\'t use this option, you are not an administrator.");'; 
        echo 'window.location.href = "index.php";';
        echo '</script>';
    }else{
?>
<h1>Urejanje izdelkov</h1>
<div>
    <div>
    <?php
        $query = "SELECT * FROM products";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        while($r = $stmt->fetch()){
            echo '<div class="container" style="border: 1px solid black">';
            echo '<ul><form action="product_edit.php" method="POST" class="form-group">';
                echo '<li><b>Product : </b>'.$r['product_title'].', '.$r['description'].', '.$r['price'].'€, '.$r['online_store_product_url'].', '.$r['date_add'].', '.$r['date_modify'].'<img src="'.$r['product_image'].'" height="100px" alt="product image"> </li>';
                echo '<input type="hidden" name="product_id" value="'.$r['id_product'].'" class="form-control"/>';
                echo '<button type="submit" class="btn btn-warning">Edit</button>';
            echo '</form>';
                echo '<form action="product_delete_db.php" method="POST" class="form-group">';
                echo '<input type="hidden" name="product_id" value="'.$r['id_product'].'" class="form-control"/>';
                echo '<button type="submit" class="btn btn-danger">Delete</button>';
            echo '</form>';
            echo '<form action="product.php" method="POST" class="form-group">';
                echo '<input type="hidden" name="product_id" value="'.$r['id_product'].'" class="form-control"/>';
                echo '<input type="hidden" name="user_id" value="'.$user_id.'" class="form-control"/>';
                echo '<button type="submit" class="btn btn-link">Oglej si podrobnosti o izdelku</button>';
            echo '</form>';
            echo '</ul></div>';
        }
    }
    ?>
    </div>
</div>

<?php
    include_once "footer.php"
?>