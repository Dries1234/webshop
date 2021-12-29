<?php
    include_once("imports/handler.php");
    session_start();
    session_destroy();
    header("Location: index.php");
    
?>