<?php
    session_start();
    include_once("imports/database.php");
    $db = new Database();
    $db->connect();
    $db->prepare("SELECT * FROM products");
    $db->execute();
    $products = $db->get_result();
    $sum = 0;
    if ($products) {
      foreach ($_SESSION["cart"] as $id => $amount) {
        while ($product = $products->fetch_assoc()) {
          if ($id == $product["productID"]) {
            $price = htmlspecialchars($product["price"]);
            $sum += $price * $amount;
          }
        }
      }
    }
    $db->prepare("INSERT INTO orders(user,orderDate,price,complete) VALUES(?,?,?,?)");
    $email = htmlspecialchars($_SESSION["email"]);
    $orderDate = date("Y-m-d");
    $db->bind_param("ssi", [$email,$orderDate,$sum, (int)true]);
    $db->execute();
    $orderId = $db->insert_id();
    foreach ($_SESSION["cart"] as $id => $amount) {
        $db->prepare("INSERT INTO productOrder(orderID, productID, amount) VALUES(?,?,?)");
        $db->bind_param("iii", [$orderId, $id,$amount]);
        $db->execute();
    }
    $_SESSION["cart"] = array();

?>