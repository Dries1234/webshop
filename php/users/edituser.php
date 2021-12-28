<?php
    include_once("../imports/database.php");
    $firstName = htmlspecialchars($_POST["name"]);
    $lastName = htmlspecialchars($_POST["lastname"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $billingAddress = htmlspecialchars($_POST["billing"]);
    $birthDate = htmlspecialchars($_POST["birthDate"]);
    $Address = htmlspecialchars($_POST["Address"]);
    $email = htmlspecialchars($_POST["email"]);

    $db = new Database();
    $db->connect();
    $db->prepare("UPDATE users SET firstName = ?, lastName = ?, phone = ?, billingAddress = ?, birthDate = ?, `Address` = ? WHERE email=?");
    $db->bind_param("sssssss", [$firstName, $lastName,$phone,$billingAddress,$birthDate, $Address, $email]);
    $db->execute();

    header("Location: users.php");

?>