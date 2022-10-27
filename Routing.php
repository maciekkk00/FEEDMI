<?php

require_once 'src/controllers/DefaultController.php'; //musimy zaimplementowac poniewaz chcemy utworzyc obiekt run w metodzie
/*require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/RecipeController.php';*/

class Router {

    public static $routes; //publiczne statyczne pole, bedzie to tablica, ktora bedzie przechowywala url oraz adekwatnie do niego sciezke kontrolera, ktory zostanie otwarty  

    public static function get($url, $view) { //metoda ktora pozwoli nam wstawic do tej tablicy odpowiedni kontroler przydzielony do konkretnego urla 
        self::$routes[$url] = $view;
    }

 /*   public static function post($url, $view) {
        self::$routes[$url] = $view;
    }*/

    public static function run ($url) { //ta metoda pozwoli nam uruchomic dany kontroler, ktory zostal przypisany pod okreslony url 
                                        //ta metoda pobiera z naszej tablicy routingu (public status $routes) kontroler przypisany do konkretnego urla a nastepnie z tego kontrolera wykona nasza akcje

        $urlParts = explode("/", $url); //tutaj wydzielamy pierwszy element/modul naszego urla , funkcja explode dzieli nam string wejsciowy wzgledem separatora(u mnie slash)  
        $action = $urlParts[0];

        if (!array_key_exists($action, self::$routes)) {  //sprawdzmy czy w naszej tablicy routingu istnieje taki elemnt 
            die("Wrong url!");
        }

        $controller = self::$routes[$action]; //pobieramy nasz kontroler, który został przypisany pod dana sciezke w tablicy routingu, ta wartosc zwroci nam nazwe kontrolera czyli ta ktora zostala podana przy okreslonym kluczu na naszej tablicy routingu w pliku index php
        $object = new $controller; //tworzymy obiekt kontrollera, pod zmienna $controller kryje sie string albo DefaultController albo jakiś inny, który podamy pod określonym urlem, czyli jako obiekt po podaniu sciezki  index lub register lub cos innego(w pliku index.php) bedzie tworzyl sie obiekt od kontrolera 
        $id = $urlParts[1] ?? '';

        $object->$action($id); //z tego kontrolera chcemy wywołac jakas akcje za pomoca ->
    }
}

