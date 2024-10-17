<?php

class user_View {
    private $user = null;

    public function showLogin($error = '') {
        include 'Templates/header.phtml';
        require 'Templates/form_login.phtml';
    }

    public function showSignup($error=''){
        require 'Templates/from_singup.phtml';
    }
}