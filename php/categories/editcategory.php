<?php
    include_once("../imports/database.php");
    $id = htmlspecialchars($_POST["id"]);
    $name = htmlspecialchars($_POST["name"]);

    $db = new Database();
    $db->connect();
    $db->prepare("UPDATE categories SET name = ? WHERE categoryID = ?");
    $db->bind_param("si", [$name,$id]);
    $db->execute();

    header("Location: categories.php");

?>