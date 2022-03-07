<?php
namespace App;

use Illuminate\Database\Capsule\Manager;

class CreateConnection
{
    // Make connection.
    public static function makeConnection()
    {
        $capsule = new Manager();
        $capsule->addConnection(
         [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'blog',
            'username' => 'root',
            'password' => 'sql8109',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
         ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
