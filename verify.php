<?php
    include_once "header.php";
    include_once "db.php";
    adminOnly();
?>
<link src="css/verify.css" type="stylesheet"/>
<h1>Verifikacija</h1>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Store title</th>
                <th>Store Description</th>
                <th>Location</th>
                <th>Site URL</th>
                <th>Online store URL</th>
            </tr>
        </thead>
    <tbody>
    
    <?php
        $query = "SELECT u.*, s.* FROM users as u INNER JOIN stores AS s ON u.store_id = s.id_store WHERE verified = 0";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        while($r = $stmt->fetch()){
            echo '<tr>';

                echo '<td><form action="verify_db.php" method="POST" class="form-group">';
                    echo '<input type="hidden" name="user_id" value="'.$r['id_user'].'" class="form-control"/>';
                    echo '<button type="submit" class="btn btn-success">Verify</button>';
                echo '</form></td>';

                echo '<td>'.$r['name'].'</td>'; 
                echo '<td>'.$r['surname'].'</td>'; 
                echo '<td>'.$r['email'].'</td>'; 
                echo '<td>'.$r['title'].'</td>'; 
                echo '<td>'.$r['description'].'</td>'; 
                echo '<td>'.$r['location'].'</td>'; 
                echo '<td>'.$r['site_link_url'].'</td>'; 
                echo '<td>'.$r['online_store_link_url'].'</td>'; 

            echo '</tr>';
        }
    ?>
    </tbody>
    </table>
</div>

<?php
    include_once "footer.php"
?>