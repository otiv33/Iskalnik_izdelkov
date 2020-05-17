<?php
    include_once "header.php";
    include_once "db.php";

    storeOwnerCheckRegisteredStore();

    $query = "SELECT id_product, product_image, product_image_description, product_title, product_description, price FROM products ORDER BY RAND() LIMIT 10;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
?>
    <link rel="stylesheet" type="text/css" href="css/myCSS.css">

    <div class="conatiner-fluid ">
        <h1 class="d-flex justify-content-center">Dober dan <?php if(!empty($_SESSION['name']) && !empty($_SESSION['surname'])) echo $_SESSION['name'].' '.$_SESSION['surname']?></h1>
        <hr/>
        <p style="text-align:center"><b>Predlagani izdelki : </b></p>
        <div class="row d-flex wrap p-3 justify-content-center">
            <div class="col-12">
                <div class="card-deck">
        <?php
            $i = 0;
            $x = 4; //Number of cards in one row
            $flag = false;
            while($r = $stmt->fetch()){
                if(empty($r['product_image']))
                    $r['product_image'] = 'img/no_image.jpg';
                
                if($i/$x == 1){
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="row d-flex wrap p-3 justify-content-center">';
                        echo '<div class="col-12">';
                            echo '<div class="card-deck">';
                    $x=$x+$x;
                }

                echo '<div class="card p-2" onClick="document.forms[\'product-form\'].submit();">';
                echo        '<img class="card-img-top" src="'.$r['product_image'].'" alt="'.$r['product_image_description'].'">';
                echo    '<div class="card-body">';
                echo        '<h5 class="card-title"><b>'.$r['product_title'].'</b></h5>';
                echo        '<p class="card-text">'.$r['product_description'].'</p>';
                echo        '<p class="card-text"><b>'.$r['price'].'€</b></p>';
                echo        '<form name="product-form" action="product.php" method="POST"><input type="hidden" name="product_id" value="'.$r['id_product'].'"/></form>';
                echo    '</div>';
                echo '</div>';

                $i++;
            }
        ?>
        </div>
        </div>
        </div>
        </div>
    </div>
<br/>
<br/>
<br/>
<br/>
<br/>

<?php
    include_once "footer.php";
    //<button type="submit" class="btn btn-link" name="product_id" value="'.$r['id_product'].'">Poglej ponudbo</button>
?>

