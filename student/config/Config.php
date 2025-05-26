<?php
    class Config{
        protected $con;
        public function __construct(){
            $this->con = new Mysqli("localhost", "root", "", "udms");
            // if($this->con) echo "Test";
        }
    }
?>