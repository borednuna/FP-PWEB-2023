<?php

use App\Config\Authentication\LoginHandler;

$loginHandler = new LoginHandler();

return function ($router) use ($loginHandler)
{
    $router->addRoute('/login', function () use ($loginHandler) {
        // Handle login logic
        $postData = json_decode(file_get_contents("php://input"), true);
    
        $email = $postData['email'] ?? null;
        $password = $postData['password'] ?? null;

        $login_data = json_encode($loginHandler->loginUser($email, $password));
    
        return $login_data;
    }, 'POST');
    
};
