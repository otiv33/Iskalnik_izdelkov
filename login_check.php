<?php
    include_once "session.php";
    include_once "alert.php";
    include_once "db.php";

    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];

    if(!empty($email) && !empty($pass)){
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);

        if($stmt->rowCount() == 1){
            $user = $stmt->fetch();
            if(password_verify($pass, $user['pass'])){
                //Vse je pravilno
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['surname'] = $user['surname'];
                $_SESSION['verified'] = $user['verified'];
                $query = "SELECT type FROM user_types WHERE id_user_type = ?;";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$user['user_type_id']]);
                $user_type = $stmt->fetch();
                $_SESSION['user_type'] = $user_type['type'];
                
                if(!empty($name) && $_SESSION['user_type'] == "Store owner"){
                    alert("Registration successfull, you will be automatically logged in.\n You will be redirected to the store registration site.");
                    header("Location: register_store.php");
                    die();
                }else if (!empty($name)){
                    alert("Registration successfull, you will be automatically logged in.");
                    header("Location: index.php");
                    die();
                }
                else{
                    alert("You have been successfully logged in.");
                    header("Location: index.php");
                    die();
                }
            }
        }
    }

    header("Location: login.php");
    die();
    
?>