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
    <div>
        <form action="product_add.php" method="GET">
            <button type="submit" class="btn btn-info">Dodaj izdelek</button>
        </form>
    </div>
    <div>
    <?php
        $query = "SELECT * FROM products WHERE user_id = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_id]);

        while($r = $stmt->fetch()){
            echo '<div class="container" style="border: 1px solid black"><ul><form action="product_edit.php" method="POST" class="form-group">';
                echo '<input type="hidden" name="product_id" value="'.$r['id_product'].'" class="form-control"/>';
                echo '<li><b>Product : </b>'.$r['product_title'].', '.$r['description'].', '.$r['price'].'€, '.$r['online_store_product_url'].', '.$r['date_add'].', '.$r['date_modify'].'<img src="'.$r['product_image'].'" height="100px" alt="product image"> </li>';
                echo '<button type="submit" class="btn btn-warning">Edit</button>';
            echo '</form></ul></div>';
        }
    }
    ?>
    </div>
</div>

<?php
    include_once "footer.php"
?>