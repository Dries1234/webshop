<?php
session_start()
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
  <link href="../css/shop.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../js/shop.js"></script>
  <title>Shop - Covitesse</title>
</head>

<body>

  <?php
  $page = "shop";
  include_once("imports/navbar.php");
  include_once(__DIR__ . "/imports/database.php");
  $datab = new Database();
  $datab->connect();
  ?>

  <div class="container filterbar">

    <form onsubmit="return getProducts()">
      <div class="row">
        <div class="form-group">

          <select name="category" id="category" class="form-select select col-md-2">
            <option value="nothing" selected>Select a category</option>

            <?php
            $result = $datab->query("SELECT * FROM categories");
            while ($row = $result->fetch_assoc()) {
              $name = htmlspecialchars($row["name"]);
            ?>

              <option class="dropdown-item" ><?php echo ($name); ?></option>
            <?php
            }
            ?>
          </select>
          <div class="col-md-2 search">
            <input type="text" name="search" id="search" class="form-control" placeholder="Search term">
          </div>
        </div>
      </div>
      <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block filter">Filter</button>
  </div>
 
  </form>
  </div>
  <div class="container-fluid" id="articles">

  </div>
</body>

</html>

<script src="../js/bootstrap.bundle.min.js"></script>