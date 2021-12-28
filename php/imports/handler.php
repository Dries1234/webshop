<?php
    require_once("logger.php");

    function errorHandle($no, $msg, $file,$line)
    {
        (new Logger($no,$msg,$file,$line))->log();
        exit("An error occured");
    }

    function exceptionHandle($e)
    {
        (new Logger($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine()))->log();
        exit("An exception occured");
    }

    set_exception_handler("exceptionHandle");

    set_error_handler("errorHandle");

?>