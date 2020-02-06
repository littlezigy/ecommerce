<?php
Class User {
    private $isloggedin = false;

    public function login(String $login, String $password) {
        $res = $this->api->post('auth/login', array("email"=>$login, "password"=>$password));
        var_dump($res);

        $_SESSION['user'] = $res->data->firstname;
    }

    public function isLoggedIn() {
        return $this->isLoggedIn;
    }
}