<?php
    namespace Models;

    class Category {
        private $id;
        private $name;
        private $active;

        // Setters
        public function setActive($active) {
            $this->active = $active;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setName($name){
            $this->name = $name;
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
    }
?>