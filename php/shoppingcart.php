<?php
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

  if(count($_SESSION["cart"]) <= 0) {
  ?>
    <div class="container">
      <div class="col-md-12 text-center">
        <h1 class="text-center display-4">Your cart is empty</h1>
        <button id="redirect" class="btn btn-primary text-center">Add products to cart</button>
      </div>
    </div>
  <?php
  }
  else{
  ?>
  <div class="container-fluid">
  <div class="row">
  <div class="container col-lg-6 float-end">
    <div class="col-md-12 text-center">
      <h1 class="text-center display-5">Products in cart</h1>
      <?php
        
        $datab->prepare("SELECT * FROM products");
        $datab->execute();
        $products = $datab->get_result();
        if($products){
          foreach($_SESSION["cart"] as $id => $amount){
            while($product = $products->fetch_assoc()){
              if($id == $product["productID"]){
                $picture = "../" . htmlspecialchars($product["picture"]);
                $title = htmlspecialchars($product["name"]);
                $price = htmlspecialchars($product["price"]);
                $sum += $price * $amount;
                ?>
                <div class="row justify-content-center">
                  <?php
                include("imports/productcard.php");
                break;
                ?>
              </div>
              <?php
              }
            }
          }
        }
      ?>
    </div>
      </div>
  </div>
      </div>
  <div class="container col-lg-6 float-start text-center">
    <h1 class="text-center display-6">Total: €<?php echo($sum) ?></h1>
    <button class="btn btn-success">Checkout</button>
  </div>
  <?php
  }
  ?>
</body>

</html>