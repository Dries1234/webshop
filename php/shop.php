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
  $category = NULL;
  $search = NULL;
  if(isset($_POST["submit"]))
  {
    if(isset($_POST["category"])){
      if($_POST["category"] != "no"){
        $category = htmlspecialchars($_POST["category"]);
      }
    }
    if(isset($_POST["search"])){
      $search = htmlspecialchars($_POST["search"]);
    }
  }
  $page = "shop";
  include_once("imports/navbar.php");
  include_once("imports/database.php");
  $datab = new Database();
  $datab->connect();
  $result = $datab->query("SELECT * FROM categories");

  ?>

  <div class="container filterbar">

    <form method="post" action="./shop.php">
      <div class="row">
        <div class="form-group">

          <select name="category" class="form-select select col-md-2">
            <option value="no" selected>Select a category</option>

            <?php
            while ($row = $result->fetch_assoc()) {
              $name = htmlspecialchars($row["name"]);
            ?>

              <option class="dropdown-item" "<?php echo ($name); ?>" href="#"><?php echo ($name); ?></option>
            <?php
            }
            ?>
          </select>
          <div class="col-md-2 search">
            <input type="text" name="search" class="form-control" placeholder="Search term">
          </div>
        </div>
      </div>
      <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block filter">Filter</button>
  </div>
 
  </form>
  </div>
  <?php
  $query;
  $selected;
  $products;
  if($category != NULL && $search == NULL)
  {
    $datab->prepare("SELECT * FROM categoryID WHERE name=?");
    $datab->bind_param("s" , [$category]);
    $datab->execute();
    $categories = $datab->get_result();
    if($result)
    {
      $entries = mysqli_fetch_assoc($result);

      $query = "SELECT * FROM products WHERE categoryID=" . $entries["categoryID"];
    }
    $selected = $datab->query($query);
  }

  else if($search != NULL && $category == NULL){
    $datab->prepare("SELECT * FROM products WHERE name=?");
    $datab->bind_param("s" , [$search]);
    $datab->execute();
    $selected = $datab->get_result();
  }
  else if($search!=NULL && $category != NULL){
    $datab->prepare("SELECT * FROM categoryID WHERE name=?");
    $datab->bind_param("s" , $category);
    $datab->execute();
    $categories = $datab->get_result();
    if($result)
    {
      $entries = mysqli_fetch_assoc($result);

      $query = "SELECT * FROM products WHERE categoryID=? AND name=?";
      $datab->prepare($query);
      $datab->bind_param("ss", [$entries["categoryID"], $search]);
    }
    $datab->execute();

    $selected = $datab->get_result();
  }
  else{
    $datab->prepare("SELECT * FROM products");
    $datab->execute();
    $selected = $datab->get_result();
  }

  ?>

  <div class="container-fluid">
    <?php
    $i = 0;
    while ($row = $selected->fetch_assoc()) {
      if ($i == 0) {
    ?>
        <div class="row">
        <?php
      }
      $title = htmlspecialchars($row["name"]);
      $description = htmlspecialchars($row["description"]);
      $picture = "../" . htmlspecialchars($row["picture"]);
      include("imports/productcard.php");
      $i++;
      if ($i == 3) {
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