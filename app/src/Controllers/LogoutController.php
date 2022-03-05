<?php
namespace App\Controllers;

use App\Services\LogoutService;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class LogoutController
{
    private $authService;
    private $view;
    private $logger;
    /**
     * Controller constructor.
     * @param Twig $view
     * @param LoggerInterface $logger
     * @param LogoutService $logoutService
     */
    public function __construct(Twig $view, LoggerInterface $logger, LogoutService $logoutService)
    {
        $this->view = $view;
        $this->logger = $logger;
        $this->logoutService = $logoutService;
    }
    
    public function __invoke(Request $request, Response $response)
    {
        $this->logoutService->logout();
        return $response->withRedirect('/');
    }

}