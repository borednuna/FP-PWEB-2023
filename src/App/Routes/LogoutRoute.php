<?php

use App\Config\Authentication\LogoutHandler;

$logoutHandler = new LogoutHandler();

return function ($router) use ($logoutHandler)
{
    $router->addRoute('/logout', function () use ($logoutHandler) {
        // Handle registration logic
        $logoutHandler->logoutUser();
        return;
    }, 'POST');
};