<?php
include_once("imports/handler.php");
session_start();
if(isset($_SESSION["cart"][$_POST["id"]])){
    $_SESSION["cart"][$_POST["id"]]++;
}
else{
    $_SESSION["cart"][$_POST["id"]] = $_SESSION["cart"][$_POST["id"]] = 1;
}
?>