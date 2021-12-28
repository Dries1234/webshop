<?php
    define("ROOT", $_SERVER["DOCUMENT_ROOT"]);
    class Logger{
        private $no;
        private $msg;
        private $file;
        private $line;
        private $loggingfile = ROOT . "/webshop/save/logs";

        function __construct($n, $m, $f, $l)
        {
            $this->no = $n;
            $this->msg = $m;
            $this->file = $f;
            $this->line = $l;
        }

        function log(){
            $error_msg = "[ ". date("D M j G:i:s T Y") . " ] " . $this->msg . " with error code: " . $this->no . " in file: " . $this->file . " on line: " . $this->line . "\n";
            error_log($error_msg,3, $this->loggingfile);
        }
    }

?>