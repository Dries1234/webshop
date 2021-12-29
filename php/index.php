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
    <link href = "../css/reset.css" rel = "stylesheet">
    <link href = "../css/bootstrap.min.css" rel = "stylesheet">
    <link href = "../css/nav.css" rel = "stylesheet">
    <link href = "../css/index.css" rel = "stylesheet">
    <title>Home - Covitesse</title>
</head>
<body>
<?php
  $page= "home";
  include_once("imports/navbar.php");
?>
<div class="center container-fluid d-flex justify-content-center align-items-center flex-column h-100">
  <h1 class="text-center">Covitesse</h1>
  <h2 class="text-center">For all your anti-covid-measures needs!</h2>
</div>
</body>
</html>
<script src="../js/bootstrap.bundle.min.js"></script>
