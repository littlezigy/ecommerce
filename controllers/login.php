<?php

class LoginController {

    public function login($user) {
        $user->login($_POST);

        echo "You are logged in!";
        $_SESSION['user'] = $res->data->firstname;
        var_dump($res);
        
        exit();
    }
}