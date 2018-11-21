<?php
    namespace Models;

    use Models\Client as Client;
    use Models\BoughtLine as BoughtLine;

    class Bought {
        private $id;
        private $client;
        private $date;
        private $buyLineList = array();
        private $active;

        // Setters
        public function setActive($active) {
            $this->active = $active;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setClient(Client $client) {
            $this->client = $client;
        }

        public function setDate($date) {
            $this->date = $date;
        }

        public function setBuyLine($buyLineList) {
            $this->buyLineList = $buyLineList;
        }

        public function pushBuyLine($buy)
        {
            array_push($this->buyLineList,$buy);
        }

        // Getters
        public function getActive() {
            return $this->active;
        }

        public function getId() {
            return $this->id;
        }

        public function getClient() {
            return $this->client;
        }

        public function getDate() {
            return $this->date;
        }

        public function getBuyLine() {
            return $this->buyLineList;
        }

    }
?>