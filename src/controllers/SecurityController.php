<?php
//kontroler do logowania, wylogowania i rejestracji
require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php'; //importujemy dostęp do modelu
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController {

    public function startSession(User $user): void
    {
        $userRepository = new UserRepository();
        $sessionID=$userRepository->creatSession($user);
        setcookie('id_session', $sessionID, time() + 3600);
        $url = "http://$_SERVER[HTTP_HOST]"; //pobieramy adres lokalnego serwera za pomoca zmiennej SERVER pod kluczem HTTP_HOST
        header("Location: {$url}/first"); //funkcja header przekieruje nas twardo pod podana lokalizacje
    }

    public function stopSession(): void
    {
        if (isset($_COOKIE['id_session']))
        {
            $userRepository = new UserRepository();

            $userRepository->deleteSession($_COOKIE['id_session']);
            setcookie('id_session', $_COOKIE['id_session'], time() - 1);
        }
    }

    public function login() //w tym miejscu chcemy pobrac dane, ktore zostana wyslane z formularza przy logowaniu
    {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {                          //weryfikujemy czy dane, które przekażemy za pomoca metody post z formularza login beda sie zgadzaly
            return $this->render('login');      //jezeli dane nie zostaly przeslane to w dalszym ciagu bedziemy chcieli zwracac, strone glowan , login
        }

        $email = $_POST['email']; //przypisujemy sobie zmienne przeslane za pomoca metody POST do nowych zmiennych (taka nazwa kluczy bierze sie z login.php 21,2line)
        $password = $_POST['password'];

        $user = $userRepository->getUser($email);

        if (!$user) { //sprawdzamu czy uzytkownik istnieje, czy zostal znaleziony w bazie danych
            return $this->render('login', ['messages' => ['User not found!']]); //jezeli nie to zwracamy ekran logowania
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if (!password_verify($password,$user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $this->startSession($user);
    }

    public function adduser(){

        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'];
        $not_hash = $_POST['password'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];

        $password=password_hash($not_hash, PASSWORD_DEFAULT);


        $user=new User($email, $password, $name, $surname);
        $userRepository->addUser($user);

        $this->startSession($user);
    }

    public function logout()
    {
        $this->stopSession();
        $this->render('login');
    }
}