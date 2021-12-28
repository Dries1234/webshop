<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../../css/reset.css" rel="stylesheet">
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/nav.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../../js/products.js"></script>

  <title>Products</title>
</head>

<body>

  <?php
  $page = "admin";
  include_once("../imports/navbar.php");
  include_once("../imports/database.php");
  $db = new Database();
  $db->connect();
  $db->prepare("SELECT * FROM categories");
  $db->execute();
  $result = $db->get_result();

  ?>
  <button class="btn btn-success m-3" data-bs-toggle="modal" data-bs-target="#modaladd">Add product</button>

  <div class="modal fade" id="modaladd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="./addproduct.php" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Category</label>
              <select class="form-select" name="category">
                <?php
                while ($row = $result->fetch_assoc()) {
                  if ($row["active"]) {
                ?>
                    <option class="dropdown-item" selected><?php echo $row["name"] ?></option>
                <?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" placeholder="new name">
            </div>
            <div class="form-group">
              <label for="name">Stock</label>
              <input type="text" class="form-control" name="stock" placeholder="new stock">
            </div>
            <div class="form-group">
              <label for="name">Price</label>
              <input type="text" class="form-control" name="price" placeholder="new price">
            </div>
            <div class="form-group">
              <label for="name">picture</label>
              <input type="text" class="form-control" name="picture" placeholder="new picture">
            </div>
            <div class="form-group">
              <label for="name">description</label>
              <input type="text" class="form-control" name="description" placeholder="new description">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Product</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <div class="container-fluid mt-3">
    <li class="list-group-item">
      <div class="row">
        <div class="col-2">
          <h6>Name</h6>
        </div>
        <div class="col-2">
          <h6>Category</h6>
        </div>
        <div class="col-1">
          <h6>stock</h6>
        </div>
        <div class="col-1">
          <h6>price</h6>
        </div>
        <div class="col-2">
          <h6>picture</h6>
        </div>
        <div class="col-2">
          <h6>description</h6>
        </div>
      </div>
  </div>
  <?php

  $db->prepare("SELECT * FROM products");
  $db->execute();
  $products = $db->get_result();
  if ($products) {
  ?>
    <div class="container-fluid mt-3">
      <?php
      while ($product = $products->fetch_assoc()) {
        if ($product["active"]) {
          $db->prepare("SELECT * FROM categories WHERE categoryID = ?");
          $db->bind_param("i", [$product["categoryID"]]);
          $db->execute();
          $result = $db->get_result();
          $row = mysqli_fetch_array($result);
      ?>
          <li class="list-group-item">
            <div class="row">
              <div class="col-2">
                <?php
                echo ($product["name"]);
                ?>
              </div>
              <div class="col-2">
                <?php echo htmlspecialchars($row["name"]); ?>
              </div>
              <div class="col-1">
                <?php
                echo ($product["stock"]);
                ?>
              </div>
              <div class="col-1">
                <?php
                echo ($product["price"]);
                ?>
              </div>
              <div class="col-2">
                <img class="img-fluid" src="../../<?php echo ($product["picture"]); ?>" alt="Picture of the Product" />
              </div>
              <div class="col-2">
                <?php
                echo ($product["description"]);
                ?>
              </div>
              <div class="col-1 col-lg-2">
                <div class="input-group">
                  <button type="button" class="btn btn-outline-danger" onclick="removeProduct('<?php echo $product['productID'] ?>')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                    </svg>
                  </button>
                  <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#modal<?php echo $product['productID'] ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                      <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                    </svg>
                  </button>
                  </button>
                </div>
              </div>
            </div>
          </li>
          <div class="modal fade" id="modal<?php echo $product['productID'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Product</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./editproduct.php" method="post">
                  <div class="modal-body">
                    <div class="form-group d-none">
                      <input type="text" class="form-control" name="id" value="<?php echo $product['productID'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="name">Category</label>
                      <select class="form-select" name="category">
                        <option class="dropdown-item" selected><?php echo $row["name"] ?></option>
                        <?php
                        $db->prepare("SELECT * FROM categories WHERE categoryID <> ?");
                        $db->bind_param("i", [htmlspecialchars($row["categoryID"])]);
                        $db->execute();
                        $result = $db->get_result();

                        while ($cat = $result->fetch_assoc()) {
                          if ($cat["active"]) {
                            $name = htmlspecialchars($cat["name"]);
                        ?>

                            <option class="dropdown-item"><?php echo ($name); ?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name="name" value="<?php echo $product['name'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="name">Stock</label>
                      <input type="text" class="form-control" name="stock" value="<?php echo $product['stock'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="name">Price</label>
                      <input type="text" class="form-control" name="price" value="<?php echo $product['price'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="name">picture</label>
                      <input type="text" class="form-control" name="picture" value="<?php echo $product['picture'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="name">description</label>
                      <input type="text" class="form-control" name="description" value="<?php echo $product['description'] ?>">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
    <?php
        }
      }
    }

    ?>
    </div>

</body>

</html>
<script src="../../js/bootstrap.bundle.min.js"></script>