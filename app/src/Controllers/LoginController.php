<?php
namespace App\Controllers;

use App\Services\AuthService;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class LoginController
{
    private $authService;
    private $view;
    private $logger;
    /**
     * Controller constructor.
     * @param Twig $view
     * @param LoggerInterface $logger
     * @param AuthService $authService
     */
    public function __construct(Twig $view, LoggerInterface $logger, AuthService $authService)
    {
        $this->view = $view;
        $this->logger = $logger;
        $this->authService = $authService;
    }
    
    public function __invoke(Request $request, Response $response)
    {

        $this->logger->info("User Login");
        if ($request->isPost()) {
            if ($this->authService->check($request->getParsedBody())) {
                return $response->withRedirect('/');
            }
            $error = 'Incorrect username and/or password!';
        }

        $this->view
            ->render($response, 'user/login.twig', ['nameError' => $error]);
    }

}