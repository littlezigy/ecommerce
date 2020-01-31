<?php
Class User {

    public function login() {
        $curl = new Curl();
        $curl->post($user_information);
    }
}

class OtherUser {
    public function __construct() {

    }
}