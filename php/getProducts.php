<?php
$category = NULL;
$search = NULL;
if (isset($_GET["category"])) {
    if ($_GET["category"] != "nothing") {
        $category = htmlspecialchars($_GET["category"]);
    }
}
if (isset($_GET["search"])) {
    $search = htmlspecialchars($_GET["search"]);
}
include_once("imports/database.php");
$datab = new Database();
$datab->connect();
?>

<?php
$query;
$selected;
$products;
if ($category != NULL && $search == NULL) {
    $datab->prepare("SELECT * FROM categories WHERE name=?");
    $datab->bind_param("s", [$category]);
    $datab->execute();
    $categories = $datab->get_result();
    if ($categories) {
        $entries = mysqli_fetch_assoc($categories);

        $query = "SELECT * FROM products WHERE categoryID=" . $entries["categoryID"];
        $selected = $datab->query($query);
    }
} else if ($search != NULL && $category == NULL) {
    $searchWord = '%' . $search . '%';
    $datab->prepare("SELECT * FROM products WHERE name LIKE ?");
    $datab->bind_param("s", [$searchWord]);
    $datab->execute();
    $selected = $datab->get_result();
} else if ($search != NULL && $category != NULL) {
    $datab->prepare("SELECT * FROM categories WHERE name=?");
    $datab->bind_param("s", [$category]);
    $datab->execute();
    $categories = $datab->get_result();
    if ($categories) {
        $searchWord = '%' . $search . '%';
        $entries = mysqli_fetch_assoc($categories);
        $query = "SELECT * FROM products WHERE categoryID=? AND name LIKE ?";
        $datab->prepare($query);
        $datab->bind_param("ss", [$entries["categoryID"], $searchWord]);
    }
    $datab->execute();

    $selected = $datab->get_result();
} else {
    $datab->prepare("SELECT * FROM products");
    $datab->execute();
    $selected = $datab->get_result();
}

?>


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
        $id = htmlspecialchars($row["productID"]);
        $page = "shop";
        $price = htmlspecialchars($row["price"]);
        include("imports/productcard.php");
        $i++;
        if ($i == 3) {
            ?>
            </div>
    <?php
            $i = 0;
        }
    }
    if($i != 0){
        ?>
        </div>
        <?php
    }
    ?>