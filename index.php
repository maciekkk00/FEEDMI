<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('index', 'DefaultController');
Router::get('register', 'DefaultController');
Router::get('first', 'DefaultController');
Router::get('cook', 'DefaultController');
Router::get('recipes', 'DefaultController');
Router::get('share', 'DefaultController');
Router::run($path);
