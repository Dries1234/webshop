<?php
    include_once("../imports/database.php");
    $name = htmlspecialchars($_POST["name"]);
    $categoryname = htmlspecialchars($_POST["category"]);
    $stock = htmlspecialchars($_POST["stock"]);
    $price = htmlspecialchars($_POST["price"]);
    $picture = htmlspecialchars($_POST["picture"]);
    $description = htmlspecialchars($_POST["description"]);

    $db = new Database();
    $db->connect();
    $db->prepare("SELECT * FROM categories WHERE name = ?");
    $db->bind_param("s", [$categoryname]);
    $db->execute();
    $result = $db->get_result();
    $category = $result->fetch_assoc();

    $db->prepare("INSERT INTO products (categoryID,name,stock,price,picture,description) VALUES (?,?,?,?,?,?)");
    $db->bind_param("isidss", [$category["categoryID"], $name,$stock,$price,$picture,$description]);
    $db->execute();

    header("Location: products.php");
?>