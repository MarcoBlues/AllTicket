<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
define("FRONT_ROOT", "/all-ticket/");
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");

define("REMISE", 0.85);

define("DB_HOST", "localhost");
define("DB_NAME", "allticket");
define("DB_USER", "root");
define("DB_PASS", "");