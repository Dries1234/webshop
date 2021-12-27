<?php
    include_once("imports/database.php");
    $email = htmlspecialchars($_POST["email"]);
    $db = new Database();
    $db->connect();
    $db->prepare("SELECT * from users WHERE email=?");
    $db->bind_param("s", [$email]);
    $db->execute();
    $users = $db->get_result();
    $user = $users->fetch_assoc();
    if($user["admin"]){
        $db->prepare("UPDATE users SET admin = 0 WHERE email=?");
    }
    else{
        $db->prepare("UPDATE users SET admin = 1 WHERE email=?");
    }
    $db->bind_param("s", [$email]);
    $db->execute();
?>