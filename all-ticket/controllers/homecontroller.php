<?php
    namespace Controllers;

    class HomeController {
        public function index() {
            if(isset($_SESSION["client"])) {
                require_once(VIEWS_PATH."home.php");
            }
            else {
                require_once(VIEWS_PATH."login.php");
            }
        }

        public function login() {
            if(isset($_SESSION["client"])) {
                require_once(VIEWS_PATH."home.php");
            }
            else {
                require_once(VIEWS_PATH."login.php");
                require_once(VIEWS_PATH."footer.php");
            }
        }

        public function register() {
            if(isset($_SESSION["client"])) {
                require_once(VIEWS_PATH."home.php");
            }
            else {
                require_once(VIEWS_PATH."register.php");
            }
        }

        public function logout() {
            session_destroy();
            require_once(VIEWS_PATH."login.php");
        }
    }
?>