<?php

// require_once 'path-to-your-autoloader'; // Adjust the path accordingly
require_once 'vendor/autoload.php';

use App\Routes\Router;

// Include the penggunaRoute.php file and get the routes
$penggunaRoutes = require './src/App/Routes/PenggunaRoute.php';
$laporanAnggotaRoutes = require './src/App/Routes/LaporanAnggotaRoute.php';
$laporanKeuanganKetuaRoutes = require './src/App/Routes/LaporanKeuanganKetuaRoute.php';
$pengembalianRoutes = require './src/App/Routes/PengembalianRoute.php';
$peminjamanRoutes = require './src/App/Routes/PeminjamanRoute.php';
$loginRoutes = require './src/App/Routes/LoginRoute.php';
$logoutRoutes = require './src/App/Routes/LogoutRoute.php';

// Create an instance of Router
$router = new Router();

// Call the routes setup function and pass the router instance
$penggunaRoutes($router);
$laporanAnggotaRoutes($router);
$laporanKeuanganKetuaRoutes($router);
$pengembalianRoutes($router);
$peminjamanRoutes($router);
$loginRoutes($router);
$logoutRoutes($router);

// Route the request
echo $router->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
