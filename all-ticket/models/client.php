<?php
    namespace Models;

    class Client {
        private $id;
        private $userName;
        private $rol;
        private $password;
        private $email;
        private $active;

        // Setters
        public function setActive($active) {
            $this->active = $active;
        }

        public function setRol($rol) {
            $this->rol = $rol;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setUserName($userName) {
            $this->userName = $userName;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

        // Getters
        public function getActive() {
            return $this->active;
        }

        public function getId() {
            return $this->id;
        }

        public function getRol() {
            return $this->rol;
        }

        public function getUserName() {
            return $this->userName;
        }

        public function getPassword() {
            return $this->password;
        }

        public function getEmail() {
            return $this->email;
        }
    }
?>