<?php
    namespace Models;

    use Models\Eventype as Eventype;

    class EventSquare {
        private $id;
        private $avaiables;
        private $remainings;
        private $price;
        private $eventType;
        private $active;

        // Setters
        public function setActive($active) {
            $this->active = $active;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setAvaiables($avaiables) {
            $this->avaiables = $avaiables;
        }

        public function setRemainings($remainings) {
            $this->remainings = $remainings;
        }

        public function setPrice($price) {
            $this->price = $price;
        }

        public function setEventype(Eventype $eventype) {
            $this->eventype = $eventype;
        }

        // Getters
        public function getActive() {
            return $this->active;
        }

        public function getId() {
            return $this->id;
        }

        public function getAvaiables() {
            return $this->avaiables;
        }

        public function getRemainings() {
            return $this->remainings;
        }

        public function getPrice() {
            return $this->price;
        }

        public function getEventype() {
            return $this->eventype;
        }
    }
?>