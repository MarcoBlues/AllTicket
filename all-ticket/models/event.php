<?php 
    namespace Models;

    use Models\Category as Category;

    class Event {
        private $id;
        private $title;
        private $category;
        private $calendaries = array();
        private $active;

        // Setters
        public function setActive($active) {
            $this->active = $active;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setTitle($title) {
            $this->title = $title;
        }

        public function setCategory(Category $category) {
            $this->category = $category;
        }

        public function setCalendaries($calendaries) {
            $this->calendaries = $calendaries;
        }

        public function pushCalendary($calendary) {
            array_push($this->calendaries, $calendary);
        }

        // Getters
        public function getActive() {
            return $this->active;
        }

        public function getId() {
            return $this->id;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getCategory() {
            return $this->category;
        }

        public function getCalendaries() {
            return $this->calendaries;
        }
    }

?>