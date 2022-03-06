<?php
namespace App\Controllers;

use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;
use App\Services\UserRegisterService;

class UserRegisterController
{
    private $view;
    private $logger;
    private $userRegisterService;

    /**
     * Controller constructor.
     * @param Twig $view
     * @param LoggerInterface $logger
     * @param UserRegisterService $userRegisterService
     */
    public function __construct(Twig $view, LoggerInterface $logger, UserRegisterService $userRegisterService) {
        $this->view = $view;
        $this->logger = $logger;
        $this->userRegisterService = $userRegisterService;
    }
    public function __invoke(Request $request, Response $response, $args) {
        $this->logger->info("User Register");

        if ($request->isPost()) {
            $input = $request->getParsedBody();
            
            if ($this->userRegisterService->validate($input) === TRUE &&
                $this->userRegisterService->insertDatabase($input) === TRUE
            ) {
                $success = "You registered successfully.";
            } else {
                $error = $this->userRegisterService->validate($input);
            }
        }

        $this->view
            ->render($response, 'user/register.twig',
            ['nameError' => $error, 'nameSuccess' => $success]
        );

        return $response;
    }
}