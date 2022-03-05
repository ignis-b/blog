<?php
namespace App\Services;

class AuthService
{
    const LOGIN = 'ignis.b@gmail.com';
    const PASSWORD = '1234';

    private $login;
    private $password;
    
    /**
     * Auth constructor.
     * @internal param Container $container
     */
    public function __construct()
    {
        $this->login = self::LOGIN;
        $this->password = self::PASSWORD;
        session_start();
        
    }
    public function attempt($login, $password)
    {
        if ($login === $this->login && $password === $this->password) {
            $_SESSION['user'] =  $this->login;
            return true;
        }

        return false;
    }

    public function check()
    {
        return isset($_SESSION['user']) && ($_SESSION['user'] === $this->login);
    }
}
