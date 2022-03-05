<?php
namespace App\Services;

use App\Models\Users;
use nanaksr\validator\validation as vldtn;

class UserRegisterService
{
    /**
     * Validate method.
     * @param array $params
     * @return boolean|string
     */
    public function validate($params)
    {
        $err = '';
        $vldtn = new vldtn('en');
        $vldtn->params($params);
        $vldtn->setParamKey('fullName')->setName('Name')->setRule('ValidateFullName');
        $vldtn->setParamKey('email')->setName('Email')->setRule('ValidateEmail');
        $vldtn->setParamKey('password')->setName('Password')->equal('repeat_password');
        if ($vldtn->hasError()) {
            $err = implode($vldtn->getErrors(), '. ');
        }

        // Minimum of 8 Chars, 1 Uppercase Char, 1 Number, Special Chars !@#$%^&*-.
        if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $params['password'])){
            $err .= 'Password is not strong.';
        }

        if (!empty(Users::where('email', $params['email'])->first()->email)) {
            $err .= 'This email already exists.';
        }
        if (!empty($err)) {
            return $err;
        }
        return true;
    }

    /**
     * Insert in Database.
     * @param array $input
     * @return boolean
     */
    public function insertDatabase($input)
    {
        $res = Users::create([
         'FullName' => $input['fullName'],
         'email' => $input['email'],
         'password' => password_hash($input['password'],PASSWORD_DEFAULT),
        ]);

        return $res->incrementing;
    }
}
