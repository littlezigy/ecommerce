<?php
class Env {
    private $env;
    private static $_instance = 0;
    private $base_url;

    public static function env() {
        if(self::$_instance === 0) {
            self::$_instance = new env();
        }
        return self::$_instance;
    }
    private function __construct() {
        //$this->loadEnv();
        //echo "CONSTRUCTOR $this->base_url";

        include_once __DIR__ . "/../.env.php";
        if(isset($env)) {
            $this->base_url = $base_url;
            $this->env = $env;
        } else {
            $this->env = 'development';
        }
    }

    private function loadEnv() {
        include_once __DIR__ . "/../.env.php";
        if(isset($env)) {
            $this->base_url = $base_url;
            $this->env = $env;
        } else {
            $this->env = 'development';
        }
    }

    public function getbaseurl() {
        return self::$_instance->base_url;
    }
}