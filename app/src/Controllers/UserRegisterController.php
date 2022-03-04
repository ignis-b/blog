<?php
namespace App\Controllers;

use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;
use App\Services\UserRegisterService;

class UserRegisterController {
    private $view;
    private $logger;

    /**
     * Controller constructor.
     * @param Twig $view
     * @param LoggerInterface $logger
     * @param UserRegisterService $userRegisterService
     */
    public function __construct(Twig $view, LoggerInterface $logger, UserRegisterService $userRegisterService)
    {
        $this->view = $view;
        $this->logger = $logger;
        $this->userRegisterService = $userRegisterService;
    }
    public function __invoke(Request $request, Response $response, $args)
    {
        $this->logger->info("User Register");
        if ($request->getParsedBody() != NULL) {
            $input = $request->getParsedBody();
            var_dump($input);
        }
        
        $nameError = '';
        $this->view
            ->render($response, 'user/register.twig',
             ['nameError' => $nameError]
        );

        return $response;
    }
}