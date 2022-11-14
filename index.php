<?php  //index.php jest pierwszym plikiem uruchamianym na serwerze 

require 'Routing.php'; //importujemy 

$path = trim($_SERVER['REQUEST_URI'], '/'); //tworzymy sciezke ktorą wyslala nam przegladarka na serwer, pobieramy ja za pomoca zmiennej %_SERVER['klucz'], trim bo chce sie pozbyc /
$path = parse_url( $path, PHP_URL_PATH); //parsujemy 
//Logika: w momencie wywolania urla index albo register itd otwieramy sobie metode index z DefaultControllera 
//Router::get('index', 'DefaultController'); //wrzucamy sciezki do metody get, ktora zaimplementowalismy w pliku Routing.php
//Router::get('register', 'DefaultController');
Router::get('first', 'DefaultController');
Router::post('login', 'SecurityController'); //tutaj wyznaczyliśmy, że pod url login ma zostac otwarty SecurityController z akcja login
Router::post('addRecipe', 'RecipeController');
Router::get('cook', 'DefaultController');
//Router::get('recipes', 'RecipeController');
Router::get('share', 'DefaultController');
//Router::post('search', 'RecipeController');
//Router::get('like', 'RecipeController');
//Router::get('dislike', 'RecipeController');
Router::get('admin', 'DefaultController');
Router::get('settings', 'DefaultController');

//Router::post('adduser', 'SecurityController');
//Router::post('logout', 'SecurityController');

Router::run($path); //wywolanie metody run, jako argument sciezka 