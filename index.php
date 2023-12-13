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

// Create an instance of Router
$router = new Router();

// Call the routes setup function and pass the router instance
$penggunaRoutes($router);
$laporanAnggotaRoutes($router);
$laporanKeuanganKetuaRoutes($router);
$pengembalianRoutes($router);
$peminjamanRoutes($router);

// Route the request
echo $router->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
