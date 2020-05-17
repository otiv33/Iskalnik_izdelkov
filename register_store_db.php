<?php
    include_once "session.php";
    include_once "db.php";

    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $site_link_url = $_POST['site_link_url'];
    $online_store_link_url = $_POST['online_store_link_url'];
    $user_id = $_POST['user_id'];

    if(!empty($title) && !empty($description) && !empty($location) && !empty($user_id)){
        $query = "INSERT INTO stores (title, description, location, site_link_url, online_store_link_url) VALUES (?,?,?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$title, $description, $location, $site_link_url, $online_store_link_url]);
        $store_id = $pdo->lastInsertId();
        $_SESSION['store_id'] = $store_id; //Update session variable because of checks

        $query = "UPDATE users SET store_id = ? WHERE id_user = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$store_id, $user_id]);
    
    if(empty($user_id)){
        header("Location: login.php");
        die();
    }
    }else{
        header("Location: register_store.php");
        die();
    }
    
    header("Location: index.php");

?>