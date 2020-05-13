<?php
    include_once "session.php";
    include_once "db.php";

    $user_id = $_POST['user_id'];
    
    if(!empty($user_id)){
        $query = "UPDATE users SET verified = 1 WHERE id_user = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_id]);
    }
    header("Location: verify.php");
    die();

?>