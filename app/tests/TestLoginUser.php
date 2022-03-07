<?php
namespace App\Test;

use App\Services\AuthService;
use App\CreateConnection;
use PHPUnit\Framework\TestCase;

class TestLoginUser extends TestCase
{

    public function testIndex()
    {
        CreateConnection::makeConnection();

        $params = [
            'email' => 'ignis.b@gmail.com',
            'password' => 'Ina2013!'
        ];
        $auth = new AuthService();

        $this->assertEquals(1, $auth->check($params));
    }
}
