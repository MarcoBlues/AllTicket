<?php
    namespace Models;

    class Eventype {
        private $id;
        private $desc;
        private $active;

        // Setters
        public function setActive($active) {
            $this->active = $active;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setDesc($desc) {
            $this->desc = $desc;
        }

        // Getters
        public function getActive() {
            return $this->active;
        }

        public function getId() {
            return $this->id;
        }

        public function getDesc() {
            return $this->desc;
        }
    }
?>