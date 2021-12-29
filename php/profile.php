<?php
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
    ?>
</body>

</html>
<script src="../js/bootstrap.bundle.min.js"></script>