<?php
  session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href = "../css/reset.css" rel="stylesheet">
    <link href = "../css/bootstrap.min.css" rel="stylesheet">
    <link href = "../css/nav.css" rel="stylesheet">
    <link href = "../css/shop.css" rel="stylesheet">
    <title>Shop - Covitesse</title>
</head>
<body>
<?php
  $page = "shop";
  include_once("imports/navbar.php");
  include_once("imports/database.php");
  $datab = new Database();
  $datab->connect();
  $result = $datab->query("SELECT * FROM products");
  
?>

<div class="container-fluid">
  <?php
    $i = 0;
    while($row = $result->fetch_assoc()){
      if($i == 0){
        ?>
        <div class="row">
        <?php
      }
      $title = $row["name"];
      $description = $row["description"];
      $picture = "../" . $row["picture"];
      include("imports/productcard.php");
      $i++;
      if($i == 3){
        ?>
        </div>
        <?php
        $i = 0;
      }
    }
  ?>
</div>

</body>
</html>

<script src="../js/bootstrap.bundle.min.js"></script>