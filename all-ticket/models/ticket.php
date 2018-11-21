<?php
    namespace Models;

    class Ticket
    {
        private $id;
        private $qrCode;
        private $active;

        // Setters
        public function setActive($active) {
            $this->active = $active;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setQrCode($qrCode) {
            $this->qrCode = $qrCode;
        }

        // Getters
        public function getActive() {
            return $this->active;
        }

        public function getId() {
            return $this->id;
        }

        public function getQrCode() {
            return $this->qrCode;
        }
    }

?>