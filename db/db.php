<?php

class WishDB extends mysqli {

    // single instance of self shared among all instances
    private static $instance = null;
    // db connection config vars
    private $user = "rsanch";
    private $pass = "ASDasdqwe";
    private $dbName = "student_rsanch";
    private $dbHost = "sfsuswe.com";
    private $con = null;
    
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    
                                                                                                                           
    // private constructor
    private function __construct() {
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }
    
    
    
}
    
    
    
?>
