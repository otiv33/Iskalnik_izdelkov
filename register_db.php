<?php
    include_once "session.php";
    include_once "db.php";

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $pass1 = $_POST['pass'];
    $pass2 = $_POST['pass2'];
    if($_POST['user_type'] == "user"){
        $user_type = 3;
        $verified = 1;
    }else if($_POST['user_type'] == "store owner"){
        $user_type = 2;
        $verified = 0;
    }else{
        header("Location: registration.php");
        die();
    }

    $query = "SELECT email FROM users WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);
    if(!isset($stmt->fetch['email'])){
        echo '<h1>This email already exists!</h1>';
        echo '<button><a href="register.php">Go back to registration</a></button>';
    }else{
        if(!empty($name) && !empty($surname) && !empty($email) && !empty($pass1) && ($pass1 == $pass2) && !empty($user_type)){
            $pass = password_hash($pass1, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (name, surname, email, pass, verified, user_type_id) VALUES (?,?,?,?,?,?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$name, $surname, $email, $pass, $verified, $user_type]);
            //Auto login
            include_once "login_check.php";
        }else{
            header("Location: registration.php");
            die();
        }
    }




?>