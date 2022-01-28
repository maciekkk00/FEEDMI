<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        $this->render('login');
    }

    public function register()
    {
        $this->render('register');
    }

    public function first()
    {
        $this->render('first');
    }

    public function cook()
    {
        $this->render('cook');
    }

    public function recipes()
    {
        $this->render('recipes');
    }

    public function share()
    {
        $this->render('share');
    }
}