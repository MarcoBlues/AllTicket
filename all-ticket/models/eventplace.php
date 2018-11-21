<?php
    namespace Models;

    class EventPlace {
        private $id;
        private $slots;
        private $desc;
        private $active;

        // Setters
        public function setActive($active) {
            $this->active = $active;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setSlots($slots) {
            $this->slots = $slots;
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

        public function getSlots() {
            return $this->slots;
        }

        public function getDesc() {
            return $this->desc;
        }
    }
?>