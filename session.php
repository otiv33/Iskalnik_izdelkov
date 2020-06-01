<?php
    session_start();
    
    $allow_url = ['/iskalnik_izdelkov/search_results.php','/iskalnik_izdelkov/product.php','/iskalnik_izdelkov/index.php','/iskalnik_izdelkov/login.php','/iskalnik_izdelkov/login_check.php','/iskalnik_izdelkov/register.php',
    '/iskalnik_izdelkov/register_db.php','/iskalnik_izdelkov/register_store_db.php','/iskalnik_izdelkov/register_store.php'];

    if( !isset($_SESSION['user_id']) && !in_array($_SERVER['REQUEST_URI'],$allow_url) ){
        header("Location: login.php");
        die();
    }

    function is_admin () {
        if ($_SESSION['user_type'] == 'Administrator') {
            return true;
        } else {
            return false;
        }
    }
    function is_store_owner () {
        if ($_SESSION['user_type'] == 'Store owner') {
            return true;
        } else {
            return false;
        }
    }

    function adminOnly() {
        if (!is_admin()){
            header("Location: index.php");
            die();
        }
    }

    function storeOwnerCheckRegisteredStore(){
        if(isset($_SESSION['user_type'])){
            if ($_SESSION['user_type'] == "Store owner" && empty($_SESSION['store_id'])) {
                header("Location: register_store.php");
            }
        }
    }

?>