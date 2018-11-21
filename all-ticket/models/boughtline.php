<?php
    namespace Models;

    use Models\Ticket as Ticket;
    use Models\EventSquare as EventSquare;

    class BoughtLine
    {
        private $id;
        private $EventTitle;
        private $quantity;
        private $eventSquare;
        private $price;
        private $ticket;
        private $active;

        // Setters
        public function setActive($active) {
            $this->active = $active;
        }

        public function setEventTitle($eventTitle) {
            $this->EventTitle = $eventTitle;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setQuantity($quantity) {
            $this->quantity = $quantity;
        }

        public function setEventSquare(EventSquare $eventSquare) {
            $this->eventSquare = $eventSquare;
        }

        public function setPrice($price) {
            $this->price = $price;
        }

        public function setTicket(Ticket $ticket) {
            $this->ticket = $ticket;
        }

        // Getters
        public function getActive() {
            return $this->active;
        }

        public function getEventTitle() {
            return $this->EventTitle;
        }

        public function getId() {
            return $this->id;
        }

        public function getQuantity() {
            return $this->quantity;
        }

        public function getEventSquare() {
            return $this->eventSquare;
        }

        public function getPrice() {
            return $this->price;
        }

        public function getTicket() {
            return $this->ticket;
        }
    }
?> 