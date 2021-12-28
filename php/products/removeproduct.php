<?php
    $id = htmlspecialchars($_POST["id"]);
    include_once("../imports/database.php");
    $db = new Database();
    $db->connect();
    $db->prepare("UPDATE products SET active = 0 WHERE productID=?");
    $db->bind_param("i", [$id]);
    $db->execute();
?>