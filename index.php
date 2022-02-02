<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('index', 'DefaultController');
Router::get('register', 'DefaultController');
Router::get('first', 'DefaultController');
Router::post('login', 'SecurityController');
Router::post('addRecipe', 'RecipeController');
Router::get('cook', 'DefaultController');
Router::get('recipes', 'RecipeController');
Router::get('share', 'DefaultController');
Router::post('search', 'RecipeController');
Router::get('like', 'RecipeController');
Router::get('dislike', 'RecipeController');
Router::get('admin', 'DefaultController');
Router::get('settings', 'DefaultController');

Router::run($path);
