<?php
session_start();
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
  <script src="../js/products.js"></script>

  <title>Products</title>
</head>

<body>

  <?php
  $page = "admin";
  include_once("imports/navbar.php");
  ?>
  <div class="container-fluid mt-3">
    <li class="list-group-item">
      <div class="row">
        <div class="col-2">
          <h6>Category</h6>
        </div>
        <div class="col-2">
          <h6>stock</h6>
        </div>
        <div class="col-2">
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
  include_once("imports/database.php");
  $db = new Database();
  $db->connect();
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
                <h6><?php echo htmlspecialchars($row["name"]); ?></h6>
              </div>
              <div class="col-2">
                <?php
                echo ($product["stock"]);
                ?>
              </div>
              <div class="col-2">
                <?php
                echo ($product["price"]);
                ?>
              </div>
              <div class="col-2">
                <img class="img-fluid" src="../<?php echo ($product["picture"]);?>" alt="Picture of the Product"/>
              </div>
              <div class="col-2">
                <?php
                echo ($product["description"]);
                ?>
              </div>
              <div class="col-1 col-lg-2">
                <div class="input-group">
                  <button type="button" class="btn btn-outline-danger" onclick="removeUser('<?php echo $product['productID'] ?>')">
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
                  <button type="button" class="btn btn-outline-success" onclick="switchAdmin('<?php echo($product['productID'])?>')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-check" viewBox="0 0 16 16">
                      <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                      <path d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                    </svg>
                  </button>

                </div>
              </div>
            </div>
          </li>
          <div class="modal fade" id="modal<?php echo $product['productID'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./edituser.php" method="post">
                  <div class="modal-body">
                    <div class="form-group d-none">
                      <input type="text" class="form-control" name="id" value="<?php echo $product['productID'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="name">Category</label>
                      <select class="form-select" id="category">
                        <option class="dropdown-item" selected><?php echo $row["name"]?></option>
                        <?php
                          $db->prepare("SELECT * FROM categories WHERE categoryID <> ?");
                          $db->bind_param("i", [htmlspecialchars($row["categoryID"])]);
                          $db->execute();
                          $result = $db->get_result();

                          while ($cat = $result->fetch_assoc()) {
                            $name = htmlspecialchars($cat["name"]);
                          ?>
              
                            <option class="dropdown-item" ><?php echo ($name); ?></option>
                          <?php
                          }
                          ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name="lastname" value="<?php echo $product['name'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="name">Stock</label>
                      <input type="text" class="form-control" name="phone" value="<?php echo $product['stock'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="name">Price</label>
                      <input type="text" class="form-control" name="billing" value="<?php echo $product['price'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="name">picture</label>
                      <input type="text" class="form-control" name="birthDate" value="<?php echo $product['picture'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="name">description</label>
                      <input type="text" class="form-control" name="Address" value="<?php echo $product['description'] ?>">
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
<script src="../js/bootstrap.bundle.min.js"></script>