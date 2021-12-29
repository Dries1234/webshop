<?php
include_once("imports/handler.php");
session_start();
if (!isset($_SESSION["cart"])) {
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../css/reset.css" rel="stylesheet">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/nav.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../js/cart.js"></script>
  <title>Shopping Cart</title>
</head>

<body>
  <?php
  $sum = 0;
  $page = "shoppingcart";
  include_once("imports/navbar.php");
  include_once("imports/database.php");

  $datab = new Database();
  $datab->connect();

  if (count($_SESSION["cart"]) <= 0) {
  ?>
    <div class="container">
      <div class="col-md-12 text-center">
        <h1 class="text-center display-4">Your cart is empty</h1>
        <button id="redirect" class="btn btn-primary text-center">Add products to cart</button>
      </div>
    </div>
  <?php
  } else {
  ?>
    <div class="container-fluid mt-3">
      <div class="row">
        <div class="col-sm"></div>
        <div class="col-lg-8 card">
          <div class="card-body">
            <h4 class="card-title">Shopping cart</h4>

            <ul class="list-group list-group-flush">

            </ul>



            <?php

            $datab->prepare("SELECT * FROM products");
            $datab->execute();
            $products = $datab->get_result();
            if ($products) {
              foreach ($_SESSION["cart"] as $id => $amount) {
                while ($product = $products->fetch_assoc()) {
                  if ($id == $product["productID"]) {
                    $picture = "../" . htmlspecialchars($product["picture"]);
                    $title = htmlspecialchars($product["name"]);
                    $price = htmlspecialchars($product["price"]);
                    $sum += $price * $amount;
            ?>
                    <li class="list-group-item">
                      <div class="row">
                        <div class="col-1"><img src="<?php echo ($picture); ?>" class="img-fluid" alt="" srcset=""></div>
                        <div class="col-5">
                          <h6><?php echo ($title); ?></h6>
                        </div>
                        <div class="col-2">€<?php echo ($price); ?></div>
                        <div class="col-3 col-lg-2">
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" value="<?php echo ($amount); ?>" min="1" max="5" placeholder="" readonly="readonly">
                            <button type="button" class="btn btn-outline-danger">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                              </svg>
                            </button>
                          </div>
                        </div>
                      </div>
                    </li>
            <?php
                    break;
                  }
                }
              }
            }
            ?>
            <li class="list-group-item">
                      <div class="row">
                        <div class="col-6">
                          <h6>Total price:</h6>
                        </div>
                        <div class="col-2">€<?php echo($sum); ?></div>
                      </div>
                    </li>

            <div class="row">
              <div class="col"></div>
              <button class="col btn btn-primary btn-lg" id="checkout" type="submit">Checkout!</button>
              <div class="col"></div>
            </div>
          </div>
        </div>
        <div class="col-sm"></div>
      </div>
    </div>
  <?php
  }
  ?>


</body>

</html>
<script src="../js/bootstrap.bundle.min.js"></script>
