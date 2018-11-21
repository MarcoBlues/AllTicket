<?php
    namespace Models;

    class Artist {
        private $id;
        private $name;
        private $lastName;
        private $nickName;
        private $active;

        // Setters
        public function setActive($active) {
            $this->active = $active;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function setLastName($lastName) {
            $this->lastName = $lastName;
        }

        public function setNickName($nickName) {
            $this->nickName = $nickName;
        }

        // Getters
        public function getActive() {
            return $this->active;
        }

        public function getId() {
            return $this->id;
        }

        public function getName() {
            return $this->name;
        }

        public function getLastName() {
            return $this->lastName;
        }

        public function getNickName() {
            return $this->nickName;
        }
    }
?>