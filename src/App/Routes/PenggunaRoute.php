<?php

use App\Services\PenggunaService;

$penggunaService = new PenggunaService();

return function ($router) use ($penggunaService)
{
    $router->addRoute('/register', function () use ($penggunaService) {
        // Handle registration logic
        $postData = json_decode(file_get_contents("php://input"), true);
        return $penggunaService->create($postData);
    }, 'POST');

    $router->addRoute('/users', function () use ($penggunaService) {
        // Handle getting all users logic
        $users = $penggunaService->getAll();
        header('Content-Type: application/json');
        return json_encode($users);
    }, 'GET');

    // Assuming your router has a method like addRoute
    $router->addRoute('/username', function () use ($penggunaService) {
        // Get the username from the query parameters
        $username = $_GET['username'] ?? null;
    
        if ($username !== null) {
            // Handle getting user by username logic
            $user = $penggunaService->getByUsername($username);
    
            // Send JSON response
            header('Content-Type: application/json');
            echo json_encode($user);
        } else {
            // Handle error: username not provided
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Username not provided']);
        }
    }, 'GET');
    

    $router->addRoute('/userId', function () use ($penggunaService) {
        // Handle getting user by ID logic
        $id = $_GET['id'] ?? null;

        if ($id !== null) {
            // Handle getting user by ID logic
            $user = $penggunaService->getById($id);

            // Send JSON response
            header('Content-Type: application/json');
            echo json_encode($user);
        } else {
            // Handle error: ID not provided
            header('Content-Type: application/json');
            echo json_encode(['error' => 'ID not provided']);
        }
    }, 'GET');
};
