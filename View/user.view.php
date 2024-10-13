<?php

class user_View {
    private $user = null;

    public function showLogin($error = '') {
        require 'templates/form_login.phtml';
    }

}