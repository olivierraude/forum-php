<?php

    class User
    {
        public $idUser;
        public $username;
        public $password;
        public $isAdmin;
        public $isBanned;
        
        public function __construct($id = 0, $u = "", $p = "", $iA = 0, $iB = 0)
        {
            $this->idUser = $id;
            $this->username = $u;
            $this->password = $p;
            $this->isAdmin = $iA;
            $this->isBanned = $iB;
        }
        
        public function getId()
        {
            return $this->idUser;
        }
        public function getUsername()
        {
            return $this->username;
        }
        
        public function getPassword()
        {
            return $this->password;
        }
        
        public function estAdmin()
        {
            return $this->isAdmin;
        }
        public function estBanni()
        {
            return $this->isBanned;
        }
    }
?>