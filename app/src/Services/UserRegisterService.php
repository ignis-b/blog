<?php
namespace App\Services;

use nanaksr\validator\validation as vldtn;

class UserRegisterService {

    /**
     * User Register Service constructor.
     * @internal param Container $container
     */
    public function __construct()
    {
    
    }
    /**
     * Validate method.
     * @param $params
     */
    public function validate($params)
    {
        $vldtn = new vldtn('en');
        $vldtn->params($params);
        $vldtn->setParamKey('fullName')->setName('Name')->setRule('ValidateFullName');
        $vldtn->setParamKey('email')->setName('Email')->setRule('ValidateEmail');
        $vldtn->setParamKey('password')->setName('Password')->setRule('ValidateAlnum');
        $vldtn->setParamKey('password')->setName('Password')->equal('repeat_password');
        if($vldtn->hasError()) {
            return implode($vldtn->getErrors(), '. ');
        }
        return true;
    }

}
