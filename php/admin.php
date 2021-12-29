<?php
include_once("imports/handler.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="../css/reset.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/nav.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/admin.js"></script>

</head>
<body>
    <?php
        $page ="admin";
        include_once("imports/navbar.php");
    ?>
    <div class="container-fluid p-3">
        <button class="btn btn-primary" id="btn-users">Users</button>
        <button class="btn btn-primary" id="btn-products">Products</button>
        <button class="btn btn-primary" id="btn-categories">Categories</button>
    </div>
</body>
</html>
<script src="../js/bootstrap.bundle.min.js"></script>
