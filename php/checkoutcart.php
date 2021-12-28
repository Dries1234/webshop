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
            if($product["stock"] < $amount)
            {
              http_response_code("418");
              echo json_encode(['product' => $product["name"]]);
              exit();
            }
            else{
              $price = htmlspecialchars($product["price"]);
              $sum += $price * $amount;
            }
          }
        }
      }
    }
    $db->prepare("INSERT INTO orders(user,orderDate,price,complete) VALUES(?,?,?,?)");
    $email = htmlspecialchars($_SESSION["email"]);
    $orderDate = date("Y-m-d H:i:s");
    $db->bind_param("ssi", [$email,$orderDate,$sum, (int)true]);
    $db->execute();
    $orderId = $db->insert_id();
    foreach ($_SESSION["cart"] as $id => $amount) {
        $db->prepare("INSERT INTO productOrder(orderID, productID, amount) VALUES(?,?,?)");
        $db->bind_param("iii", [$orderId, $id,$amount]);
        $db->execute();
    }
    http_response_code("200");
    $_SESSION["cart"] = array();

?>