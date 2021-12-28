<?php
    $email = htmlspecialchars($_POST["email"]);
    include_once("../imports/database.php");
    $db = new Database();
    $db->connect();
    $db->prepare("UPDATE users SET active = 0 WHERE email=?");
    $db->bind_param("s", [$email]);
    $db->execute();
?>