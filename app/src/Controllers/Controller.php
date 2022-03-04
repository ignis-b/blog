<?php namespace App\Controllers;

use App\Services\AuthService;

abstract class Controller {
    const SUBTEMPLATE = 'login';
    protected $authService;
    /**
     * Controller constructor.
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

}
