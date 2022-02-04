<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function login()
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

    public function share()
    {
        $this->render('share');
    }

    public function admin()
    {
        $this->render('admin');
    }

    public function settings()
    {
        $this->render('settings');
    }
}