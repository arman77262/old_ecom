<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath .'/../lib/Database.php');
    include_once ($filepath .'/../helpers/Fromat.php');

    class User
    {
        private $db;
        private $fr;

        public function __construct()
        {
            $this->db = new Database();
            $this->fr = new Fromat();
        }
    }
