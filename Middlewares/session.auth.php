<?php

function sessionAuthMiddleware ($res, $requireLogin = true) {
    session_start();
    if ($requireLogin) {
        if (isset($_SESSION['ID_USER'])) {
            $res->user = new stdClass();
            $res->user->id = $_SESSION['ID_USER'];
            $res->user->name = (String) $_SESSION['NAME_USER'];
        } else {
            header('Location: ' . BASE_URL . 'Login');
            die();
        }
    }
}

?>