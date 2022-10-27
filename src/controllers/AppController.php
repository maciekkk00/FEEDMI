<?php

class AppController {
 /*   private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet() : bool
    {
        return $this->request === 'GET';
    }

    protected function isPost() : bool
    {
        return $this->request === 'POST';
    }

    protected function getSession(): ?string
    {
        if (!isset($_COOKIE['id_session']))
            return '';
        if (!$this->verifySession($_COOKIE['id_session']))
            return null;

        setcookie('id_session', $_COOKIE['id_session'], time() + 3600);
        return $_COOKIE['id_session'];
    }

    protected function getCurrentUser(): ?User
    {
        $userRepository = new UserRepository();

        if (!isset($_COOKIE['id_session']))
            return null;
        return $userRepository->getUserSession($this->getSession());
    }

    protected function verifySession(string $id_session): bool
    {
        $userRepository = new UserRepository();
        return $userRepository->isValidSession($id_session);
    }*/

    protected function render(string $template = null, array $variables = []) //w tej metodzie chcemy wyrenderowac, podajemy nazwe naszego templatu 
    {
        $templatePath = 'public/views/'. $template.'.html'; //doklejamy do nazwy naszego szablonu pelna sciezke . to kontynuacja stringu w php
        $output = 'File not found'; //jezeli nie znajdzie pliku to wypisz "asdas"

        if(file_exists($templatePath)){ //sprawdzamy czy taki plik isnieje 
            extract($variables);

            ob_start();                                 //ta funkcja otwiera zapis bufora  
            include $templatePath;          //wczytujemy plik 
            $output = ob_get_clean();   //do zmiennej output przypisujemy ten plik, ktora wyrzucimy na przegladarke. mozemy to zrobic za pomoca funkcji ob_get_clean(), ktora wyrzuci nam zapis bufora
        }
        print $output;
    }
}