<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    private $messages = [];

    public function isLoged()
    {
        if (!isset($_COOKIE['id_session']))
            return false;
        if (is_null($this->getSession()))
        {
            $securityController = new SecurityController();
            $securityController->stopSession();
            $this->messages[] = 'Your session expired!';
            return false;
        }
        return true;
    }

    public function login()
    {
        if (!$this->isLoged())
            $this->render('login', ['messages' => $this->messages]);
        else
            $this->first();
    }

    public function register()
    {
        if (!$this->isLoged())
            $this->render('register', ['messages' => $this->messages]);
        else
            $this->first();
    }

    public function first()
    {
        if ($this->isLoged())
            $this->render('first');
        else
            $this->login();
    }

    public function cook()
    {
        if ($this->isLoged())
            $this->render('cook');
        else
            $this->login();
    }

//    public function share()
//    {
//        if ($this->isLoged())
//            $this->render('share');
//        else
//            $this->login();
//    }

    public function admin()
    {
        if ($this->isLoged())
            $this->render('admin');
        else
            $this->login();
    }

    public function settings()
    {
        if ($this->isLoged())
            $this->render('settings');
        else
            $this->login();
    }

    public function przepis()
    {
        if ($this->isLoged())
            $this->render('przepis');
        else
            $this->login();
    }


}