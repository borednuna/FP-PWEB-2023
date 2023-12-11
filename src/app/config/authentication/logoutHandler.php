<?php

namespace App\Config\Authentication;

class LogoutHandler
{
    public function logoutUser()
    {
        session_start();
        session_unset();
        session_destroy();
    }
}
