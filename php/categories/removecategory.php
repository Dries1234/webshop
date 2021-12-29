<?php
    include_once("../imports/handler.php");
    $id = htmlspecialchars($_POST["id"]);
    include_once("../imports/database.php");
    $db = new Database();
    $db->connect();
    $db->prepare("UPDATE categories SET active = 0 WHERE categoryID=?");
    $db->bind_param("i", [$id]);
    $db->execute();
?>