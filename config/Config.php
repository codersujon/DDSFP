<?php
    class Config{
        protected $con;
        public function __construct(){
            define("HOSTNAME","localhost");
            define("USERNAME","root");
            define("PASSWORD","");
            define("DBNAME","udms");
            $this->con = new Mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME);
            // if($this->con) echo "Test";
        }
    }
?>

