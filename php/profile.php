<?php
include_once("imports/handler.php");
session_start();

if (!isset($_SESSION["email"])) {
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
    <title>Profile</title>
</head>

<body>
    <?php
    $page = "profile";
    include_once("imports/navbar.php");
    include_once("imports/database.php");

    $db = new Database();
    $db->connect();
    $db->prepare("SELECT * FROM users WHERE email=?");
    $db->bind_param("s", [$_SESSION["email"]]);
    $db->execute();
    $result = $db->get_result();
    $profile = $result->fetch_assoc();
    ?>
<div class="container shadow-lg p-5 bg-white rounded mt-3">
    <h1 class="text-center display-4">Profile</h1>
    <h3>Name: <?php echo(htmlspecialchars($profile["firstName"]) . " " . htmlspecialchars($profile["lastName"]))?></h2>
    <h3>Email: <?php echo(htmlspecialchars($profile["email"]))?></h2>
    <h3>Phone: <?php echo(htmlspecialchars($profile["phone"]))?></h2>
    <h3>Billing: <?php echo(htmlspecialchars($profile["billingAddress"]))?></h2>
    <h3>Day of Birth: <?php echo(htmlspecialchars($profile["birthDate"]))?></h2>
    <h3>Address: <?php echo(htmlspecialchars($profile["Address"]))?></h2>
</div>
</body>

</html>
<script src="../js/bootstrap.bundle.min.js"></script>