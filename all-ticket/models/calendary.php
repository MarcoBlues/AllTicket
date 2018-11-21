<?php
    namespace Models;

    use Models\Artist as Artist;
    use Models\Event as Event;
    use Models\EventSquare as EventSquare;
    use Models\EventPlace as EventPlace;

    class Calendary {
        private $id;
        private $date;
        private $event;
        private $eventPlace;
        private $eventSquareList = array();
        private $artistList = array();
        private $active;

        // Setters
        public function setActive($active) {
            $this->active = $active;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setDate($date) {
            $this->date = $date;
        }

        public function setEvent(Event $event) {
            $this->event = $event;
        }

        public function setEventPlace(EventPlace $eventPlace) {
            $this->eventPlace = $eventPlace;
        }

        public function setEventSquare($eventSquare) {
            $this->eventSquareList = $eventSquare;
        }

        public function pushEventSquare(EventSquare $eventSquare) {
            array_push($this->eventSquareList, $eventSquare);
        }

        public function setArtist($artist) {
            $this->artistList = $artist;
        }

        public function pushArtist(Artist $artist) {
            array_push($this->artistList, $artist);
        }

        // Getters
        public function getActive() {
            return $this->active;
        }

        public function getId() {
            return $this->id;
        }

        public function getDate() {
            return $this->date;
        }

        public function getEvent() {
            return $this->event;
        }

        public function getEventPlaces() {
            return $this->eventPlace;
        }

        public function getEventSquares() {
            return $this->eventSquareList;
        }

        public function getArtists() {
            return $this->artistList;
        }
    }
?>