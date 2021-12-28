<?php
    include_once("../imports/database.php");
    $name = htmlspecialchars($_POST["name"]);
    $db = new Database();
    $db->connect();

    $db->prepare("INSERT INTO categories (name) VALUES (?)");
    $db->bind_param("s", [$name]);
    $db->execute();

    header("Location: categories.php");
?>