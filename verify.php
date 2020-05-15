<?php
    include_once "header.php";
    include_once "db.php";
    adminOnly();
?>
<link src="css/verify.css" type="stylesheet"/>
<h1>Verifikacija</h1>
<div>
    
    <?php
        $query = "SELECT u.*, s.* FROM users as u INNER JOIN stores AS s ON u.store_id = s.id_store WHERE verified = 0";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        while($r = $stmt->fetch()){
            echo '<div class="container" style="border: 1px solid black"><ul><form action="verify_db.php" method="POST" class="form-group">';
                echo '<input type="hidden" name="user_id" value="'.$r['id_user'].'" class="form-control"/>';
                echo '<li><b>User : </b>'.$r['name'].', '.$r['surname'].', '.$r['email'].'</li>';
                echo '<li><b>Store : </b>'.$r['title'].', '.$r['description'].', '.$r['location'].', '.$r['site_link_url'].', '.$r['online_store_link_url'].'</li>';
                echo '<button type="submit" class="btn btn-success">Verify</button>';
            echo '</form></ul></div>';
        }
    ?>

</div>

<?php
    include_once "footer.php"
?>