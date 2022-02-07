<?php

class AppController {
    private $request;

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
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/'. $template.'.php';
        $output = 'File not found';

        if(file_exists($templatePath)){
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }
}