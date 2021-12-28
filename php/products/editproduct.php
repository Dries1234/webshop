<?php
    include_once("../imports/database.php");
    $id = htmlspecialchars($_POST["id"]);
    $categoryname = htmlspecialchars($_POST["category"]);
    $name = htmlspecialchars($_POST["name"]);
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

    $db->prepare("UPDATE products SET categoryID = ?, name = ?, stock = ?, price = ?, picture = ?, description = ? WHERE productID = ?");
    $db->bind_param("isidssi", [$category["categoryID"], $name, $stock, $price, $picture, $description, $id]);
    $db->execute();

    header("Location: products.php");

?>