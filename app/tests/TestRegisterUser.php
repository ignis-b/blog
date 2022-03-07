<?php
namespace App\Test;

use App\Services\UserRegisterService;
use App\CreateConnection;
use PHPUnit\Framework\TestCase;

class TestRegisterUser extends TestCase
{

    public function testIndex()
    {
        CreateConnection::makeConnection();
        $_SESSION['id'] = 1;
        $input = [
            'fullName' => 'Ivan Ivanov',
            'email' => 'ivan.ivanov@gmail.com',
            'password' => password_hash('Ivan2022!',PASSWORD_DEFAULT),
        ];
        
        $reg_user = new UserRegisterService();

        $this->assertEquals(1, $reg_user->insertDatabase($input));
    }
}
