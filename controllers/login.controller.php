<?php

class LoginController {

    public function login($user) {
        $user->login($_POST['login'], $_POST['password']);
    }
}