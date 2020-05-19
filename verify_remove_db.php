<?php
    include_once "session.php";
    include_once "db.php";
    adminOnly();

    $user_id = $_POST['user_id'];
    
    if(!empty($user_id)){
        $query = "DELETE FROM users WHERE id_user = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_id]);
    }
    header("Location: verify.php");
    die();

?>